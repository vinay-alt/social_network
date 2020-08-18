<?php
	include('db.php');
	session_start();
	$to_id = $_SESSION['account_id'];
	$id = $_POST['data'];
	$accept = $con->prepare("delete from request where request_to='$to_id' and request_from='$id' ");
	$accept->execute();


?>