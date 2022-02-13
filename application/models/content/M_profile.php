<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		return $this->edit();
	}

	public function start(){
		$data = array();
		$data = session_check();
		# Cek level login
		level_check($data['sLevel'],'1,2,3,4,5',1);

		# Tentukan assets yang akan digunakan
		$data['ASSETS'] = array(
			'datatables',
			'form_validation',
			'select2',
			/* 'datepicker',
			'timepicker',
			'datetimepicker',
			'currency',
			'ckeditor', */
			'modal_detail',
			'form_event',
			'captcha',
			// 'addrow', 
		);

		$data['CONTENT_TITLE'] = str_uri(urinext('content'),1);
		$data['CONTENT'] = '';
		$data['component'] = 'card';
		$data['table'] = 'user';
		$data['field'] = "id_user,password,modified";
		$data['condition'] = "ORDER BY created DESC";
		$data['field_control'] = array(
			'password'=>array(
				'name'=>'New Password',
				'attributes'=>'required',
				'placeholder'=>'',
				// 'multiple'=>'[]',
				// 'event'=>'onChange="on_event(this.value)"',
				'value'=>'',
				'list'=>'',
				'list_type'=>'',
				'after'=>'',
				//'replace'=>'',
			),
		);
		$data['start'] = 1;
		$data['extra'] = array(
			0=>'
			<div class="form-group row">
				<label class="control-label col-sm-3">Old Password <span style="color: red;">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" name="old_password" id="old_password" maxlength="20" value="" required>
				</div>
			</div>',
			1=>'
			<div class="form-group row">
				<label class="control-label col-sm-3">New Password Confirm <span style="color: red;">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" name="password_confirm" id="password_confirm" maxlength="20" value="" onchange="input_confirm(this.id,this.value,\'password\')" required>
					<span id="password_confirm_message"></span>
				</div>
			</div>',
		);
		$data['flag'] = array(
			'flag_aktif'=>'1',
		);
		$data['action'] = array(
			'modal_detail'=>'user/detail',
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

	public function cpw(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'edit';
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

		$body = form($input_field,$action='edit/id/'.$data['sId'],$form_id='');
		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function edit(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'edit';
		$ptitle = array($data['back']);
		$rr = select2($data['table'],"*","WHERE id_$data[table]='$data[sId]'");
		$values = select2($data['table'],"id_$data[table],nama_lengkap","WHERE id_$data[table]='$data[sId]'");
		$data['extra'] = array(
			0=>'
			<div class="form-group row">
				<label class="control-label col-sm-3">Username</label>
				<div class="col-sm-9">
					<b>'.$rr['username'].'</b>
					<span id="password_confirm_message"></span>
				</div>
			</div>',
			1=>'',
		);
		# Create Form
		$input_field = input_field(
			$data['table'],
			$data['field']="id_$data[table],nama_lengkap",
			$data['condition'],
			$data['field_control'],
			$data['start'],
			$values,
			$data['extra']
		);

		$body = form($input_field,$action='edit/id/'.$data['sId'],$form_id='');
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
			$to = 'edit';
			//$id_new = auto_id($data['table']);
			$id_new = generate_id($data['table']);

			$input = '';
			# Jika action adalah add atau edit
			if($act=='add' || $act=='edit'){
				$input = array();
				/* $input['id_user'] = $this->input->post('id_user');
				$input['username'] = $this->input->post('username');
				$input['password'] = $this->input->post('password'); */

				# Cek id_user berdasarkan id_user saat login
				$r = select2($data['table'],$data['field'],"WHERE id_user='$data[sId]'");
				# Jika password lama tidak sama dengan inputan password
				if($this->input->post('old_password')){
					$to = 'cpw';
					$password = $this->input->post('password');
					$options = [
						'cost' => 12,
					];
					$input['password'] = password_hash($password, PASSWORD_BCRYPT, $options);

					if(!password_verify($this->input->post('old_password'), $r['password'])){
						$message[0] = 'Old Password Wrong !';
						$message[1] = 'Failed';
						
						# Tampilan pesan error
						message($to,$crud=TRUE,$type=1,$message);
						exit();
					}
				}
				else{
					$data['field'] = "id_$data[table],nama_lengkap,modified";
				}
			}

			$crud = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($to,$crud,$type=1,$message);
		}
	}
}