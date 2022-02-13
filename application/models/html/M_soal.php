<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_soal extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function start(){
		$data = array();
		$data = session_check();
		$data['table'] = str_uri(urinext('html'),2);
		$data['field'] = "*";
		$data['condition'] = "ORDER BY created DESC";
		$data['field_control'] = '';
		$data['start'] = 1;
		$data['extra'] = array(
			0=>'',
			1=>'',
		);
		return $data;
	}

	public function detail(){
		if($_POST){
			$data = $this->start();
			$id = $_POST['id'];

	        $values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			$body = view(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$values,
				$data['extra']
			);

			$output = '
			<div class="modal-body">
				'.$body.'
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>';
			return $output;
		}
	}

	public function select_list(){
		if($_POST){
			$data = $this->start();
			$id = $_POST['id'];
			$val = $_POST['val'];

			$output = '<option value="">Select ...</option>';
			
			if($id=='Pilihan'){
				$select_list = array('A','B','C','D','E');
				foreach ($select_list as $i => $r) {
					$select = '';
					if($r==$val){
						$select = 'selected';
					}
					$output .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
				}
			}
			else{
				$output .= '<option value="'.$id.'" selected>'.$id.'</option>';
			}

			return $output;
		}
	}

	public function select_list2(){
		if($_POST){
			$data = $this->start();
			$id = $_POST['id'];
			$val = $_POST['val'];

			$output = '';
			
			if($id=='Pilihan'){
				$select_list = array('A','B','C','D','E');

				foreach ($select_list as $i => $r) {
					$value = '';
					if(!empty($val)){
						$json = json_decode($val);
						$value = $json->$r;
					}

					$output .= '
					<div class="form-group row">
						<label class="control-label col-sm-3">'.$r.' <span style="color: red;">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="pilihan[]" id="pilihan[]" maxlength="200" value="'.$value.'" placeholder="" onkeypress="return string(event)"  required>
							<span id="pilihan_message" style="color: #A00;"><span>
						</div>
					</div>';
				}
			}

			return $output;
		}
	}

	public function unique(){
		if($_POST){
			$data = $this->start();
			$val = $_POST['val'];

			$r = select2(strtolower($data['table']),$data['field'],"WHERE username='$val'");
			$output = '';
			if($r!=NULL){
				$output = 'This has already been used';
			}

			return $output;
		}
	}

	public function append(){
		if($_POST){
			$output = '
			<div class="form-group row">
				<label class="control-label col-lg-3">Metadata :</label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="metadata[]" id="metadata[]" maxlength="200" value="" onkeypress="return string(event)" required>
				</div>
				<label class="control-label col-lg-2">Type :</label>
				<div class="col-lg-3">
					<select class="form-control select2" data-placeholder="Select ..." name="type[]" id="type[]"  required>
						<option value="">Select ...</option>';
						$type = array('text','number','date','select','file');
						foreach($type as $i => $r){
							$output .= '
							<option value="'.$r.'" >'.$r.'</option>';
						}
					$output .= '
					</select>
				</div>
				<div class="col-lg-1">
					<a href="javascript:void(0)" class="btn btn-danger remove"><span class="fa fa-trash" aria-hidden="true"></span></a>
				</div>
			</div>';

			return $output;
		}
	}
}