<?php
	include('db.php');
	if (!isset($_SESSION['account_id'])) {	
		session_start();
	}
	$id = $_SESSION['account_id'];
	$get_req = $con->prepare("select * from request where request_to='$id' and request_status='no' ");
	$get_req->setFetchMode(PDO::FETCH_ASSOC);
	$get_req->execute();
	echo"
	<div class='displaymembers'>
		<h2>All Requests</h2>
	</div>";
	$i = 0;
	while($row = $get_req->fetch()) {
		$i++;
		
		$from = $row['request_from'];
		$get_user = $con->prepare("select * from users where user_id='$from'");
		$get_user->setFetchMode(PDO::FETCH_ASSOC);
		$get_user->execute();
		$row1 = $get_user->fetch();
		$count = $get_user->rowCount();


		$img = $row1['user_img'];
		$name = $row1['user_name'];	
		$date = $row1['user_reg_date'];	
		$id = $row1['user_id'];
		if($row['request_status']!='rejected') {	
			echo"
				<div class='member'>
					<img src='$img'>
					<h4>$name</h4>
					<h5>Joined on</h5>
					<input type='hidden' id='from_id' value='$id' />
					<span>";
						echo"<button onclick='check($id)' style='padding: 3% 5% 3% 5%;border-radius:50%;'>&check;</button>";
						echo"<button onclick='uncheck($id)' style='padding:4% 6% 4% 6%;border-radius:50%; margin-left:10%;'>&times;</button>
					</span>
				</div>";
			}
	}
	if ($i==0) {
		echo "<div class='displaymembers'>
				<span>No Resquests now</span>
		</div>";
	}
	if (isset($_POST['add_friend'])) {
				add_friend();
			}

	if (isset($_POST['cancel_req'])) {
				cancel_request();
			}

?>