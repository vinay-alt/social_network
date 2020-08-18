
<div class="rightmes">
<?php
include('inc/db.php');
	if (isset($_GET['mes_to'])) {
	$to_id=$_GET['mes_to'];
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_id = '$to_id' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();

	$get_m = $con->prepare("select * from users where user_email = '$email' ");
	$get_m->setFetchMode(PDO::FETCH_ASSOC);
	$get_m->execute();
	$row2 = $get_m->fetch();
	$id = $row2['user_id'];
	

?>
	<div class="acc_info">
		<img src="<?=$row1['user_img']?>" />
		<span><?=$row1['user_name']?></span>
		<h5 style="float: right;">...<ul>
			<li onclick="window.open('messages.php?bg&mes_to=<?=$to_id?>','_self')">Change Background</li>
		</ul></h5>
	</div>
	<input type="hidden" id="to_id" value="<?=$to_id?>" />
	<div class="acc_mes" id="acc_mes" style="background-image: url('<?=$row2['user_bg']?>');">
		<?php
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
		
	</div>
	<div class="send">
		<form method='post'>
			<textarea id="mes" rows="2" name="mes" placeholder="Enter a message" autocomplete='off' ></textarea>
			<button type="submit" name="mes_sub">Send</button>
			<input type="hidden" name="to_id" value="<?=$to_id?>" /> 
		</form>
		<?php
		if (isset($_POST['mes_sub'])) {
			send_message();
		}
		?>
	</div>


<?php
} else {
?>

<p class='other'>You can see your messages here</p>

<?php
}
?>
</div>

<div id="bg_mod">
<?php
if (isset($_GET['bg'])) {
		echo"<div class='bg_select' id='bg_ce'>";
		?>
				<span onclick="window.open('messages.php?mes_to=<?=$to_id?>','_self')" id='close1'>&times;</span>
				<?php
				echo"<h1>Select the Background Picture</h1>";
			?>
				<button id='Btn1' onclick="document.getElementById('realfile1').click()" name='select'>Choose a File</button>
			<?php
			echo"<form method='post' enctype='multipart/form-data'>";
			?>
					<input type='file' onchange="document.getElementById('Btn1').innerHTML = document.getElementById('realfile1').value.split('\\')[2]" id='realfile1' name='bg_img' />
			<?php

			echo"
					<button type='submit' name='upload_bg'>Upload</button>
				</form>";
		if (isset($_POST['upload_bg'])) {
			if (isset($_FILES['bg_img'])) {
				upload_bg();
			}
		}
	}

?>

</div>