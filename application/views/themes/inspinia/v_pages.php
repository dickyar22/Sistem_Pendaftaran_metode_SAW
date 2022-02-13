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
	<div id="wrapper">
		<!-- Side Bar -->
		{SIDEBAR}

		<div id="page-wrapper" class="gray-bg">
			<!-- Header -->
			{HEADER}

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