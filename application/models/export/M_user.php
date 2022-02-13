<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		//$periode = $this->input->post('prd');
		$data['title'][1] = '';
		$data['file_name'] = 'Daftar_Login';

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

		/* $data['date'] = '';
		if(isset($_GET['date'])){
			$data['date'] = $_GET['date'];
		} */

		$data['table'] = "user";
		$data['field'] = "nama_lengkap,nip,jabatan,username,password";
		$data['condition'] = "WHERE flag_aktif='1' AND id_user_level!='1' ORDER BY nama_lengkap";
		$data['fn'] = array('Nama','NIP','Jabatan','Username','Password');
		$data['width'] = array("5%","25%","20%","25%","13%","12%");
		$data['start'] = 0;

		$data['orientation'] = 'P';
		$data['format'] = 'A4';
		$data['font_size'] = 8;
		$data['title'][0] = '
		DISHUB KOTA PEKANBARU <br>Data Login';

		return $data;
	}
}