<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perangkingan extends CI_Model {
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
		level_check($data['sLevel'],'1',1);

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
		$data['table'] = "penilaian";
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

		$data['thn'] = '';
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		$title = '
		<form action="'.base_url().'pages/content/'.urinext('content').'/data" method="get" id="commentForm" class="form-horizontal cmxform" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="control-label col-md-3">Periode Tahun :</label>
				<div class="col-md-4">
					<select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn" required>
						<option value="">Select ...</option>';
	        			foreach (year(2021) as $i => $r) {
                            $select = '';
                        	if($r==$data['thn'])
                        		$select = 'selected';

                            $title .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
		                }
	            		$title .= '
					</select>
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Proses</button>
				</div>
			</div>
		</form>';

		$ptitle = array($title);

		$body = '';
		if(isset($_GET['thn'])){
			$data['alternatif'] = select("alternatif","*","WHERE flag_aktif='1' ORDER BY created");
			$body .= '
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-primary header-elements-inline">
							<h6 class="card-title"> SPK SAW</h6>
							<div class="header-elements">
								<div class="list-icons">
									<a class="list-icons-item" data-action="collapse"></a>
									<a class="list-icons-item" data-action="remove"></a>
								</div>
							</div>
						</div>
						<div class="card-body collapse out">
							<h4 style="color: red; font-weight: bold">Kriteria</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Kriteria</th>
										<th>Jenis Kriteria</th>
										<th>Bobot</th>
									</tr>
								</thead>
								<tbody>';
								$data['kr'] = select("kriteria","*","WHERE flag_aktif='1'");
								foreach($data['kr'] as $i => $r){
									$body .= '
									<tr>
										<td>'.($i+1).'</td>
										<td><sub>C'.($i+1).'</sub> '.$r['name'].'</td>
										<td>'.$r['jenis'].'</td>
										<td>'.$r['bobot'].'</td>
									</tr>';
								}
								$body .= '
								</tbody>
							</table>
							<br><br>
							<h4 style="color: red; font-weight: bold">Data Nilai Alternatif</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Alternatif</th>';
										foreach($data['kr'] as $i => $r){
											$body .= '<th>C'.($i+1).'</th>';
										}
									$body .= '
									</tr>
								</thead>
								<tbody>';
								foreach($data['alternatif'] as $i => $r){
									$body .= '
									<tr>
										<td>'.($i+1).'</td>
										<td><sub>A'.($i+1).'</sub> '.$r['name'].'</td>';
										foreach($data['kr'] as $j => $r2){
											$r3 = select2($data['table'],"nilai","WHERE id_alternatif='$r[id_alternatif]' AND $data[table].id_kriteria='$r2[id_kriteria]' AND $data[table].tahun='$data[thn]'");
											$r4 = select2("sub_kriteria","*","WHERE id_kriteria='$r2[id_kriteria]' AND nilai='$r3[nilai]'");
											$body .= '<td>'.$r4['name'].'</td>';
										}
									$body .= '
									</tr>';
								}
								$body .= '
								</tbody>
							</table>
							<br><br>
							<h4 style="color: red; font-weight: bold">Tahap Analisa</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Alternatif</th>';
										foreach($data['kr'] as $i => $r){
											$body .= '<th>C'.($i+1).'</th>';
										}
									$body .= '
									</tr>
								</thead>
								<tbody>';
								$n = array();
								foreach($data['alternatif'] as $i => $r){
									$id_alternatif = $r['id_alternatif'];
									$body .= '
									<tr>
										<td>'.($i+1).'</td>
										<td><sub>A'.($i+1).'</sub> '.$r['name'].'</td>';
										foreach($data['kr'] as $j => $r2){
											$r3 = select2($data['table'],"nilai","WHERE id_alternatif='$r[id_alternatif]' AND $data[table].id_kriteria='$r2[id_kriteria]' AND $data[table].tahun='$data[thn]'");
											$body .= '<td>'.$r3['nilai'].'</td>';
											$n[$id_alternatif][$j] = $r3['nilai'];
										}
									$body .= '
									</tr>';
								}
								$body .= '
								</tbody>
							</table>
							<br><br>
							<h4 style="color: red; font-weight: bold">Matrik Ternormalisasi (R)</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Alternatif</th>';
										foreach($data['kr'] as $i => $r){
											$body .= '<th>C'.($i+1).'</th>';
										}
									$body .= '
									</tr>
								</thead>
								<tbody>';
								$alt = array();
								$min = array();
								$max = array();
								foreach ($data['kr'] as $j => $r2) {
									foreach ($data['alternatif'] as $i => $r) {
										$id_alternatif = $r['id_alternatif'];
										$alt[$id_alternatif] = $n[$id_alternatif][$j];
									}
									$min[$j] = min($alt);
									$max[$j] = max($alt);
									unset($alt);
								}

								$normal = array();
								foreach($data['alternatif'] as $i => $r){
									$id_alternatif = $r['id_alternatif'];
									$body .= '
									<tr>
										<td>'.($i+1).'</td>
										<td><sub>A'.($i+1).'</sub> '.$r['name'].'</td>';
										foreach ($data['kr'] as $j => $r2) {
											$normal[$id_alternatif][$j] = 0;
											if($r2['jenis']=='Benefit'){
												if($n[$id_alternatif][$j]!=0 && $max[$j]!=0){
													$normal[$id_alternatif][$j] = $n[$id_alternatif][$j]/$max[$j];
												}
											}
											elseif($r2['jenis']=='Cost'){
												if($n[$id_alternatif][$j]!=0 && $min[$j]!=0){
													$normal[$id_alternatif][$j] = $min[$j]/$n[$id_alternatif][$j];
												}
											}
											$body .= '<td>'.number_format($normal[$id_alternatif][$j],2).'</td>';
										}
									$body .= '
									</tr>';
								}
								$body .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-primary header-elements-inline">
							<h6 class="card-title">Perangkingan</h6>
							<div class="header-elements">
								<div class="list-icons">
									<a class="list-icons-item" data-action="collapse"></a>
									<a class="list-icons-item" data-action="remove"></a>
								</div>
							</div>
						</div>';

						$hasil = array();
						$total = array();
						foreach($data['alternatif'] as $i => $r){
							$id_alternatif = $r['id_alternatif'];
							$tot = 0;
							foreach ($data['kr'] as $j => $r2) {
								$hasil[$id_alternatif][$j] = $normal[$id_alternatif][$j]*($r2['bobot']/10);
								$tot = $tot+$hasil[$id_alternatif][$j];
							}
							$total[$id_alternatif] = $tot;
						}

						$body .= '
						<div class="card-body collapse show" id="print_call">
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Alternatif</th>';
										foreach($data['kr'] as $i => $r){
											$body .= '<th>C'.($i+1).'</th>';
										}
										$body .= '
										<th>Total</th>
									</tr>
								</thead>
								<tbody>';
								arsort($total);
								$no = 1;
								foreach($total as $i => $r){
									$r2 = select2("alternatif","*","WHERE id_alternatif='$i'");
									$body .= '
									<tr>
										<td>'.$no.'</td>
										<td>'.$r2['name'].'</td>';
										$tot = 0;
										foreach ($data['kr'] as $j => $r2) {
											$body .= '<td>'.number_format($hasil[$i][$j],2).'</td>';
											$tot = $tot+$hasil[$i][$j];
										}
									$body .= '
										<td>'.$tot.'</td>
									</tr>';

									$r3 = select2("hasil","*","WHERE id_alternatif='$i' AND tahun='$data[thn]'");

									if($r3==NULL){
										$id_new = generate_id("hasil");
										$created = date('Y-m-d H:i:s');
										insert("hasil","","('$id_new','$i','$tot','$data[thn]','0','$created')");
									}
									else{
										update("hasil","nilai='$tot'","WHERE id_alternatif='$i' AND tahun='$data[thn]'");
									}
									$no++;
								}
								$body .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>';
		}

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