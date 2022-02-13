<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; */

class M_user extends CI_Model {
	public function __construct(){
		parent::__construct();
		/* require APPPATH.'libraries/phpmailer/src/Exception.php';
		require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
		require APPPATH.'libraries/phpmailer/src/SMTP.php'; */
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
			//'datepicker',
			//'timepicker',
			'datetimepicker',
			//'currency',
			//'ckeditor',
			//'dropzonejs',
			'modal_detail',
			'form_event',
			'captcha',
			//'api',
			//'addrow', 
			//'highcharts',
			//'countdown',
		);

		$data['CONTENT_TITLE'] = str_uri(urinext('content'),1);
		$data['CONTENT'] = '';
		$data['component'] = 'card';
		$data['table'] = str_uri(urinext('content'),2);
		$data['field'] = "*";
		$data['condition'] = "ORDER BY created DESC";
		$data['field_control'] = array(
			'id_user'=>array(
				'name'=>'ID '.$data['CONTENT_TITLE'],
				'attributes'=>'required readonly',
				'placeholder'=>'required',
				// 'multiple'=>'[]',
				// 'event'=>'onchange="on_event(this.value)"',
				'value'=>'',
				'list'=>'',
				'list_type'=>'',
				'after'=>'',
				//'replace'=>'',
			),
			'username'=>array(
				'name'=>'Username',
				'attributes'=>'required',
				'placeholder'=>'',
				// 'multiple'=>'[]',
				'event'=>'onkeyup="unique(\''.urinext('content').'/unique\',this.id,this.value)"',
				'value'=>'',
				'list'=>'',
				'list_type'=>'',
				'after'=>'',
				//'replace'=>'',
			),
			'password'=>array(
				'name'=>'Password',
				'attributes'=>'required',
				'placeholder'=>'',
				// 'multiple'=>'[]',
				// 'event'=>'onchange="on_event(this.value)"',
				'value'=>'',
				'list'=>'',
				'list_type'=>'',
				'after'=>'',
				//'replace'=>'',
			),
			'id_user_level'=>array(
				'name'=>'Level',
				'attributes'=>'required',
				'placeholder'=>'',
				// 'multiple'=>'[]',
				'event'=>'onchange="select_list(\''.urinext('content').'/select_list\',\'id_user_table\',this.value)"',
				'value'=>'',
				'list'=>select("user_level","*",""),
				'list_type'=>'1',
				'after'=>'',
				//'replace'=>'',
			),
			'id_user_table'=>array(
				'name'=>'User Table',
				'attributes'=>'required',
				'placeholder'=>'',
				// 'multiple'=>'[]',
				// 'event'=>'onchange="on_event(this.value)"',
				'value'=>'',
				//'list'=>select("exhibitor","*",""),
				//'list_type'=>'1',
				'after'=>'',
				//'replace'=>'',
			),
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
		level_check($data['sLevel'],'1',1);

		$data = $this->start();
		$data['ACTION'] = 'data';
		/* $title = '
		<form action="'.$data['url'].'import" method="post" id="commentForm" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="control-label col-sm-3">Import Data</label>
				<div class="col-sm-9">
					<input type="file" class="form-control" name="import" id="import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3"></label>
				<div class="col-sm-9">
					<a href="'.base_url().'upload/excel/user.xlsx" class="btn btn-danger"><i class="fa fa-download"></i> Examples</a>
					<button type="submit" class="btn btn-primary" style="margin-top: -3px;"><i class="fa fa-upload"></i> Import</button>';
					$title .= '
					<a href="'.base_url().'report/export/export_excel/excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</a>';
				$title .= '
				</div>
			</div>
		</form>'; */

		$ptitle = array($data['add']);

		$data['field_control']['password']['replace'] = '';
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

			$body = form($input_field,$action='edit/id/'.$id,$form_id='').'
					<script>
						select_list(\''.urinext('content').'/select_list\',\'id_user_table\',id_user_level.value,\''.$values['id_user_table'].'\');
					</script>';
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

				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$options = [
					'cost' => 12,
				];
				$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
				
				# Jika add
				if($act=='add'){
					$input['password'] = $password_hash;

					# Cek username pada table user
					$r = select2($data['table'],"username","WHERE username='$username'");
					if($r!=NULL){
						echo '
						<script>
							window.alert("Failed! Username Already Registered");
							window.location=("javascript:history.go(-1)");
						</script>';
						exit();
					}

					/* if($this->session->userdata('ei_login')==FALSE){
						if(strlen($username)<8 || strlen($password)<8) {
							echo '
							<script>
								window.alert("Failed! Username & Password at Least 8 Characters !");
								window.location=("javascript:history.go(-1)");
							</script>';
							exit();
						}
						
						$uppercase = preg_match('@[A-Z]@', $password);
						$lowercase = preg_match('@[a-z]@', $password);
						$number    = preg_match('@[0-9]@', $password);

						if(!$uppercase || !$lowercase || !$number){
							echo '
							<script>
								window.alert("Failed! Password Must Contain Numbers and Letters !");
								window.location=("javascript:history.go(-1)");
							</script>';
							exit();
						}

						$captcha		= $_POST['g-recaptcha-response'];
						$secretKey		= "6Lf7WCUTAAAAAGJzZ-U_aPv5GiGLEOExXDFpI_PM";
						$ip 			= $_SERVER['REMOTE_ADDR'];
						$response		= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
						$responseKeys	= json_decode($response,true);

						if(intval($responseKeys["success"]) !== 1) {
							echo '
							<script>
								window.alert("Failed! Spam Detected !");
								window.location=("javascript:history.go(-1)");
							</script>';
							exit();
						}
					} */

					if($this->session->userdata('ei_login')==FALSE){
						$password2 = $this->input->post('password2');
						if($password!=$password2){
							echo '
							<script>
								window.alert("Failed! Password Confirmation Salah !");
								window.location=("javascript:history.go(-1)");
							</script>';
							exit();
						}
						
						$input['id_user_level'] = 2;
						$input['fullname'] = $this->input->post('fullname');
						$input['flag_aktif'] = 1;

						/* $email = $this->input->post('email');
						$pesan = 'Klik <a href="'.base_url().'pages/content/activate/data/id/'.$id_new.'"> link </a> ini untuk melakukan verifikasi';
						$this->send_email($email,"Register Verification",$pesan); */

						$created = date('Y-m-d H:i:s');

						$id_new2 = generate_id("alternatif");
						$input['id_user_table'] = $id_new2;
						insert("alternatif","id_alternatif,name,flag_aktif,created,modified","('$id_new2','$input[fullname]','1','$created','$created')");
					}
				}
				elseif($act=='edit'){
					$id = string(urinext('id'));
					$r = select2($data['table'],"*","WHERE id_$data[table]='$id'");
				    
				    if($r['password']!=$password){
				        $input['password'] = $password_hash;
				    }
				    else{
				        $input['password'] = $password;
				    }
				}
			}
			elseif($act=='delete'){
				$id = string(urinext('id'));
			}

			$crud = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			$type = 0;
			if($act=='add'){
				if($this->session->userdata('ei_login')==FALSE){
					$message[0] = 'Register Success!';
					$type = 1;
					echo '
					<script>
						window.alert("Register Success !!!");
						window.location=("'.base_url().'pages/login");
					</script>';
					exit();
				}
			}
			message($to,$crud,$type,$message);
		}
	}

	public function import(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'1',1);
		
		$data = $this->start();
		if(isset($_FILES['import']['name'])){
			$data['ACTION'] = 'import';
			$ptitle = array($data['back']);

		  	$d = $this->read_excel("upload/data.xlsx",$data['table']);
		  	/* $body = '';
		  	foreach ($d as $i => $r) {
		  		foreach ($r as $j => $r2) {
		  			foreach ($r2 as $k => $r3) {
		  				$body .= $r3.' ';
		  			}
		  			$body .= '<br>';
		  		}
		  		$body .= $i.'<br><br>';
		  	}

		  	$pbody = array($body);
			$data['CONTENT'] = content($ptitle,$pbody,$data['component']); */

			redirect('pages/content/'.urinext('content').'/data');
		}
		return $data;
	}

	public function read_excel($file_path,$table=''){
		if(is_file($file_path)){
			unlink($file_path);
		}

		$input = basename($_FILES['import']['name']);
		$explode = explode('.',$input);
		$ext_input = end($explode);
		$ext = array('xls','xlsx','csv');

		$data = array();
		if(in_array($ext_input, $ext)) {
			require('themes/assets/PHPExcel/PHPExcel/IOFactory.php');
			$tmp_file = $_FILES['import']['tmp_name'];
			move_uploaded_file($tmp_file, $file_path);

			/* if(!empty($table)){
				truncate($table);
			} */
			
			$values = "";
			$PHPExcel = PHPExcel_IOFactory::load($file_path);
			foreach ($PHPExcel->getWorksheetIterator() as $index => $sheet){
				$st = $sheet->getTitle();
				//$row = $sheet->getHighestRow();
				//$column = $sheet->getHighestDataColumn();
				$field = "id_$table,created";
				foreach ($sheet->getRowIterator() as $i => $r) {
					$j = 0;
					$value = "";
					foreach ($r->getCellIterator() as $cell => $r2) {
						if($i==1){
							$field .= ",".$r2->getCalculatedValue();
						}
						if($i>1){
							//$val = $sheet->getCellByColumnAndRow($c, $i)->getCalculatedValue();
							$data[$st][$i][$j] = $r2->getCalculatedValue();
							if(PHPExcel_Shared_Date::isDateTime($r2)) {
								$data[$st][$i][$j] = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP($data[$st][$i][$j])); 
							}
							elseif($cell=='B'){
								$options = [
									'cost' => 12,
								];
								$data[$st][$i][$j] = password_hash($data[$st][$i][$j], PASSWORD_BCRYPT, $options);
							}
							$value .= ",'".$data[$st][$i][$j]."'";
							$j++;
						}
					}

					if(!empty($table)){
						if($i>1){
							$id_new = generate_id($table);
							$created = date('Y-m-d H:i:s');
							$values .= "('$id_new','$created' $value),";
						}
					}
				}
			}
			if(!empty($table)){
				insert($table,$field,rtrim($values,','));
				redirect('pages/content/'.urinext('content').'/data');
			}
			else{
				return $data;
			}
		}
		else{
			echo '
			<script>window.alert("Failed! Hanya File Excel Yang Diperbolehkan !!!");
			window.location=("'.base_url().'pages/content/'.urinext('content').'/data")</script>';
		}
	}

	public function send_email($to,$subject,$message){
		$response = false;
		$mail = new PHPMailer();

		$r = select2("setting_email","*","");

		// SMTP configuration
		$mail->isSMTP();
		$mail->Host     = $r['smtp_host'];
		$mail->SMTPAuth = true;
		$mail->Username = $r['smtp_user'];
		$mail->Password = $r['smtp_pass'];
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = $r['smtp_port'];

		$mail->setFrom($r['fromm'],$r['name']);
		$mail->addAddress($to);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $message;

		if(!$mail->send()){
			return $mail->ErrorInfo;
		}
		else{
			return TRUE;
		}
	}
}