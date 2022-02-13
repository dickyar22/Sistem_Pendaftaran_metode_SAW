<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pdf extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		//$periode = $this->input->post('prd');
		$data['title'][1] = 'Tahun '.$data['date'];
		$data['file_name'] = 'Laporan_Harian_'.$data['user']['nama_user'].'_'.$data['date'];

		/*$data['html'] = report($data['table'].",calon_penerima",
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']);*/

		$data['html'] = '
		<table width="100%" cellspacing="0" cellpadding="1" border="0">
	      	<tr>
				<td align="center" width="15%"><img src="'.base_url().'img/logo.png" width="100" height="100"></td>
				<td align="center" width="85%" style="font-weight: bold; font-size: 17px;">
					'.$data['title'][0].'
				</td>
	      	</tr>
	      	<tr>
	        	<td colspan="2"><hr></td>
	      	</tr>
	    </table>
	    <h4 align="center">'.$data['title'][1].'</h4>
	    <table width="100%" cellspacing="0" cellpadding="5" border="1">
    		<tr style="font-weight: bold; text-align: center;">
    			<th width="'.$data['width'][0].'">Ranking</th>';
    			foreach ($data['fn'] as $i => $r) {
    				$data['html'] .= '
    				<th width="'.$data['width'][$i+1].'">'.$r.'</th>';
    			}
    		$data['html'] .= '
    		</tr>';

    	$d = select(
			$data['table'].",pegawai",
			$data['field'],
			$data['condition']);
    	foreach ($d as $i => $r) {
    		$data['html'] .= '
    		<tr>
				<td align="center">'.($i+1).'</td>
				<td>'.$r['nama'].'</td>
				<td align="center">'.$r['nilai'].'</td>
    		</tr>';
    	}
    	$data['html'] .= '
    	</table>';
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data['date'] = '';
		if(isset($_POST['date'])){
			$data['date'] = $_POST['date'];
		}

		$data['table'] = "kegiatan";
		$data['field'] = "*";
		$data['condition'] = "WHERE id_user='$data[sId]' AND flag_aktif='1' AND DATE(created)='$data[date]'";
		$data['fn'] = array('Nama Kegiatan','Jam','Foto');
		$data['width'] = array('5%','28%','17%','50%');
		$data['start'] = 0;
		
		$data['orientation'] = 'P';
		$data['format'] = 'A4';
		$data['font_size'] = 10;

		$data['user'] = select2("user a,bidang b","*","WHERE a.id_bidang=b.id_bidang AND a.id_user='$data[sId]'");
		$data['title'][0] = '
		LAPORAN HARIAN <br> '.$data['user']['nama_bidang'];

		return $data;
	}
}