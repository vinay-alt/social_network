<?php 
function signup() {
	include('db.php');
	$name = $_POST['u_name'];
	$email = $_POST['u_email'];
	$pass = $_POST['u_pass'];
	$country = $_POST['u_country'];
	$gender = $_POST['u_gender'];
	$date = $_POST['u_birth'];
	$code = mt_rand();
	$reg_date = date("Y-m-d")." ".date("h:i:sa");


		$stmt =	$con->prepare("INSERT INTO `users` ( `user_name`, `user_email`, `user_pass`, `user_country`, `user_gender`, `user_birth`, `user_reg_date`, `user_last_login`, `user_img`,`user_cover`,`user_bg`,`user_bio`, `user_status`, `user_ver_code`, `posts`, `user_rel`) VALUES ('$name', '$email', '$pass', '$country', '$gender', '$date', '$reg_date', '', 'image/user/user.png','image/cover/grey.jpg', 'image/bg/bg.jpg','no', 'inactive', '$code', 'no','off')");

		$subject = "Email Verification";
		$body = "Hello $name, Click on the link below to activate your email 
		http://localhost/social_network/inc/emailver.php?token=$code";
		$headers = "From:vinaygomashe@gmail.com";
		echo"<script>alert('$email')</script>";
		if (mail($email, $subject, $body, $headers)) {
			if($stmt->execute()) {
				echo"<script>alert('Signup Successful, Check your mail to activate your email')</script>";
			} else {
				echo"<script>alert('Not successful')</script>";
			}
		} else {
			echo "Email sending failed.....";
		}
}

function login() {
	session_start();
	include('db.php');
	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$login = $con->prepare("select * from users where user_email = '$email' and user_pass = '$pass' ");
	$login->setFetchMode(PDO::FETCH_ASSOC);
	$login->execute();
	$count = $login->rowCount();
	$row = $login->fetch();
	

	if ($count != 0) {
		$id = $row['user_id'];
		if ($row['user_status'] == 'active') {

			$up_last = $con->prepare("UPDATE users SET user_last_login=CURRENT_TIMESTAMP WHERE user_id='$id'");
			$up_last->execute();



			$_SESSION['account'] = $email;
			$_SESSION['account_id'] = $id;
			echo "<script>alert('Log in successful')</script>";
	 		echo "<script>window.open('home.php','_self')</script>";
		} else {
			echo "<script>alert('Kindly Check Your Mail to activate your account first')</script>";
		}
	}
}

