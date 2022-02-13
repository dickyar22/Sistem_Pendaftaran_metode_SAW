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
</head>
<body>
	<!-- Preloading -->
	<div class="preloader text-center">
		<div class="la-ball-scale-multiple la-2x">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<!-- Preloading -->

	<!-- Header -->
	{HEADER}

	<!-- Side Bar -->
	{SIDEBAR}
	
	<?php
	if(urinext('content')=='' || urinext('content')=='home'){
		echo '
		<section class="slider_01">
			<div class="rev_slider_wrapper">
				<div id="rev_slider_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
					<ul>
						<li data-index="rs-3045" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="images/slider/t_1.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
							<img src="'.base_url().'img/1.jpg"  alt="Image"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						</li>
					</ul>
				</div>
			</div>
		</section>';
	}
	?>

	<!-- Content -->
	{CONTENT}

	<!-- Footer -->
	{FOOTER}

    <!-- Jquery (Javascript) -->
    {ACE}
	{JS}
	{JS_ASSETS}
</body>
</html>