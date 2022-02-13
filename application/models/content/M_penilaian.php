<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penilaian extends CI_Model {
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
		level_check($data['sLevel'],'1,2',1);

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

		$data['thn'] = '';
		# Jika ada get thn
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		$condition = "";
		if($data['sLevel']!='1'){
			$condition = "AND id_alternatif='$data[sUserTable]'";
		}

		$data['kr'] = select("kriteria","*","WHERE flag_aktif='1' ORDER BY created ASC");
		# load table alternatif
		$data['alt'] = select("alternatif","*","WHERE EXISTS (SELECT * FROM $data[table] WHERE alternatif.id_alternatif=$data[table].id_alternatif AND $data[table].tahun='$data[thn]') $condition");

		return $data;
	}

	public function data(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'data';

		$title = '
		<form action="'.base_url().'pages/content/'.urinext('content').'/add" method="post" id="commentForm" class="form-horizontal cmxform" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="control-label col-md-3">Periode Tahun :</label>
				<div class="col-md-4">
					<select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn" onChange="window.location=(\''.base_url().'pages/content/'.$data['table'].'/data?thn=\'+this.value)" required>
						<option value="">Select ...</option>';
	        			foreach (year(2021) as $i => $r) {
		                  	$select = '';
                        	if($r==$data['thn'])
                        		$select = 'selected';

                            $title .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
		                }
	            		$title .= '
					</select>
					<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
				</div>
			</div>
		</form>';

		$ptitle = array($title);

		# Tampilan tabel penilaian alternatif
		$body = '
		<table class="table datatables table-striped table-bordered" width="100%">
            <thead>
                <tr>
					<th class="center">No</th>
					<th class="center">Alternatif</th>
					<th class="center">Kriteria</th>
					<th class="center">Sub Kriteria</th>
					<th class="center">Nilai</th>
                	<th>Action</th>
                </tr>
            </thead>
			<tbody>';
			# Melakukan perulangan sebanyak data alternatif yang ada
            foreach ($data['alt'] as $i => $r) {
                $body .= '
                <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$r['name'].'</td>
					<td>';
					# Melakukan perulangan sebanyak data kriteria yang ada
                    foreach ($data['kr'] as $j => $r2) {
                        $body .= $r2['name'].'<br>';
                    }
                $body .= '
                	</td>
					<td>';
					# Melakukan perulangan sebanyak data kriteria yang ada
                    foreach ($data['kr'] as $j => $r2) {
                    	$r3 = select2($data['table'],"nilai","WHERE id_alternatif='$r[id_alternatif]' AND $data[table].id_kriteria='$r2[id_kriteria]' AND $data[table].tahun='$data[thn]'");
						$r4 = select2("sub_kriteria","*","WHERE id_kriteria='$r2[id_kriteria]' AND nilai='$r3[nilai]'");
                        $body .= $r4['name'].'<br>';
                    }
                $body .= '
                	</td>
					<td>';
					# Melakukan perulangan sebanyak data kriteria yang ada
                    foreach ($data['kr'] as $j => $r2) {
                    	$r3 = select2($data['table'],"nilai","WHERE id_alternatif='$r[id_alternatif]' AND $data[table].id_kriteria='$r2[id_kriteria]' AND $data[table].tahun='$data[thn]'");
                        $body .= $r3['nilai'].'<br>';
                    }
                $body .= '
                	</td>
					<td>
						<a href="'.base_url().'pages/content/'.urinext('content').'/edit/id/'.$r['id_alternatif'].'?thn='.$data['thn'].'" class="btn btn-info"><i class="fa fa-pencil"></i></a>
						<a href="'.base_url().'pages/content/'.urinext('content').'/action/delete/id/'.$r['id_alternatif'].'?thn='.$data['thn'].'" class="btn btn-danger" onClick="return confirm(\'ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?\')"><i class="fa fa-trash"></i></a>
					</td>
                </tr>';
            }
            $body .= '
            </tbody>
        </table>';

		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function add(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'add';
		$ptitle = array($data['back']);

		$thn = $this->input->post('thn');

		# Tampilan form add penilaian alternatif
		$body = '
		<form action="'.base_url().'pages/content/'.urinext('content').'/action/add" method="post" id="commentForm" class="form-horizontal cmxform" enctype="multipart/form-data">
			<input type="hidden" class="form-control" name="thn" id="thn" value="'.$thn.'">
			<div class="form-group row">
				<label class="control-label col-md-5">Alternatif :</label>
				<div class="col-md-5">
					<select class="form-control select2" data-placeholder="Select ..." name="alt" id="alt" required>
						<option value="">Select ...</option>';
						# load table alternatif
						$sl = select("alternatif","*","WHERE NOT EXISTS (SELECT * FROM $data[table] WHERE alternatif.id_alternatif=$data[table].id_alternatif AND $data[table].tahun='$thn')");
						# Melakukan perulangan sebanyak data alternatif yang ada
						foreach ($sl as $i => $r) {
		                  	$body .= '<option value="'.$r['id_alternatif'].'">'.$r['name'].'</option>';
		                }
	            		$body .= '
            		</select>
				</div>
			</div>
			<br><h4 style="font-weight: bold; color: red;">Kriteria</h4>';
			# Melakukan perulangan sebanyak data kriteria yang ada
			foreach ($data['kr'] as $i => $r) {
				$body .= '
				<div class="form-group row">
					<label class="control-label col-md-5">'.$r['name'].' :</label>
					<div class="col-md-5">
						<select class="form-control select2" data-placeholder="Select ..." name="k_'.$i.'" id="k_'.$i.'" required>
							<option value="">Select ...</option>';
							$sub = select("sub_kriteria","*","WHERE id_kriteria='$r[id_kriteria]' ORDER BY nilai");
							foreach ($sub as $j => $r2) {
								$body .= '<option value="'.$r2['nilai'].'">'.$r2['name'].'</option>';
							}
							$body .= '
						</select>
					</div>
				</div>';
			}
		$body .= '
			<div class="form-group row">
				<label class="control-label col-sm-5"></label>
				<div class="col-sm-5">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>';

		$pbody = array($body);
		$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		return $data;
	}

	public function edit(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$action = string(urinext('edit'));
		$id = string(urinext('id'));
		if(!empty($action) && !empty($id)){
			$data['ACTION'] = 'edit';
			$ptitle = array($data['back']);
			
			# load table alternatif berdasarkan id_alternatif
			$rr = select2("alternatif","name","WHERE id_alternatif='$id'");

			# Tampilan form edit penilaian alternatif
			$body = '
			<form action="'.base_url().'pages/content/'.urinext('content').'/action/edit/id/'.$id.'" method="post" id="commentForm" class="form-horizontal cmxform" enctype="multipart/form-data">
				<input type="hidden" class="form-control" name="thn" id="thn" value="'.$data['thn'].'">
				<div class="form-group row">
					<label class="control-label col-md-5">Alternatif :</label>
					<div class="col-md-5">
						<input type="hidden" class="form-control" name="alt" id="alt" value="'.$id.'" required readonly>
						<input type="text" class="form-control" name="alt2" id="alt2" value="'.$rr['name'].'" readonly>
					</div>
				</div>
				<br><h4 style="font-weight: bold; color: red;">Kriteria</h4>';
				# Melakukan perulangan sebanyak data kriteria yang ada
				foreach ($data['kr'] as $i => $r) {
					$r3 = select2($data['table'],"nilai","WHERE id_alternatif='$id' AND id_kriteria='$r[id_kriteria]' AND tahun='$data[thn]'");
					$body .= '
					<div class="form-group row">
						<label class="control-label col-md-5">'.$r['name'].' :</label>
						<div class="col-md-5">
							<select class="form-control select2" data-placeholder="Select ..." name="k_'.$i.'" id="k_'.$i.'" required>
								<option value="">Select ...</option>';
								$sub = select("sub_kriteria","*","WHERE id_kriteria='$r[id_kriteria]' ORDER BY nilai");
								foreach ($sub as $j => $r2) {
									$select = '';
									if($r2['nilai']==$r3['nilai']){
										$select = 'selected';
									}
									$body .= '<option value="'.$r2['nilai'].'" '.$select.'>'.$r2['name'].'</option>';
								}
								$body .= '
							</select>
						</div>
					</div>';
				}
			$body .= '
				<div class="form-group row">
					<label class="control-label col-sm-5"></label>
					<div class="col-sm-5">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>';

			$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']);
		}
		return $data;
	}

	public function view(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

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
				$thn = $this->input->post('thn');
				$input[1] = $this->input->post('alt');

				# Jika edti
				if($act=='edit'){
					$id = string(urinext('id'));
					# delete data penilaian berdasarkan id_alternatif
					$crud = delete($data['table'],"WHERE id_alternatif='$id' AND tahun='$thn'");
				}

				$values = "";
				# Melakukan perulangan sebanyak data kriteria yang ada
				foreach ($data['kr'] as $i => $r) {
					# generate id otomatis
					$id_new = generate_id($data['table']);
					$nilai = $this->input->post('k_'.$i);
					$created = date('Y-m-d H:i:s');
					$values .= "('$id_new','$input[1]','$r[id_kriteria]','$nilai','$thn','$created'),";
					
				}
				# insert ke table penilaian
				$crud = insert($data['table'],"",rtrim($values,','));
				$to .= '?thn='.$thn;

			}
			# Jika action adalah delete
			elseif($act='delete'){
				$id = string(urinext('id'));
				# delete table penilaian berdasarkan id_alternatif dan tahun terpilih
				$crud = delete($data['table'],"WHERE id_alternatif='$id' AND tahun='$data[thn]'");
				$to .= '?thn='.$data['thn'];
			}

			//$crud = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($to,$crud,$type=0,$message);
		}
	}
}