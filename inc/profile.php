<?php
include('inc/db.php');
$id = $_GET['profile'];
$get_user = $con->prepare("select * from users where user_id='$id' ");
$get_user->setFetchMode(PDO::FETCH_ASSOC);
$get_user->execute();
$row = $get_user->fetch();

?>
<div class="profile_wrap">
	<div class="jumbotron">
			<img <?php if($row['user_email']==$_SESSION['account']) { echo"onclick='change_co(this)' "; }?> src="<?=$row['user_cover']?>" />
			<img <?php if($row['user_email']==$_SESSION['account']) { echo"onclick='change(this)' "; }?> src="<?=$row['user_img']?>" class="user" />
	</div>
	<div class="profile_title">
		<h1><?=$row['user_name']?></h1>
	</div>
	<div class="bio">
		<h3>BIO<button onclick="document.getElementById('img_bi').style.display='block'">Edit</button></h3>
		<span><?php $bio=$row['user_bio'];if ($row['user_bio']=='no') { echo "Edit your bio";} else if($row['user_bio']!='no') { echo "$bio";}?></span>
	</div>
	<div class="mes">
		<form method="post">
			<h3>Send a message</h3>
			<input type="text" name="mes" autocomplete="off" />
			<button name="mes_sub">Message</button>
			<?php
			if (isset($_POST['mes_sub'])) {
				send_message();
			}
			?>
		</form>
	</div>
	<div class="info">
		<h3>ABOUT</h3>

		<p>Country : <?=$row['user_country']?></p>
		<p>DOB : <?=$row['user_birth']?></p>
		<p>Relationship : <?=$row['user_rel']?></p>
		<p>Last Login : <?=$row['user_last_login']?></p>
		<p>Joined on : <?=$row['user_reg_date']?></p>
	</div>

	<div class="mes" id="mes">

		<h2 id="heading">Photos<span id="showphoto" style="float: right;font-size: 17px;">show&#9662;</span></h2>
		<div id="photos">	
			<?php
				profileimg();
			?>
		</div>
		<br clear="All" />
	</div>

	<?php
	echo"<div id='print_post'>";
		profile_post();
	echo"</div>";
	?>
</div>
<div class="img_select" id="img_se">
	<div class="img_modal">	
		<span id="close">&times;</span>
		<h1>Select the Profile Picture</h1>
		<button id="Btn" name='select'>Choose a File</button>
		<form method="post" enctype="multipart/form-data">
			<input type="file" id="realfile" name="img" />
			<button type="submit" name='upload_profile'>Upload</button>
		</form>
		<?php
			if (isset($_POST['upload_profile'])) {
				if (isset($_FILES['img'])) {
					upload_profile();
				}
			}
		?>
	</div>
</div>

 <div class="img_select" id="img_ce">
	<div class="img_modal">	
		<span id="close1">&times;</span>
		<h1>Select the Cover Picture</h1>
		<button id="Btn1" name='select'>Choose a File</button>
		<form method="post" enctype="multipart/form-data">
			<input type="file" id="realfile1" name="img" />
			<button type="submit" name='upload_cover'>Upload</button>
		</form>
		 <?php
			if (isset($_POST['upload_cover'])) {
				if (isset($_FILES['img'])) {
					upload_cover();
				}
			}
		?> 
	</div>	
</div>

<div class="img_select" id="img_bi">
	<div class="img_modal">	
		<span id="exit">&times;</span>
		<h1>Edit Your Bio Here</h1>
		<form method="post" enctype="multipart/form-data">
			<input type="text" id="bio" name="bio" />
			<button type="submit" name='upload_bio'>Upload</button>
		</form>
		<?php
			if (isset($_POST['upload_bio'])) {
					edit_bio();
			}
		?>
	</div>
</div> 