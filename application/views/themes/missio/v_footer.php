
<footer class="dark-wrapper inverse-text" style="background-color: #E76D00">
	<div class="container inner pt-30 pb-30 text-center">
	<div class="row d-md-flex align-items-md-center">
		<div class="col-md-6 text-center text-md-left">
		<p class="mb-0">&copy; 2020. Created by <a href="http://ascode.id" target="_blank" style="color: white">asCode.id - Adryan Sudarman</p>
		</div>
		<div class="col-md-6 text-center text-md-right">
		<ul class="social social-mute social-s mt-10">
		<?php
			$info = select2("info","*","WHERE flag_aktif='1'");
			echo '
			<li>
				<a href="mailto: '.$info['email'].'" style="color: white"><i class="fa fa-envelope"></i>
				'.$info['email'].'
				</a>
			</li>
			<li>
				<a href="https://instagram.com/'.$info['instagram'].'" target="_blank" style="color: white"><i class="fa fa-instagram"></i>
				'.$info['instagram'].'
				</a>
			</li>
			<li>
				<a href="https://api.whatsapp.com/send?phone='.$info['phone'].'" target="_blank" style="color: white"><i class="fa fa-whatsapp"></i>
				'.$info['phone'].'
				</a>
			</li>';
		?>
		</ul>
		</div>
		<!--/column -->
	</div>
	<!--/.row -->
	</div>
	<!-- /.container -->
</footer>