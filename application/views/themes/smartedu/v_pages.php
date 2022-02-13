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
	<div class="images-preloader">
	    <div id="preloader_1 spinner1" class="spinner1 rectangle-bounce">
	    	<div class="double-bounce1"></div>
	    	<div class="double-bounce2"></div>
	    </div>
	</div>

	<!-- Header -->
	{HEADER}

	<main>
		<!-- Side Bar -->
		{SIDEBAR}

		<!-- Content -->
		{CONTENT}
	</main>

	<!-- Footer -->
	{FOOTER}

    <!-- Jquery (Javascript) -->
    {ACE}
	{JS}
	{JS_ASSETS}
</body>
</html>