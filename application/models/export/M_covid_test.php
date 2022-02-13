<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_covid_test extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		//$periode = $this->input->post('prd');
		$data['title'][1] = '';
		$data['file_name'] = 'Report_Covid_19_Test_'.$data['date1'].'_'.$data['date2'];

		$data['html'] = report($data['table'],
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']);

		/* $data['html'] = '
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
			$data['table'],
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
    	</table>'; */
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data['date1'] = '';
		$data['date2'] = '';
		if(isset($_POST['date1']) && isset($_POST['date2'])){
			$data['date1'] = date_en($_POST['date1']);
			$data['date2'] = date_en($_POST['date2']);
		}

		$data['table'] = "covid_test";
		$data['field']="
		(SELECT name FROM patient WHERE $data[table].id_patient=patient.id_patient) as patient,
		(SELECT name FROM test_kit WHERE $data[table].id_test_kit=test_kit.id_test_kit) as test_kit,
		test_date,
		result,
		result_date,
		status";
		$data['condition'] = "WHERE flag_aktif='1' AND DATE(test_date) BETWEEN '$data[date1]' AND '$data[date2]'";
		$data['fn'] = array('Patient','Test Kit','Test Date','Result','Result Date','Status');
		$data['width'] = array('5%','20%','20%','12%','20%','12%','12%');
		$data['start'] = 0;
		
		$data['orientation'] = 'P';
		$data['format'] = 'A4';
		$data['font_size'] = 10;

		$data['title'][0] = '
		REPORT COVID-19 TEST';

		return $data;
	}
}