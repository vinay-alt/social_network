<?php
	include('inc/function.php');
	include('inc/db.php');
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$id = $row1['user_id'];
?>
<div class="header_wrap">
		<div class="header">
			<div class="logo_wrap">
				<h2><a href='home.php'><span>WC</span>WeConnect</a></h2>
			</div>
			<div class="menu">
				<ul>
					<li id="Home" onclick="load_home()">Home</li>
					<li id="Member" onclick="window.open('member.php','_self')">Members</li>
					<li id="Message" onclick="seen()">Messages <span style="font-size: 20px; color: white; font-weight: 900;" id="mes_count1"></span></li>
					<li id="Request" onclick="window.open('request.php','_self')">Requests</li>
					<div  class="img_icon">
						<a href='home.php?profile=<?=$id?>'><img src="<?=$row1['user_img']?>" /></a>
					</div>
				</ul>			
			</div>
			
		</div>
		
	</div>




	