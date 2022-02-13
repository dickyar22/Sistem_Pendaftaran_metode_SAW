<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent:: __construct();
		$this->sLogin = $this->session->userdata('ei_login');
	    $this->sLevel = $this->session->userdata('ei_level');
	}

	public function index(){
		
	}

	public function download($table=''){
		if($this->sLogin==TRUE){
			$field = urinext($table);
			$file = urinext($field);
			$link = 'upload/'.$table.'/'.$field.'/'.$file;
			redirect($link);
		}
	}
}
