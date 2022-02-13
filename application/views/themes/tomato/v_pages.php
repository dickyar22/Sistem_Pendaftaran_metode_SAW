<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<!-- TITLE -->
	{TITLE}
	
	<!-- CSS -->
	{HEAD}
	{HEAD_ASSETS}

	<style>
	.button {
		width: 200px;
		height: 200px;
		border: 0;
		padding: 20px;
		margin: 0;
		position: relative;
		}
	</style>
</head>
<body id="intro3">
	<!-- <div class="preloder animated">
        <div class="scoket">
            <img src="{BASE_URL}/img/preloader.svg" alt="" />
        </div>
	</div> -->
	<div class="body">
		<!-- Header -->
		{HEADER}

		<!-- Side Bar -->
		{SIDEBAR}

		<?php
		if(urinext('content')==''){
			$html = '';
			if($this->session->userdata('ei_session')==TRUE){
				$id = $this->session->userdata('ei_branch');
				$r = select2("branch","*","WHERE id_branch='$id'");
				$html .= '
				<h2>Your Restaurant : '.$r['name'].'</h2>';
			}
			else{
				$html .= '
				<h2>Choose Your Restaurant</h2> <br><br>
				<center>
					<div class="row">';
						$branch = select("branch","*","WHERE flag_aktif='1'");
						foreach($branch as $i => $r){			
							$html .= '
							<div class="col-sm-4" style="margin-bottom: 10px;">
								<a href="'.base_url().'pages/session/'.$r['id_branch'].'" class="btn btn-default btn-lg button" style="border-radius: 12px;">
									<i class="fa fa-map-marker fa-3x"></i> <br><br>
									<small> '.wordwrap($r['name'], 15, '<br>', false).' </small>
								</a>
							</div>';
						}
					$html .= '
					</div>
				</center>';
			}
			echo '
			<section class="home">
				<div class="overlay"></div>
				<div class="tittle-block">
					<div class="logo"></div>
					<h1>LANGIT SEDUH</h1>
					'.$html.'
				</div>
			</section>';
		}
		?>
        
		<div class="main-wrapper">
			<!-- Content -->
			{CONTENT}

			<!-- Footer -->
			{FOOTER}
		</div>
	</div>

    <!-- Jquery (Javascript) -->
    {ACE}
	{JS}
	{JS_ASSETS}
</body>
</html>