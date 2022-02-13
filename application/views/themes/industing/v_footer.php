<footer class="footer_01">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-md-3 col-lg-3 noPaddingRight">
				<aside class="widget">
					<div class="about_widget">
						<a href="{BASE_URL}"><img src="{BASE_URL}img/logo2.png" alt="Image"></a>
						<p>
						PT. PUTERA WIJAYA KUSUMAH ABADI
						Gedung 18 Office Park, Lt. 25, Suite A 2
						Jl. TB Simatupang Kav. 18
						Kel. Kebagusan, Kec. Pasar Minggu
						Jakarta Selatan 12520
						</p>
						<div class="caller">
							<i class="fab fa-whatsapp"></i>
							<span>Talk to Our Officers</span>
							<h3><a href="https://wa.me/6281388600358?text=">0813-8860-0358</a></h3>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-xl-3 col-md-3 col-lg-3 pdl45 noPaddingRight">
				<aside class="widget">
					<h3 class="widget_title">Important Links<span>.</span></h3>
					<ul>
						<li><a href="{BASE_URL}">Home</a></li>
						<li><a href="{BASE_URL}pages/content/product/data">Product Catalogue</a></li>
					</ul>
				</aside>
			</div>
			<div class="col-xl-3 col-md-3 col-lg-3">
				<aside class="widget pdl20">
					<h3 class="widget_title">Product Catalogue<span>.</span></h3>
					<ul>
					<?php
						$category = select("category","*","WHERE flag_aktif='1' ORDER BY created DESC");
						foreach($category as $i => $r){
							echo '<li><a href="#">'.$r['name'].'</a></li>';
						}
					?>
					</ul>
				</aside>
			</div>
			<div class="col-xl-3 col-md-3 col-lg-3">
				<aside class="widget subscribe_widget">
					<h3 class="widget_title">Get More Here<span>.</span></h3>
					<div class="socials">
						<a href="https://www.facebook.com/PuteraWijayaKusumahAbadi/"><i class="fab fa-facebook-f"></i></a>
						<a href="https://www.instagram.com/pwk_abadi/"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-linkedin"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-youtube"></i></a>
					</div>
				</aside>
			</div>
		</div>
	</div>
</footer>
<section class="copyright_section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="siteinfo">
					&copy; 2020. Created by <a href="http://ascode.id" target="_blank">asCode.id - Adryan Sudarman</a>
				</div>
			</div>
		</div>
	</div>
</section>

<a href="#" id="backtotop"><i class="fal fa-angle-double-up"></i></a>