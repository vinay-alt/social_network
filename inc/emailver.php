<?php
include('db.php');
if (isset($_GET['token'])) {
	$token = $_GET['token'];
	$stmt = $con->prepare("update users set user_status = 'active' where user_ver_code = '$token'");
	if ($stmt->execute()) {
	?>
	<h1>Congratulations!!!!!!</h1>
	<h2>Your Account is verified now you can login  </h2>
	<p><a href="../index.php?login" title="">Click Here</a> to login</p>
	<?php
	} else {
		echo "<h1>Something Went Wrong</h1>";
	}

}
?>