<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function start(){
		if($_POST){
			$data = array();
			$data['user'] = $this->input->post('user');
			$data['pass'] = $this->input->post('pass');
			$data['table'] = "";
			$data['field'] = "";
			$data['id'] = "";
			$data['condition'] = "ORDER BY created DESC";
			$data['login'] = FALSE;
			$r = select2("api","*","WHERE flag_aktif='1' AND id_api_level='1' AND username='$data[user]' AND password='$data[pass]'");

			if(($r!=NULL) && ($r['flag_aktif']=='1' && $r['id_api_level']=='1' && $r['username']==$data['user'] && $r['password']==$data['pass'])){
				$data['table'] = str_uri(urinext('json'),2);
				$data['field'] = "*";
				if(!empty(urinext('id'))){
					$data['id'] = urinext('id');
					$data['condition'] = "WHERE id_$data[table]='$data[id]' $data[condition]";
				}
				$data['login'] = TRUE;
			}
			
			return $data;
		}
		
		return $data;
	}

	public function field_info(){
		$data = $this->start();
		if($_POST && $data['login']==TRUE){
			$output = field_info($data['table'],$data['field'],$data['condition']);
			return $output;
		}
	}

	public function get(){
		$data = $this->start();
		if($_POST && $data['login']==TRUE){
			$output = array();
			$output['data'] = select($data['table'],$data['field'],$data['condition']);

			if($output){
				if($output['data']!=NULL){
					$output['status'] = '1';
					$output['message'] = 'success';
				}
				else{
					$output['status'] = '2';
					$output['message'] = 'no data';
				}
			}
			else{
				$output['status'] = '0';
				$output['message'] = 'failed';
			}
			
			return $output;
		}
	}

	public function post(){
		$data = $this->start();
		if($_POST && $data['login']==TRUE){
			$field = 'id_'.$data['table'];
			$id_new = generate_id($data['table']);
			$value = "'$id_new'";
			foreach ($_POST as $i => $r) {
				if($i!='user' && $i!='pass'){
					$field .= ','.$i;
					$value .= ",'$r'";
				}
			}
			$datetime = date('Y-m-d H:i:s');
			$field .= ",created,modified";
			$value .= ",'$datetime','$datetime'";
			$action = insert($data['table'],$field,"(".$value.")");

			$output = array();
			if($action){
				$output['status'] = '1';
				$output['message'] = 'success';
			}
			else{
				$output['status'] = '0';
				$output['message'] = 'failed';
			}
			return $output;
		}
	}

	public function put(){
		$data = $this->start();
		$id = string(urinext('id'));
		if($_POST && $data['login']==TRUE && !$id){
			$field = "";
			foreach ($_POST as $i => $r) {
				if($i!='user' && $i!='pass'){
					$field .= $i."='$r',";
				}
			}
			$datetime = date('Y-m-d H:i:s');
			$field .= "modified='$datetime'";
			$action = update($data['table'],$field,$data['condition']);

			$output = array();
			if($action){
				$output['status'] = '1';
				$output['message'] = 'success';
			}
			else{
				$output['status'] = '0';
				$output['message'] = 'failed';
			}
			return $output;
		}
	}

	public function delete(){
		$data = $this->start();
		$id = string(urinext('id'));
		if($_POST && $data['login']==TRUE && !$id){
			$action = delete($data['table'],$data['condition']);
			$output = array();
			if($action){
				$output['status'] = '1';
				$output['message'] = 'success';
			}
			else{
				$output['status'] = '0';
				$output['message'] = 'failed';
			}
			return $output;
		}
	}
}