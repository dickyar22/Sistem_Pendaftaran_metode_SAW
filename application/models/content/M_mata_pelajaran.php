<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mata_pelajaran extends CI_Model {
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
		//level_check($data['sLevel'],'1',1);

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
		$data['condition'] = "ORDER BY created DESC";
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

		if($this->session->userdata('ei_login')==TRUE){
			$ptitle = array($data['add']);

			# Create Table
			$body = table(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$data['flag'],
				$data['action']
			);

			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		else{
			$body = '
			<section class="courses section-padding-large bg-parten section-bg-overlay">
				<div class="container">
					<div class="section-title-white section-title-center">
						<h2>Mata Pelajaran</h2>
						<p class="title-desc">
							List Mata Pelajaran
						</p>
					</div>
					<div class="courses-content featured-course-slider">
						<div class="row">';
							$mapel = select($data['table'],$data['field'],"WHERE flag_aktif='1' ORDER BY created DESC");
							foreach($mapel as $i => $r){
								$body .= '
								<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
									<article class="item wow fadeIn" data-wow-delay="0.1s">
										<div class="info">
											<span class="teacher">';
											$guru = select("guru","*","WHERE flag_aktif='1' AND id_mata_pelajaran='$r[id_mata_pelajaran]' ORDER BY created DESC");
											foreach($guru as $j => $r2){
												$body .= $r2['name'].', ';
											}
											$body .= '
											</span>
											<h3 class="title">
												'.$r['name'].'
											</h3>
											<p class="course-desc" align="justify">
												'.substr($r['detail'],0,200).'
											</p>
											<div class="desc display-flex">
												<div class="comments-students">
													<a href="#" class="comments"><i class="fas fa-user"></i>'.count($guru).' Guru</a>
												</div>
												<span class="price free">Class</span>
											</div>
										</div>
									</article>
								</div>';
							}
						
							$body .= '
						</div>
					</div>
				</div>
			</section>';
			
			$data['CONTENT'] = $body;
		}
		return $data;
	}

	public function add(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'add';
		$ptitle = array($data['back']);

		# Create Form
		$input_field = input_field(
			$data['table'],
			$data['field'],
			$data['condition'],
			$data['field_control'],
			$data['start'],
			$values='',
			$data['extra']
		);

		$body = form($input_field,$action='add',$form_id='');
		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function edit(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$action = string(urinext('edit'));
		$id = string(urinext('id'));
		if(!empty($action) && !empty($id)){
			$data['ACTION'] = 'edit';
			$ptitle = array($data['back']);

			$values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			/* $data['field_control']['file']['attributes'] = '';
			$data['field_control']['img']['attributes'] = ''; */
			
			# Create Form
			$input_field = input_field(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$values,
				$data['extra']
			);

			$body = form($input_field,$action='edit/id/'.$id,$form_id='');
			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		return $data;
	}

	public function view(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$action = string(urinext('view'));
		$id = string(urinext('id'));
		if(!empty($action) && !empty($id)){
			$data['ACTION'] = 'view';
			$ptitle = array($data['back']);
			$values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			
			# Create Form View
			$body = view(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$values,
				$data['extra']
			);

			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		return $data;
	}

	public function action(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);
		
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

			$crud = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($to,$crud,$type=0,$message);
		}
	}
}