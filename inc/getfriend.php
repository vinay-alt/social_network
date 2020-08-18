<?php
session_start();
$id = $_SESSION['account_id'];
include('db.php');
$friend = $con->prepare("SELECT * FROM request WHERE (request_from=$id OR request_to=$id) AND request_status = 'accepted'  ");
$friend->setFetchMode();
$friend->execute();
while($row = $friend->fetch()) {

	$from = $row['request_from'];
	$get_user = $con->prepare("select * from users where user_id='$from'");
	$get_user->setFetchMode(PDO::FETCH_ASSOC);
	$get_user->execute();
	$row1 = $get_user->fetch();

	echo "<div class='friendinfo'>
		
	</div>";
	echo"<br clear='both' /><div id='friend'>

				<div class='right'>
					<h1>Friends</h1>
				</div>
			 	<div class='friendinfo'>
					<h1>".$row1['user_name']."</h1>
				</div>
		 	</div>";
}

?>