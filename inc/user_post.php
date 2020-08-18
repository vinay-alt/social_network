<?php

include('db.php');
session_start();
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

?>
