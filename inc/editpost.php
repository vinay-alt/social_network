<?php
include('db.php');
$post_id = $_POST['data'];

$get_post = $con->prepare("select * from posts where post_id = '$post_id' ");
$get_post->setFetchMode(PDO::FETCH_ASSOC);
$get_post->execute();
$row = $get_post->fetch();
$title = $row['post_title'];
$desc = $row['post_content'];

?>
<input type='text' id='title' name='title' autocomplete='off'  value='<?=$title?>' />
			<textarea name='desc' id='editdesc'><?=$desc?></textarea>
			<button type='submit' value="<?=$post_id?>" onclick="saveinfo(this)" name='post'>Edit</button>
			<script>
				$("#editdesc").emojioneArea({
					pickerPosition: "bottom"
				});
			</script>