<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();

		$data['title'][1] = '';
		$data['file_name'] = 'Bukti Pendaftaran';

		/* $data['html'] = report($data['table'],
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']); */

		$r = select2($data['table'],$data['field'],$data['condition']);

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
	    <table width="100%" cellspacing="0" cellpadding="5" border="0">
    		<tr>
				<th width="30%">No. Registrasi</th>
				<th width="5%">:</th>
				<th width="65%">'.$r['id_guru'].'</th>
			</tr>
			<tr>
				<th width="30%">Nama</th>
				<th width="5%">:</th>
				<th width="65%">'.$r['nama_guru'].'</th>
			</tr>
			<tr>
				<th width="30%">NUPTK</th>
				<th width="5%">:</th>
				<th width="65%">'.$r['nuptk'].'</th>
			</tr>
			<tr>
				<th width="30%">TKQ</th>
				<th width="5%">:</th>
				<th width="65%">'.$r['nama_tkq'].'</th>
    		</tr>
    	</table>';
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data['id'] = '';
		if(isset($_POST['id'])){
			$data['id'] = $_POST['id'];
		}

		$data['table'] = "guru";
		$data['field'] = "*";
		$data['condition'] = "WHERE id_guru='$data[id]'";
		$data['fn'] = array('');
		$data['width'] = array('5%');
		$data['start'] = 0;
		
		$data['orientation'] = 'P';
		$data['format'] = 'A4';
		$data['font_size'] = 10;

		$data['title'][0] = '
		BADAN KORDINASI <br>
		TAMAN KANAK KANAK AL-QURAN <br>
		KAB. KARAWANG';

		return $data;
	}
}