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
	<div class="page">
		<!-- Preloader -->
		<div class="preloader">
			<div class="centrize full-width">
				<div class="vertical-center">
					<div class="spinner">
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Header -->
		{HEADER}

		<!-- Side Bar -->
		{SIDEBAR}

		<!-- Content -->
		{CONTENT}
		
		<!-- Footer -->
		{FOOTER}
	<div>
    <!-- Jquery (Javascript) -->
    {ACE}
	{JS}
	{JS_ASSETS}
</body>
</html>