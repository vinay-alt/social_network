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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous"></script>
	
	<script src="js/signup_verify.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/changefocus.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/img.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/req.js" type="text/javascript" charset="utf-8" async defer></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="myFunction()">
	<?php
	include('inc/loader.php');
	include('inc/header.php');
	?>
	<div class="container">
		<?php
		include('inc/left.php');
		if (!isset($_GET['edit'])&&!isset($_GET['single'])&&!isset($_GET['postedit'])&&!isset($_GET['profile'])) {
			include('inc/right.php');
		} elseif (isset($_GET['single'])) {
			include('inc/single_post.php');
		} else if (isset($_GET['edit'])) {
			edit_account();
		} else if (isset($_GET['postedit'])) {
			echo "<div class='right_wrap' id='user_post'>";
			echo "</div>";
		} else if (isset($_GET['profile'])) {
			include('inc/profile.php');
		}
		?>
	</div>
	<script type="text/javascript">
		$("#post_desc").emojioneArea({
			pickerPosition: "bottom"
		});
		$("#editdesc").emojioneArea({
			pickerPosition: "bottom"
		});

	</script>
</body>
</html>