function insertpost() {
	include('inc/db.php');
	$email = $_SESSION['account'];
	$title = $_POST['title'];
	$content = $_POST['desc'];
	$date = date("Y-m-d")." ".date("h:i:sa");
	$get = $con->prepare("select user_id from users where user_email= '$email' ");
	$get->setFetchMode(PDO::FETCH_ASSOC);
	$get->execute();
	$row = $get->fetch();
	$id = $row['user_id'];
	$sd = $_FILES['post_img']['name'];
	if(isset($_FILES['post_img']['name']) and $sd != '') {
		$img = "image/post/".$_FILES['post_img']['name'];
	}
	if ($title!='' and $content!='') {

		if(isset($_FILES['post_img']) and $sd != '') {
			move_uploaded_file($_FILES['post_img']['tmp_name'],$img);
			$insert_img = $con->prepare("insert into posts (user_id, post_title, post_content, post_img, post_date) values ('$id','$title','$content','$img','$date') ");
			if($insert_img->execute()){
				echo "<script>alert('Successfully uploaded image')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			} else { 
				echo "<script>alert('Post discarded, Try Again')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			}
					
		} else {


			$insert = $con->prepare("insert into posts (user_id, post_title, post_content, post_img, post_date) values ('$id','$title','$content','no','$date') ");
			
			if ($insert->execute()) {
				$up = $con->prepare("update users set posts = 'yes' where user_id = '$id' ");
				$up->execute();
				echo "<script>alert('Posted Successfully')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			} else { 
				echo "<script>alert('Post discarded, Try Again')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			}
		}
	}
}

function printpost() {
	include('inc/db.php');
	$email = $_SESSION['account'];
	$u_id = $_SESSION['account_id'];

	$get_posts = $con->prepare("select * from posts order by 1 DESC");
	$get_posts->setFetchMode(PDO::FETCH_ASSOC);
	$get_posts->execute();
	$i = 0;

	while ($row1 = $get_posts->fetch()):
		$title = $row1['post_title'];
		$date = $row1['post_date'];
		$post_id = $row1['post_id'];
		$desc = substr($row1['post_content'], 0, 30);
		$id = $row1['user_id'];
		$get_user = $con->prepare("select * from users where user_id='$id' ");
		$get_user->setFetchMode(PDO::FETCH_ASSOC);
		$get_user->execute();
		$row2 = $get_user->fetch();
		$name = $row2['user_name'];
		$img = $row2['user_img'];
		$i = 1;
		$extra = '....';

		$get_like = $con->prepare("select * from likes where user_id='$u_id' and post_id ='$post_id' ");
		$get_like->setFetchMode(PDO::FETCH_ASSOC);
		$get_like->execute();
		$count = $get_like->rowCount();

		$get_number = $con->prepare("select * from likes where post_id ='$post_id' ");
		$get_number->setFetchMode(PDO::FETCH_ASSOC);
		$get_number->execute();
		$count1 = $get_number->rowCount();

		
		if ($row1['post_img']!='no') {
			$img1 = $row1['post_img'];
				echo "<div class='right'>
			<div class='post'>
				<a href='home.php?profile=$id'>
				<img src='$img' />
				<h4>$name</h4>
				</a>
				<h3>$title</h3>
				<span>$date</span>
				<p>$desc.$extra</p>
				<img style='width:70%;margin-left:50%;transform:translateX(-50%);' src='$img1'/>
					<button>Click here to see More</button>";
//<a href='home.php?post_id=$post_id&single'>
				if ($count<=0) { 
				?>
					<button onclick='like(<?=$post_id?>)' style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Like (<?=$count1?>)</button>
				<?php
				} else {
				?>
					<button onclick='del_like(<?=$post_id?>)'>Liked (<?=$count1?>)</button>
				<?php
				}
				echo"<button";?> onclick="window.open('home.php?post_id=<?=$post_id?>&single','_self')" <?php echo" style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Comment</button>
				</div>
			</div>";
		} else {
		
			echo "<div class='right'>
			<div class='post'>
				<a href='home.php?profile=$id'>
				<img src='$img' />
				<h4>$name</h4>
				</a>
				<h3>$title</h3>
				<span>$date</span>
				<p>$desc.$extra</p>
				<a href='home.php?post_id=$post_id&single'>
					<button>Click here to see More</button>
				</a>";
				if ($count<=0) { 
?>
				<button onclick='like(<?=$post_id?>)' style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Like</button>
<?php
} else {
?>
				<button onclick='del_like(<?=$post_id?>)'>Liked</button>
<?php
}
				echo"<button";?> onclick="window.open('home.php?post_id=<?=$post_id?>&single','_self')" <?php echo" style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Comment</button>


				</div>
			</div>";
		}
		endwhile;


		if ($i==0) {
		echo "<div class='right'>
		<h2>no posts yet</h2>
		</div>";
		}
}

function printcom() {
	include('inc/db.php');
	$id = $_GET['post_id'];
	$get = $con->prepare("select * from comment where post_id='$id' order by 1 desc ");
	$get->setFetchMode(PDO::FETCH_ASSOC);
	$get->execute();
	while($row=$get->fetch()) {
		$u_id = $row['user_id'];
		$get_u = $con->prepare("select * from users where user_id = '$u_id' ");
		$get_u->setFetchMode(PDO::FETCH_ASSOC);
		$get_u->execute();
		$row1 = $get_u->fetch();
		$img = $row1['user_img'];
		$name = $row1['user_name'];
		$date = $row['com_date'];
		$comment = $row['comment'];
		$com_author = $row['com_author'];
		echo "<div class='comment'>
			<div class='com_image'>
				<img src='$img' />
			</div>
			<div class='title'>
				<h3>$name</h3>
				<span>$com_author said on $date</span>
			</div>
			<hr>
			<span>$comment</span>
		</div>";
	}
}

function insertcom() {
	include('inc/db.php');
	$id = $_GET['post_id'];
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row = $get_u->fetch();
	$u_id = $row['user_id'];
	$comment = $_POST['comment'];
	$com_author = $row['user_name'];
	$date = date('Y-m-d')." ".date("h:i:sa");
	$ins_com = $con->prepare("INSERT INTO `comment` (`post_id`, `user_id`, `comment`, `com_author`, `com_date`) VALUES ('$id', '$u_id', '$comment', '$com_author', current_timestamp()) ");
	if ($ins_com->execute()) {
		echo "<script>alert('Commented Successful')</script>";
		echo "<script>window.open('home.php?post_id=$id&single','_self')</script>";
	} else {
		echo "<script>alert('Sorry PLease try again')</script>";
		echo "<script>window.open('home.php?post_id=$id&single','_self')</script>";
	}
}

function edit_account() {
	include('inc/db.php');

	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row = $get_u->fetch();

	echo "
	<div class='edit'>
		<h2>EDIT ACCOUNT</h2>
		<hr />
		<form method='post' enctype='multipart/formdata'>
			
			<div class='group'>
				<label>Name</label><br />
				<input  type='text' name='u_name' value='".$row['user_name']."'>
			</div>
			<div class='group'>

				<label>Email</label><br />
				<input id='email' onchange='v_email()' type='text' name='u_email' value='".$row['user_email']."'>
				<p id='noatsign'>Email must contain @-sign</p>
			</div>
			<div class='group'>

				<label>Password</label><br />
				<input id='pass' onchange='v_pass()' type='password' name='u_pass' value='".$row['user_pass']."'>
				<p id='lessthan'>Password must be atleast 8 characters long</p>
			</div>
			<div class='group'>

				<label>Country</label><br />
				<select id='country' onchange='v_coun()' name='u_country'>
					<option value='".$row['user_country']."'>".$row['user_country']."</option>
					<option value='India'>India</option>
					<option value='USA'>USA</option>
					<option value='UK'>UK</option>
					<option value='Japan'>Japan</option>
					<option value='Russia'>Russia</option>
				</select>
				<p id='nocoun'>No country selected</p>
			</div>
			<div class='group'>

				<label>Gender</label><br />
				<select id='gender' onchange='v_gen()' name='u_gender'>
					<option value='".$row['user_gender']."'>".$row['user_gender']."</option>
					<option value='Male'>Male</option>
					<option value='Male'>Female</option>
					<option value='Male'>Other</option>
				</select>
				<p id='nogen'>No Gender selected</p>
			</div>
			<div class='group'>

				<label>Relationship</label><br />
				<select id='rel' onchange='v_rel()' name='u_rel'>
					<option value='".$row['user_rel']."'>".$row['user_rel']."</option>
					<option value='Single'>Single</option>
					<option value='Married'>Married</option>
					<option value='Divorsed'>Divorsed</option>
				</select>
			</div>
			<div class='group'>

				<label>Birthday</label><br />
				<input id='birth' onchange='v_birth()' value='".$row['user_birth']."' type='date' name='u_birth' >
				<p id='dmsg'>Invalid Birth date</p>
				<p id='dmsg'>Invalid Birth date</p>
				<p id='dmsg'>Invalid Birth date</p>
			</div>
			<button name='edit' type='submit'>Save</button>
		</form>
	</div>
	";
	if (isset($_POST['edit'])) {
		edit();
	}
}

function edit() {
	include('inc/db.php');
	$em = $_SESSION['account'];
	$id = $_GET['edit'];
	$name = $_POST['u_name'];
	$email = $_POST['u_email'];
	$pass = $_POST['u_pass'];
	$coun = $_POST['u_country'];
	$gender = $_POST['u_gender'];
	$rel = $_POST['u_rel'];
	$birth = $_POST['u_birth'];
	$up_user = $con->prepare("update users set user_name='$name', user_email='$email', user_pass='$pass', user_country='$coun', user_gender='$gender', user_rel='$rel', user_birth='$birth' where user_email='$em' ");
	if ($up_user->execute()) {
		echo "<script>alert('Updated Successfully')</script>";
		echo "<script>window.open('home.php?edit=$id','_self')</script>";
	}
}

function user_posts() {
	include('inc/db.php');

	$email = $_SESSION['account'];
	$u_id = $_SESSION['account_id'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$id = $row1['user_id'];

	$get_post = $con->prepare("select * from posts where user_id='$id' order by 1 desc ");
	$get_post->setFetchMode(PDO::FETCH_ASSOC);
	$get_post->execute();
	echo "<div class='right_wrap'>";
	


	while($row = $get_post->fetch()) {
		$img = $row1['user_img'];
		$name = $row1['user_name'];
		$title = $row['post_title'];
		$date = $row['post_date'];
		$desc = $row['post_content'];
		$extra = "....";
		$post_id=$row['post_id'];


		$get_like = $con->prepare("select * from likes where user_id='$u_id' and post_id ='$post_id' ");
		$get_like->setFetchMode(PDO::FETCH_ASSOC);
		$get_like->execute();
		$count = $get_like->rowCount();

		$get_number = $con->prepare("select * from likes where post_id ='$post_id' ");
		$get_number->setFetchMode(PDO::FETCH_ASSOC);
		$get_number->execute();
		$count1 = $get_number->rowCount();
			
		if ($row['post_img']!='no') {
			$img1 = $row['post_img'];
					echo "<div class='right'>
				<div class='post'>
					<a href='home.php?profile=$id'>
					<img src='$img' />
					<h4>$name</h4>
					</a>
					<h3>$title</h3>
					<span>$date</span>
					<p>$desc.$extra</p>
					<img style='width:70%;margin-left:50%;transform:translateX(-50%);' src='$img1'/>
					<a href='home.php?post_id=$post_id&single'>
						<button>Click here to see More</button>
					</a>
					<button value='$post_id' onclick='edit_post(this)'>Edit</button>
					<a href='home.php?postedit&del=$post_id'><button>Delete</button></a>
				</div>
			</div>";
		} else {

				echo "<div class='right'>
			<div class='post'>
				<a href='home.php?profile=$id'>
				<img src='$img' />
				<h4>$name</h4>
				</a>
				<hr/>
				<h3>$title</h3>
				<span>$date</span>
				<p>$desc.$extra</p>
				<a href='home.php?post_id=$post_id&single'>
					<button>Click here to see More</button>
				</a>
				<button value='$post_id' onclick='edit_post(this)'>Edit</button>
				<a href='home.php?postedit&del=$post_id'><button>Delete</button></a>
				</div>
				
			</div>";



		}



	}
	echo "</div>";

	if (isset($_POST['post'])) {
		include('inc/db.php');

		$id = $_GET['postedit'];
		$title = $_POST['title'];
		$desc = $_POST['desc'];
		$up = $con->prepare("update posts set post_title = '$title', post_content='$desc' where post_id='$id' ");
		if ($up->execute()) {
			echo "<script>window.open('home.php?postedit', '_self')</script>";
		}
	}

	if (isset($_GET['del'])) {
		$d_id = $_GET['del'];
		$del = $con->prepare("delete from posts where post_id='$d_id' ");
		if ($del->execute()) {
			echo "<script>alert('Deleted Successfully')</script>";
			echo "<script>window.open('home.php?postedit','_self')</script>";
		}
	}


echo "<div class='editdiv' id='editdiv'><div class='cover_edit'>
		<div class='edit_mod'>
		<span ";?> onclick="document.getElementById('editdiv').style.display='none' "  <?php echo">&times;</span>
		<h3>Edit this post</h3>
		<div id='edit_post_form' style='width: 60%; margin: 0 auto;'>			
		</div>
		</div>
	</div></div>";

	

}


function profile_post() {
	include('inc/db.php');

	$email = $_SESSION['account'];
	$u_id = $_SESSION['account_id'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$id = $row1['user_id'];

	$get_post = $con->prepare("select * from posts where user_id='$id' order by 1 desc ");
	$get_post->setFetchMode(PDO::FETCH_ASSOC);
	$get_post->execute();
	while($row=$get_post->fetch()) {

		$img = $row1['user_img'];
		$name = $row1['user_name'];
		$title = $row['post_title'];
		$date = $row['post_date'];
		$desc = $row['post_content'];
		$extra = "....";
		$post_id=$row['post_id'];


		$get_like = $con->prepare("select * from likes where user_id='$u_id' and post_id ='$post_id' ");
		$get_like->setFetchMode(PDO::FETCH_ASSOC);
		$get_like->execute();
		$count = $get_like->rowCount();

		$get_number = $con->prepare("select * from likes where post_id ='$post_id' ");
		$get_number->setFetchMode(PDO::FETCH_ASSOC);
		$get_number->execute();
		$count1 = $get_number->rowCount();


		if ($row['post_img']!='no') {

			$img1 = $row['post_img'];
				echo "<div class='right'>
			<div class='post'>
				<a href='home.php?profile=$id'>
				<img src='$img' />
				<h4>$name</h4>
				</a>
				<h3>$title</h3>
				<span>$date</span>
				<p>$desc.$extra</p>
				<img style='width:70%;margin-left:50%;transform:translateX(-50%);' src='$img1'/>
				<a href='home.php?post_id=$post_id&single'>
					<button>Click here to see More</button>
				</a>";


				if ($count<=0) { 
?>
				<button onclick='like(<?=$post_id?>)' style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Like (<?=$count1?>)</button>
<?php
} else {
?>
				<button onclick='del_like(<?=$post_id?>)'>Liked (<?=$count1?>)</button>
<?php
}
				echo"<button";?> onclick="window.open('home.php?post_id=<?=$post_id?>&single','_self')" <?php echo" style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Comment</button>

				
				</div>
			</div>";

		} else {	
			echo "<div class='right'>
				<div class='post'>
				<a href='home.php?profile=$id'>
				<img src='$img' />
				<h4>$name</h4>
				</a>
				<hr/>
				<h3>$title</h3>
				<span>$date</span>
				<p>$desc.$extra</p>
				<a href='home.php?post_id=$post_id&single'>
					<button>Click here to see More</button>
				</a>
				<a href='home.php?postedit=$post_id'><button>Edit</button></a>
				<a href='home.php?post&del=$post_id'><button>Delete</button></a>
				<button onclick='like()' style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Like</button>
				<button";?> onclick="window.open('home.php?post_id=<?=$post_id?>&single','_self')" <?php echo" style='background-color:#fff;color:#4b5f83;border:1px solid #4b5f83;'>Comment</button>
				</div>
			</div>";
		}
	}
}


function send_message() {
	include('inc/db.php');
	if (isset($_GET['profile'])) {
		$to_id = $_GET['profile'];
	} else if(isset($_GET['mes_to'])) {
		$to_id = $_GET['mes_to'];
	}
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();

	$id = $row1['user_id'];
	$body = $_POST['mes'];
	$get_mes = $con->prepare("insert into messages (user_to, user_from, mes_body, mes_date, mes_seen) values ('$to_id', '$id','$body',current_timestamp(),'no')  ");
	if ($get_mes->execute()) {
	echo"<script>window.open('messages.php?mes_to=$to_id','_self')</script>";
	}
}

function upload_profile() {
	include('inc/db.php');



	$id = $_GET['profile'];
	$img = "image/user/".$_FILES['img']['name'];
	$get_u = $con->prepare("select * from users where user_id = '$id' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$img1 = $row1['user_img'];
	echo "<script>alert($img.'isxk')</script>";
	if ($img1 != 'image/user/user.png') {
		$what = unlink($img1);
	}
 
		move_uploaded_file($_FILES['img']['tmp_name'], $img);
		$up_img = $con->prepare("update users set user_img = '$img' where user_id = '$id' ");
		if($up_img->execute()){
			echo "<script>alert('Successfully updated')</script>";
			echo "<script>window.open('home.php?profile=$id', '_self')</script>";
		}
}

function upload_cover() {
	include('inc/db.php');
	$id = $_GET['profile'];
	$img = "image/cover/".$_FILES['img']['name'];

	$get_u = $con->prepare("select * from users where user_id = '$id' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$img1 = $row1['user_cover'];

	if (unlink($img1)) {
		move_uploaded_file($_FILES['img']['tmp_name'], $img);
		$up_img = $con->prepare("update users set user_cover = '$img' where user_id = '$id' ");
		if($up_img->execute()){
			echo "<script>alert('Successfully updated')</script>";
			echo "<script>window.open('home.php?profile=$id', '_self')</script>";
		}
	}
}

function upload_bg() {
	include('inc/db.php');
	
	$email = $_SESSION['account'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$id = $row1['user_id'];
	$img = "image/bg/".$_FILES['bg_img']['name'];
	move_uploaded_file($_FILES['bg_img']['tmp_name'], $img);
	$up_bg = $con->prepare("update users set user_bg = '$img' where user_id = '$id' ");
	if($up_bg->execute()){
		echo "<script>alert('Successfully updated')</script>";
		echo "<script>window.open('messages.php?mes_to=5', '_self')</script>";
	}
	
}


function edit_bio() {
	include('inc/db.php');
	$id = $_GET['profile'];
	$bio = $_POST['bio'];

	$up_bio = $con->prepare("update users set user_bio='$bio' where user_id='$id' ");
	if($up_bio->execute()){
		echo "<script>alert('Successfully updated')</script>";
		echo "<script>window.open('home.php?profile=$id', '_self')</script>";
	}
}


function profileimg(){
	include('inc/db.php');


	$email = $_SESSION['account'];
	$u_id = $_SESSION['account_id'];
	$get_u = $con->prepare("select * from users where user_email = '$email' ");
	$get_u->setFetchMode(PDO::FETCH_ASSOC);
	$get_u->execute();
	$row1 = $get_u->fetch();
	$id = $row1['user_id'];

	$get_post = $con->prepare("select * from posts where user_id='$id' order by 1 desc ");
	$get_post->setFetchMode(PDO::FETCH_ASSOC);
	$get_post->execute();
	echo"<h4 style='padding-left:1%;color:rgba(0,0,0,0.8);'>You have 0 photos</h4>";
	while($row=$get_post->fetch()) { 
		if ($row['post_img']!='no'){
			$img = 	$row['post_img'];
			echo"<img src='$img' style='width:24%;padding:1%;height:100px;'> ";
			echo"<img src='$img' style='width:24%;padding:1%;height:100px;' >";
			echo"<img src='$img' style='width:24%;padding:1%;height:100px;' >";
			echo"<img src='$img' style='width:24%;padding:1%;height:100px;' >";
			echo"<img src='$img' style='width:24%;padding:1%;height:100px;' >";

		}
	}


}


?>