<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logout</title>
</head>
	

<body>
	<?php
		session_start();
		unset($_SESSION["prac_login"]);
		session_destroy();
		session_write_close();
		header('Location: index.html');
		die;
	?>
</body>
</html>