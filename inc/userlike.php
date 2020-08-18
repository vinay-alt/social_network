<?php

	session_start();
	include('db.php');
		$email = $_SESSION['account'];
		$u_id = $_SESSION['account_id'];

		$get_posts = $con->prepare("select * from posts order by 1 DESC");
		$get_posts->setFetchMode(PDO::FETCH_ASSOC);
		$get_posts->execute();
		$i = 0;
		echo "<div class='right_wrap'>";

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
					<h3>$title</h3>
					<span>$date</span>
					<p>$desc.$extra</p>
					<a href='home.php?post_id=$post_id&single'>
						<button>Click here to see More</button>
					</a>
					<a href='home.php?postedit&del=$post_id'><button>Delete</button></a>";



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
			}
			endwhile;
			echo "</div>";


			if ($i==0) {
			echo "<div class='right'>
			<h2>no posts yet</h2>
			</div>";
			}
	
if (isset($_GET['del'])) {
		$d_id = $_GET['del'];
		$del = $con->prepare("delete from posts where post_id='$d_id' ");
		if ($del->execute()) {
			echo "<script>alert('Deleted Successfully')</script>";
			echo "<script>window.open('home.php?postedit','_self')</script>";
		}
	}

?>



	
