<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_json extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		echo '';
	}

	public function get(){
		$table = urldecode($this->input->get('table'));
		$field = urldecode($this->input->get('field'));
		$condition = urldecode($this->input->get('condition'));
		$data = '';
		if(isset($table) && isset($field) && isset($condition)){
			$data = field_info($table,$field,$condition);
		}
		return $data;
	}

	public function post(){
		//return $data;
	}

	public function put(){
		//return $data;
	}

	public function delete(){
		//return $data;
	}
}