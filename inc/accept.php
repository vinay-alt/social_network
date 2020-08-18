<?php
	include('db.php');
	session_start();
	$to_id = $_SESSION['account_id'];
	$id = $_POST['data'];
	$accept = $con->prepare("update request set request_status='accepted' where request_to='$to_id' and request_from='$id' ");
	$accept->execute();


?>