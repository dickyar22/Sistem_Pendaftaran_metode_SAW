<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		/* $data['CONTENT'] = '';
		return $data; */
		return $this->data();
	}

	public function start(){
		$data = array();
		$data = session_check();
		# Cek level login
		level_check($data['sLevel'],'1',1);

		# Tentukan assets yang akan digunakan
		$data['ASSETS'] = array(
			'datatables',
			//'venobox',
			'form_validation',
			'select2',
			/* 'datepicker',
			'timepicker', */
			//'datetimepicker',
			//'currency',
			//'ckeditor',
			//'modal_detail',
			'form_event',
			'captcha',
			// 'addrow', 
		);

		$data['CONTENT_TITLE'] = str_uri(urinext('content'),1);
		$data['CONTENT'] = '';
		$data['component'] = 'card';
		$data['table'] = str_uri(urinext('content'),2);
		$data['field'] = "*";
		$data['condition'] = "ORDER BY nilai DESC";
		$data['field_control'] = array(
			/* 'flag_aktif'=>array(
				'replace'=>'',
			), */
		);
		$data['start'] = 1;
		$data['extra'] = array(
			0=>'',
			1=>'',
		);
		$data['flag'] = array(
			'flag_aktif'=>'1',
		);
		$data['action'] = array(
			//'modal_detail'=>'user/detail',
			//'report'=>'',
			//'view'=>'',
			'edit'=>'',
			'delete'=>'',
			/* 'extra'=>array(
				'name'=>'Extra',
				'link'=>base_url().'pages/content/'.urinext('content').'/view',
				'class'=>'primary',
				'event'=>'onClick="return confirm(\'You Sure ... ?\')"',
				'icon'=>'eye',
			), */
		);
		$data['url'] = base_url().'pages/content/'.urinext('content').'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-primary"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="javascript:history.go(-1)" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>';

		return $data;
	}

	public function data(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'data';

		$data['thn'] = '';
		# Jika ada get thn
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		$title = '
		<form action="'.base_url().'pages/content/'.urinext('content').'/data" method="get" id="commentForm" class="form-horizontal cmxform" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="control-label col-md-3">Periode Tahun :</label>
				<div class="col-md-4">
					<select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn" required>
						<option value="">Select ...</option>';
	        			foreach (year(2021) as $i => $r) {
		                  	$select = '';
                        	if($r==$data['thn'])
                        		$select = 'selected';

                            $title .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
		                }
	            		$title .= '
					</select>
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>';
					if(isset($_GET['thn'])){
						$title .= '
						<a href="'.base_url().'report/export/hasil/excel?thn='.$data['thn'].'" class="btn btn-success" style="margin-top: 15px;"><i class="fa fa-file-excel-o"></i> Export</a>';
					}
				$title .= '
				</div>
			</div>
		</form>';

		$ptitle = array($title);

		$body = '';
		if(isset($_GET['thn'])){
			# Create Table
			$body = table(
				$data['table'],
				$data['field']="
				id_$data[table],
				(SELECT name FROM alternatif WHERE $data[table].id_alternatif=alternatif.id_alternatif) as kandidat,
				nilai,
				flag_aktif",
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$data['flag'],
				$data['action']=""
			);
		}

		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function action(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);
		
		$data = $this->start();
		$action = string(urinext('action'));
		if(!empty($action)){
			$act = urinext('action');
			$to = 'data';
			//$id_new = auto_id($data['table']);
			$id_new = generate_id($data['table']);

			$input = '';
			# Jika action adalah add atau edit
			if($act=='add' || $act=='edit'){
				$input = array();
				/* $input['id_user'] = $this->input->post('id_user');
				$input['username'] = $this->input->post('username');
				$input['password'] = $this->input->post('password'); */
			}
			elseif($act=='flag'){
				$id = string(urinext('id'));
				$r = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
				$to .= '?thn='.$r['tahun'];
			}

			$crud = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($to,$crud,$type=0,$message);
		}
	}
}