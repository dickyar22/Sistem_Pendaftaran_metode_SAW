<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_osis extends CI_Model {
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
									<h2 class="title">OSIS</h2>
									<p class="desc">
										<img src="'.base_url().'img/osis.png" alt="Image" style="width: 100%; height: 700px;">
									</p>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top: 30px;">
								<div class="list-skills">
									<h2 class="title">Visi dan Misi</h2>
									<p class="desc">
										<span>
											Pembina Osis : Yohanis Marthen, S.Pd <br>
											Ketua : Fathir Egy Mahendra <br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>memimpin organisasi dengan baik dan bijaksana</li>
											<li>Mengkoordinasikan semua aparat kepengurusan</li>
											<li>Memimpin rapat</li>
											<li>Mengevaluasi kegiatan aparat kepengurusan</li>
											<li>Menyusun rencana kerja </li>
											<li>Melaksanakan kegiatan yang sudah ada </li>
											<li>Mengkoordinir kegiatan ekstrakulikuler</li>
											<li>Menjalin komunikasi dengan sekolah lain</li>
										</ul>
										<br>
										<span class="desc">
											Wakil Ketua : Muhammad Nur Septianto <br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>Bersama-sama ketua menetapkan kebijakan</li>
											<li>Memberikan saran kepada ketua dalam rangka mengambil keputusan</li>
											<li>Mengganti ketua jika berhalangan</li>
											<li>Membantu ketua melaksanakan tugasnya</li>
										</ul>
										<br>
										<span class="desc">
											Sekertaris I : Siti Aulia Rahmadani<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>memberi saran dan masukan kepada ketua dalam mengambil keputusan</li>
											<li>Mendampingi ketua dalam memimpin setiap rapat</li>
											<li>Menyiapkan Laporan , surat , agenda, dan hasil rapat serta evaluasi kegiatan</li>
											<li>Melaksanakan program osis</li>
										</ul>
										<br>
										<span class="desc">
											Sekertaris II : Laras Putri Andini<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>Aktif membantu pelaksanaan tugas sekertaris</li>
											<li>Mengganti sekertaris I jika berhalangan</li>
											<li>Membantu wakil ketua mengkoordinir seksi bidang</li>
										</ul>
										<br>
										<span class="desc">
											Bendahara : Sonia Putri Indah Sari<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>menyusun anggaran belanja organisasi</li>
											<li>Menyampaikan laporan keuangan secara berkala</li>
											<li>Melaksanakan program osis</li>
										</ul>
										<br>
										<span class="desc">
											Ketua Koordinator I : Andika Dimas A.M.<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>bertanggung jawab atas seluruh kegiatan bidang yang menjadi tanggung jawabnya</li>
											<li>Melaksanakan kegiatan bidang yang telah diprogramkan</li>
											<li>Menyampaikan laporan pertanggung jawaban pelaksanaan kegiatan bidang kepada coordinator bidang.</li>
											<li>Bertanggung jawab kepada ketua osis</li>
										</ul>
										<br>
										<span class="desc">
											Ketua Koordinator II : Ahmad M<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>aktif membantu pelaksanaan tugas ketua coordinator I</li>
											<li>Menggantikan ketua coordinator I jika berhalangan</li>
										</ul>
										<br>
										<span class="desc">
											Hubungan Masyarakat I : Eka Putri Firdayanti<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>Membantu ketua dalam pelaksanaan rapat atau kegiatan sebagai juru bicara</li>
											<li>Menjelaskan isi rapat kepada pengurus osis</li>
										</ul>
										<br>
										<span class="desc">
											Hubungan Masyarakat II : Irmansyah<br>
											Tugas :
										</span> <br>
										<ul class="desc">
											<li>Membantu pelaksanaan tugas ketua Humas I</li>
											<li>Menggantikan ketua humas jika berhalangan</li>
										</ul>
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