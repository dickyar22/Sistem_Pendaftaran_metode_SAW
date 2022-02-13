<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
	}

	public function index(){
		
	}

	public function export($export_next=''){
		session_check();
		$data = array();
		$export = str_replace('-','_',$export_next);
		$model = 'M_'.$export;
		$path = $model;
		if (strpos($export,':') == TRUE) {
			list($folder,$file) = explode(':',$export);
			$model = 'M_'.$file;
			$path = $folder.'/'.$model;
		}
    	if(file_exists(APPPATH.'models/'.$this->router->method.'/'.$path.'.php')){
    		$action_type = array('pdf','excel','excel_xls');
			$action = urinext($export_next);
		    if(!empty($export) && !empty($action) && in_array($action,$action_type)){
				$this->load->model($this->router->method.'/'.$path);
				$data = $this->$model->index();
				if($action=='pdf'){
					$this->load->view('export/v_pdf', $data);
				}
				elseif($action=='excel'){
					$this->load->view('export/v_excel', $data);
				}
				elseif($action=='excel_xls'){
					$this->load->view('export/v_excel_xls', $data);
				}
		    }
    	}
	}
}
