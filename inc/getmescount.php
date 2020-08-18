<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$get_mes = $con->prepare("SELECT * FROM `messages` WHERE `user_to` = $id AND `mes_seen` = 'no' ");
$get_mes->setFetchMode(PDO::FETCH_ASSOC);
$get_mes->execute();
$count = $get_mes->rowCount();
	if ($count>0) {
	echo "($count)";
	} else {
		echo " ";
	}

?>