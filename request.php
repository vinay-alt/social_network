<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeConnect | LOGIN</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous"></script>
	<script src="js/signup_verify.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/changefocus.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/img.js" type="text/javascript"></script>
	<script src="js/req.js" type="text/javascript"></script>
</head>
<body onload="reqload()">
	<?php
	include('inc/loader.php');
	include('inc/header.php');
	?>
	<div class="container">
		<?php
		include('inc/left.php');
		?>
		<div class='displaymembers_wrap'>	
			<div id="r_d">
				<div class='displaymembers'>
					<h2>All Requests</h2>
				</div>   
		 	</div>
		 	<div id='friend'>
		 		<div class='displaymembers'>
					<h2>All Friends</h2>
				</div>
		 	</div>
		</div>
		 
	</div>
</body>
</html>
