<?php
include('inc/db.php');
$id = $_GET['post_id'];
$get_post = $con->prepare("select * from posts where post_id = '$id' ");
$get_post->setFetchMode();
$get_post->execute();
$row = $get_post->fetch();

$title = $row['post_title'];
$date = $row['post_date'];
$desc = $row['post_content'];
$u_id = $row['user_id'];
$get_user = $con->prepare("select * from users where user_id='$u_id' ");
$get_user->setFetchMode(PDO::FETCH_ASSOC);
$get_user->execute();
$row1 = $get_user->fetch();
$name = $row1['user_name'];
$img = $row1['user_img'];

?>
<div class="post_wrap">
	<div class="single_post">
		<h2>View this Post</h2>
	</div>
<?php
if ($row['post_img']!='no') {
$img1 = $row['post_img'];	
?>
	<div class="single_post">
		<img src=<?=$img?> />
		<h3><?=$name?></h4>
		<h1><?=$title?></h1>
		<span><?=$date?></span>
		<hr width="100%" color="#2e2e2e" size="1"  />
		<p><?=$desc?></p>
		<img style='width:70%;margin-left:50%;transform:translateX(-50%);' src='<?=$img1?>'/>
		
	</div>
<?php
} else {
?>
	<div class="single_post">
		<img src=<?=$img?> />
		<h3><?=$name?></h4>
		<h1><?=$title?></h1>
		<span><?=$date?></span>
		<hr width="100%" color="#2e2e2e" size="1"  />
		<p><?=$desc?></p>
		
	</div>

<?php
}

?>



	<div class="comment">
		<h3>Comment to this....</h2>
		<form method="post" >	
			<textarea name="comment"></textarea>
			<button type="submit" name="comment_sub">Comment</button>
		</form>
		<?php
		if(isset($_POST['comment_sub'])) { 
			insertcom();
		}
		?>	
	</div>

<?php
printcom();

?>
</div>