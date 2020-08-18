<?php
	include('db.php');
	session_start();
	$check_id = $_SESSION['account_id'];

	$get_users = $con->prepare("select * from users where user_status='active'");
	$get_users->setFetchMode(PDO::FETCH_ASSOC);
	$get_users->execute();
	echo"
	<div class='displaymembers_wrap'>
	<div class='displaymembers'>
		<h2>All Members</h2>
	</div>";
	while($row = $get_users->fetch()) {
		$img = $row['user_img'];
		$name = $row['user_name'];	
		$date = $row['user_reg_date'];	
		$id = $row['user_id'];

		$get_req = $con->prepare("select * from request where request_to='$id' and request_from='$check_id' or request_from='$id' and request_to='$check_id' ");
		$get_req->setFetchMode(PDO::FETCH_ASSOC);
		$get_req->execute();
		$row1 = $get_req->fetch();
		$count = $get_req->rowCount();

		echo"
			<a href='home.php?profile=$id'>
				<div class='member'>
					<img src='$img'>
					<h4>$name</h4>";
						echo"<input type='hidden' id='add' value='$id' /></a>";
					if($count <= 0) {
						if($id == $check_id) {
							echo"<button name='add_friend' onclick='add($id)' id='add_friend' style='padding:5px 15px;' disabled> You </button>";
						} else {
						echo"<button name='add_friend' onclick='add($id)' id='add_friend' style='padding:5px 15px;'>Add Friend</button>";
						}
					} elseif($row1['request_status']=='no') {
						echo"<button name='cancel_req' onclick='cancel($id)' style='padding:5px 15px;'>Cancel Request</button>";
					} elseif($row1['request_status']=='accepted') {
						echo"<button disabled style='padding:5px 15px;'>Friend</button>";
					} elseif($row1['request_status']=='rejected') {
						echo"<button name='add_friend' onclick='add($id)' id='add_friend' style='padding:5px 15px;'>Add Friend</button>";
					} 

						echo"<a href='home.php?profile=$id'><input type='hidden' name='to_id' value='$id' />
				</div></a>";
			
		
	}
	echo"</div>";

?>