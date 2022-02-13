<?php
session_start();
$_SESSION['username'] = "Robby Prihandaya" // Must be already set
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >
<html>
<head>
<title>Aplikasi Chat Sederhana</title>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
</head>
<body>
	<div id="main_container">
		<a href="javascript:void(0)" onclick="javascript:chatWith('udin_sedunia')">Chat With Udin Sedunia</a>
		<a href="javascript:void(0)" onclick="javascript:chatWith('dewiit_safitri')">Chat With Dewiit Safitri</a>
		<!-- YOUR BODY HERE -->
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>