<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeConnect | LOGIN</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/nav.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/signup_verify.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body onload="const load = document.getElementById('loader');load.style.display='none';">
	<?php
		include('inc/loader.php');
		include('inc/header_login.php');
		include('inc/content.php');
		include('inc/footer.php');
	?>
</body>
</html>