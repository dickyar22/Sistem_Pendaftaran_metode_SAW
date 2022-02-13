<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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

	/* public function json(){
		session_check();
		$data = array();
		$model = 'M_json';
    	if(file_exists(APPPATH.'models/'.$model.'.php')){
    		$action_type = array('get','post','put','delete');
			$action = urinext('json');
		    if(!empty($action) && in_array($action,$action_type)){
		    	$this->load->model($model);
				$data['json'] = $this->$model->$action();
				$this->load->view('v_json', $data);
		    }
    	}
	} */

	public function json($json_next=''){
		$data = array();
		$json = str_replace('-','_',$json_next);
		$model = 'M_'.$json;
		$path = $model;
		if (strpos($json,':') == TRUE) {
			list($folder,$file) = explode(':',$json);
			$model = 'M_'.$file;
			$path = $folder.'/'.$model;
		}
    	if(file_exists(APPPATH.'models/'.$this->router->method.'/'.$path.'.php')){
			$action = urinext($json_next);
			$this->load->model($this->router->method.'/'.$path);
			if(!empty($json) && !empty($action) && in_array($action,get_class_methods($model))){
				$data = $this->$model->$action();
				if($data!=NULL){
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
				}	
		    }
		}
	}

	public function html($html_next=''){
		$data = array();
		$html = str_replace('-','_',$html_next);
		$model = 'M_'.$html;
		$path = $model;
		if (strpos($html,':') == TRUE) {
			list($folder,$file) = explode(':',$html);
			$model = 'M_'.$file;
			$path = $folder.'/'.$model;
		}
    	if(file_exists(APPPATH.'models/'.$this->router->method.'/'.$path.'.php')){
			$action = urinext($html_next);
			$this->load->model($this->router->method.'/'.$path);
			if(!empty($html) && !empty($action) && in_array($action,get_class_methods($model))){
				echo $this->$model->$action();
			}
		}
	}

	public function call(){
		$user_post = http_build_query(
			array(
				'user' => 'zhang',
				'pass' => 'gBJHgKk69hKgakJB78dd'
			)
		);
		
		$opts = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $user_post
			)
		);
		
		$context  = stream_context_create($opts);
		$result = json_decode(file_get_contents('http://localhost/kreen/api/json/visitor/get', false, $context));
		//print_r($result);

		foreach($result->data as $i => $r){
			echo $r->name.'<br>';
		}
	}
}
