<?php
session_start();
if (!isset($_SESSION['account'])) {
	echo "<script>alert('Kindly Login First')</script>";
	echo "<script>window.open('index.php?login','_self')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>WeConnect | HOME</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="js/signup_verify.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/changefocus.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/img.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/req.js" type="text/javascript" charset="utf-8" async defer></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="Member()">
	<?php
	include('inc/loader.php');
	include('inc/header.php');
	?>
	<div class="container">
		<?php
		include('inc/left.php');
		?>
		<div id="mem">
			<div class='displaymembers_wrap'>
				<div class='displaymembers'>
					<h2>All Members</h2>
				</div>
			</div>
		</div>
</body>
</html>