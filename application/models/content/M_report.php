<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		return $this->data();
	}

	public function start(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1,2,3,4,5',1);

		$data['ASSETS'] = array(
			//'datatables',
			'form_validation',
			'select2',
			//'datepicker',
			//'timepicker',
			'datetimepicker',
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
		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';

		# Jika level login = 1 (Admin)
		if($data['sLevel']=='3'){
			$ptitle = array(
				'covid_test'=>'Report Covid Test',
			);

			$pbody = array();

			# Melakukan perulangan sebanyak title
			foreach ($ptitle as $i => $r) {
				# Tampilan form periode tahun
				/* $pbody[$i] = '
				<form action="'.base_url().'report/export/report/pdf" method="post" id="commentForm'.($i+1).'" class="form-horizontal cmxform" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="control-label col-md-3">Tahun :</label>
						<div class="col-md-5">
							<select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn">
								<option value="">Select ...</option>';
								foreach (year(2019) as $j => $r2) {
									$pbody[$i] .= '<option value="'.$r2.'">'.$r2.'</option>';
								}
								$pbody[$i] .= '
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-3">Bulan :</label>
						<div class="col-md-5">
							<select class="form-control select2" data-placeholder="Select ..." name="bln" id="bln">
								<option value="">Select ...</option>';
								foreach (month() as $j => $r2) {
									$pbody[$i] .= '<option value="'.$j.'">'.$r2.'</option>';
								}
								$pbody[$i] .= '
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-3"></label>
						<div class="col-sm-5">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>'; */

				$pbody[$i] = '
				<form action="'.base_url().'report/export/'.$i.'/pdf" method="post" id="commentForm'.$i.'" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="control-label col-sm-3">Periode</label>
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
								<input type="text" data-date-format="dd-mm-yyyy" class="form-control datepicker" name="date1" id="date1" maxlength="10" placeholder="">
							</div>
							<span id="date1_message" style="color: #A00;"><span>
						</div>
						<div class="col-sm-1">
							s/d
						</div>
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
								<input type="text" data-date-format="dd-mm-yyyy" class="form-control datepicker" name="date2" id="date2" maxlength="10" placeholder="">
							</div>
							<span id="date2_message" style="color: #A00;"><span>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-3"></label>
						<div class="col-sm-5">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>';
			}
		}

		//$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}
}