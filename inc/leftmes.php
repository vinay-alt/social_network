<?php 
include('inc/db.php');
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email != '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
?>
<div class="leftmes">
	<h2>Messages</h2>
	<ul>
	<?php
	while ($row1 = $get_u->fetch()) {
		$id=$row1['user_id'];
		$img=$row1['user_img'];
		$name=$row1['user_name'];
		echo"
		<a href='messages.php?mes_to=$id'><li><img src='$img' /><span>$name</span></li></a>";
		}
	?>
	</ul>
</div>