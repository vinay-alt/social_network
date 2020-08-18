<?php
include 'inc/db.php';
$email = $_SESSION['account'];
$recover = $con->prepare("select * from users where user_email = '$email' ");
$recover->setFetchMode(PDO::FETCH_ASSOC);
$recover->execute();
$row = $recover->fetch();
?>
<div class="left">
	<ul>
		<li id="img" onclick="showimg()"><img src="<?=$row['user_img']?>" alt="udgwhjbks" /></li>
		<p><?=$row['user_name']?></p>
		<p>Country : <?=$row['user_country']?></p>
		<p>Last Login : <?=$row['user_last_login']?></p>
		<p>Joined on : <?=$row['user_reg_date']?></p>
		<li  onclick="seen()">Messages <span style="font-size: 20px;color:#000;" id="mes_count2"></span></li>
		<li onclick="window.open('home.php?postedit','_self')">My Posts (0)</li>
		<li onclick="window.open('home.php?edit=<?=$row['user_id']?>','_self')">My Account</li>
		<li onclick="window.open('inc/logout.php','_self')">Logout</li>
	</ul>
	<footer>
		<ul>
			<li onclick="window.open('otherpages/about.php','_blank')">About</li><li onclick="window.open('otherpages/terms.php','_blank')" >PrivacyT&C</li><li onclick="window.open('otherpages/helps.php','_blank')" >Help</li><li>Advertising</li>
			<li>Buissness</li><li>Services</li><li>Get the app</li><li>More</li>
		</ul>
		<h5><span>WC</span>WeConnect Corporation &copy 2020</h5>
	</footer>
</div>

<div class="image_open" id="image_open">
	<span onclick="document.getElementById('image_open').style.display='none'">&times;</span>
	<div class="center_div">
			<img id="image" src="<?=$row['user_img']?>" />
	</div>
</div>
