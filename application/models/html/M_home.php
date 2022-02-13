<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		
	}

	public function start(){
		$data = array();
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

	public function append(){
		if($_POST){
			$output = '
			<div class="form-group row">
				<label class="control-label col-lg-3">Image :</label>
				<div class="col-lg-8">
					<input type="file" class="form-control" name="metadata[]" id="metadata[]" required>
				</div>
				<div class="col-lg-1">
					<a href="javascript:void(0)" class="btn btn-danger remove"><span class="fa fa-trash" aria-hidden="true"></span></a>
				</div>
			</div>';

			return $output;
		}
	}

	public function view(){
		$id = urinext('view');
		$portofolio = select2("portofolio","*","WHERE id_portofolio='$id'");
		$output = '
		<div class="cbp-l-inline">
			<div class="container">
				<div class="row">
					<aside class="col-lg-4 sidebar">
						<h1 class="post-title">'.$portofolio['name'].'</h1>
						'.$portofolio['detail'].'
					</aside>
					<div class="col-lg-8">';
						$pd = select("portofolio_detail","*","WHERE id_portofolio='$id' ORDER BY sequence");
						foreach($pd as $i => $r){
							$output .= '<img src="'.base_url().'upload/portofolio/img_portofolio/'.$id.'/'.$r['img_portofolio_detail'].'" class="img-fluid img-thumbnail" alt="Image" style="width: 700px; height: 700px;">';
						}
						$output .= '
					</div>
				</div>
			</div>
		</div>';

		return $output;
	}
}