<?php
include('db.php');
session_start();
$to_id = $_POST['data'];
$id = $_SESSION['account_id'];
$get_mes = $con->prepare("SELECT * FROM `messages` WHERE `user_to` = '$to_id' AND `user_from`=$id OR `user_to` = $id AND `user_from`=$to_id ");
$get_mes->setFetchMode(PDO::FETCH_ASSOC);
$get_mes->execute();
while($row = $get_mes->fetch()) {
	if ($row['user_from']==$id AND $row['user_to']==$to_id) {
		$body = $row['mes_body'];
		echo"<span class='message_right'>$body</span><br /><br /><br />";
	} else {
		$body = $row['mes_body'];
		echo"<span class='message_left'>$body</span><br /><br /><br />";
	}
}
?>