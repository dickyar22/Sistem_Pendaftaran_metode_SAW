<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_about extends CI_Model {
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
		//level_check($data['sLevel'],'1',1);

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
		$data['table'] = str_uri(urinext('content'),2);
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

		if($this->session->userdata('ei_login')==TRUE){
			$ptitle = array($data['add']);

			# Create Table
			$body = table(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$data['flag'],
				$data['action']
			);

			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		else{
			$body = '
			<section class="aboutus-skillls section-padding-large">
				<div class="container">
					<div class="our-skillls-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="list-skills">
									<h2 class="title">Sejarah SMP Negeri 16 Kabupaten Sorong</h2>
									<p class="desc">
										SMPN 16 Kab.Sorong didirikan tahun 2011 dan mulai beroperasi tahun 2012 dengan jumlah guru 3 orang dan kepala sekolah. Kemudian terus berkembang hingga tahun 2020 memiliki guru pelajaran yang sudah lengkap.
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Visi dan Misi</h2>
									<p class="desc">
										<span>Visi</span> <br>
										<ul class="desc">
											<li>Terwujudnya peserta didik yang Beriman , Cerdas, Terampil dan Mandiri</li>
										</ul>
										<br>
										<span class="desc">Misi</span> <br>
										<ul class="desc">
											<li>Menanamkan Keimanan dan Ketagwaan Melalui pelajaran Agama</li>
											<li>Mengoptimalkan Proses Pembelajaran dan Bimbingan</li>
											<li>Membina Kemandirian Peserta Didik Melalui Kegiatan Pembiasaan, Kewirausahaan, dan Pengembangan diri yang Terencana serta berkesinambungan.</li>
										</ul>
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Data Ruang Kelas</h2>
									<p class="desc">
										<table class="table" width="100%">
											<thead>
												<tr>
													<th>Tahun Ajar</th>
													<th colspan="3">Jumlah ruangan kelas asli</th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>2020/2021</td>
													<td>Ukuran 7 x 9 m^2</td>
													<td>Ukuran 7 x 9 m^2</td>
													<td>Ukuran 7 x 9 m^2</td>
												</tr>
												<tr>
													<td></td>
													<td>a</td>
													<td>b</td>
													<td>c</td>
												
												</tr>
												<tr>
													<td>Ruang Kelas</td>
													<td>1</td>
													<td>2</td>
													<td>1</td>
													
												</tr>
											</tbody>
										</table>
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Data Ruang Lain</h2>
									<p class="desc">
										<table class="table" width="100%">
											<thead>
												<tr>
													<th>Jenis ruangan</th>
													<th>Jumlah ruangan</th>
													<th>ukuran</th>
												
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Perpustakaan</td>
													<td>1</td>
													<td>5 x 7 m^2</td>
												
												
												</tr>
												<tr>
													<td>kantor</td>
													<td>1</td>
													<td>5 x 7 m^2</td>
				
													
												</tr>
												<tr>
													<td>LAB IPA</td>
													<td>1</td>
													<td>7 x 12 m^2</td>
												
													
												</tr>
												<tr>
													<td>Lab Komputer</td>
													<td>1</td>
													<td>5 x 7 m^2</td>
												
												
												</tr>
												<tr>
													<td>Wc Guru</td>
													<td>1</td>
													<td>3 x 7 m^2</td>
												
												
												</tr>
												<tr>
													<td>Wc Siswa</td>
													<td>1</td>
													<td>3 x 4 m^2</td>
												
												
												</tr>
											</tbody>
										</table>
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Data guru dan tata usaha</h2>
									<p class="desc">
										<table class="table" width="100%">
											<thead>
												<tr>
													<th colspan="2">Jumlah guru / staf SMP Negeri 16</th>
													<th>Jumlah guru/Staf</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Guru tetap (PNS )</td>
													<td>9 orang</td>
													<td rowspan="6">13 orang</td>
													<td></td>
												</tr>
												<tr>
													<td>Guru Kontrak</td>
													<td>2 orang</td>
													<td></td>
												</tr>
												<tr>
													<td>Guru suka rela/Honorer</td>
													<td>2 orang</td>
													<td></td>
												</tr>
												<tr>
													<td>Staf TU (PNS)</td>
													<td>-</td>
													<td></td>
												</tr>
												<tr>
													<td>Staf TU (non PNS)</td>
													<td>-</td>
													<td></td>
												</tr>
												<tr>
													<td>Staf Perpustakaan</td>
													<td>-</td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Struktur Sekolah</h2>
									<p class="desc">
										<img src="'.base_url().'img/struktur.png" alt="Image" style="width: 100%; height: 400px;">
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>';
			$data['CONTENT'] = $body;
		}
		
		return $data;
	}

	public function add(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'add';
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

		$body = form($input_field,$action='add',$form_id='');
		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function edit(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$action = string(urinext('edit'));
		$id = string(urinext('id'));
		if(!empty($action) && !empty($id)){
			$data['ACTION'] = 'edit';
			$ptitle = array($data['back']);

			$values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			/* $data['field_control']['file']['attributes'] = '';
			$data['field_control']['img']['attributes'] = ''; */
			
			# Create Form
			$input_field = input_field(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$values,
				$data['extra']
			);

			$body = form($input_field,$action='edit/id/'.$id,$form_id='');
			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		return $data;
	}

	public function view(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$action = string(urinext('view'));
		$id = string(urinext('id'));
		if(!empty($action) && !empty($id)){
			$data['ACTION'] = 'view';
			$ptitle = array($data['back']);
			$values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			
			# Create Form View
			$body = view(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['field_control'],
				$data['start'],
				$values,
				$data['extra']
			);

			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		return $data;
	}

	public function action(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);
		
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