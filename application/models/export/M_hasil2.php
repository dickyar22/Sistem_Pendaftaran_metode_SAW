<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		//$periode = $this->input->post('prd');
		$data['title'][1] = '';
		$data['file_name'] = 'Hasil_Seleksi';

		$data['html'] = report($data['table'],
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']);
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data['thn'] = '';
		$data['thp'] = '';
		$data['plt'] = '';
		$data['rk'] = '';
		$data['condition'] = "WHERE a.id_seleksi=b.id_seleksi ORDER BY a.created DESC";
		if(isset($_GET['thn']) && isset($_GET['thp']) && isset($_GET['plt']) && isset($_GET['rk'])){
			$data['thn'] = $_GET['thn'];
			$data['thp'] = $_GET['thp'];
			$data['plt'] = $_GET['plt'];
			$data['rk'] = $_GET['rk'];

			$sort = 'DESC';
			if($data['rk']=='waktu_pengerjaan'){
				$sort = 'ASC';
			}

			$data['condition'] = "WHERE a.id_seleksi=b.id_seleksi AND a.id_pelatihan='$data[plt]' AND b.tahun='$data[thn]' AND b.tahap='$data[thp]' ORDER BY $data[rk] $sort";
		}

		$data['table'] = "tes";
		$data['field'] = "
		a.name,
		a.nohp,
		a.alamat,
		b.tahun,
		b.tahap,
		(SELECT name FROM pelatihan WHERE a.id_pelatihan=pelatihan.id_pelatihan) as pelatihan,
		(SELECT SUM(poin) FROM $data[table]_detail WHERE a.id_tes=$data[table]_detail.id_tes) as total_poin,
		(SELECT SUM(poin) FROM $data[table]_detail,soal WHERE a.id_tes=$data[table]_detail.id_tes AND $data[table]_detail.id_soal=soal.id_soal AND type='Pilihan') as poin_soal_pilihan,
		timediff(a.jam_selesai, a.jam_mulai) as waktu_pengerjaan";

		$data['table'] .= " a, seleksi b";

		$data['fn'] = array('Nama','No. Hp','Alamat','Tahun','Tahap','Pelatihan','Total Poin','Poin Soal Pilihan','Waktu Pengerjaan');
		$data['width'] = array('5%','15%','10%','15%','7%','7%','17%','7%','7%','10%');
		$data['start'] = 0;
		
		$data['orientation'] = 'L';
		$data['format'] = 'A4';
		$data['font_size'] = 10;

		$data['title'][0] = '
		HASIL SELEKSI';

		return $data;
	}
}