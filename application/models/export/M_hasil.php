<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		$field_info = field_info($data['table'],$data['field'],$data['condition']);

    	$sheet = array($data['thn']);
    	foreach ($sheet as $i => $r) {
    		if($i>0){
    			$data['PHPExcel']->createSheet($i);
    		}
    		
			$data['PHPExcel']->setActiveSheetIndex($i)->setTitle($r);

			foreach ($field_info as $j => $r2) {
				if(!isset($data['field_control'][$r2->name]['name'])){
					$name = ucwords(str_replace(array('_','id_'),' ',$r2->name));
				}
				else{
					$name = $data['field_control'][$r2->name]['name'];
				}
				$data['PHPExcel']->getActiveSheet()
				->setCellValueByColumnAndRow($j, 1, $name);
			}

			$d = select($data['table'],$data['field'],$data['condition']);
			foreach ($d as $j => $r2) {
				$r2 = array_values($r2);
				foreach ($field_info as $k => $r3) {
					if(isset($data['field_control'][$r3->name]['column']) && isset($data['field_control'][$r3->name]['width'])){
						$data['PHPExcel']->getActiveSheet()
						->getColumnDimension($data['field_control'][$r3->name]['column'])->setWidth($data['field_control'][$r3->name]['width']);
					}

					$data['PHPExcel']->getActiveSheet()
					->setCellValueByColumnAndRow($k, ($j+2), $r2[$k]);
				}
			}
    	}
		$data['PHPExcel']->setActiveSheetIndex(0);
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data['thn'] = '';
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		require('themes/assets/PHPExcel/PHPExcel/IOFactory.php');
		$data['PHPExcel'] = new PHPExcel();

		$data['table'] = "hasil";
		$data['field'] = "@no:=@no+1 as ranking,(SELECT name FROM alternatif WHERE $data[table].id_alternatif=alternatif.id_alternatif) as kandidat,nilai";
		$data['condition'] = "JOIN (SELECT @no:=0) r WHERE tahun='$data[thn]' ORDER BY nilai DESC";
		$data['field_control'] = array(
			/* 'id_user'=>array(
				'name'=>'ID User',
				'column'=>'A',
				'width'=>'50',
			), */
		);
		$data['file_name'] = 'Excel_'.ucwords(str_replace(array('_','id'),' ',$data['table'])).'_'.$data['thn'];

		return $data;
	}
}