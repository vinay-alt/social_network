<?php
include('db.php');

$title = $_POST['title'];
$desc = $_POST['desc'];
$id = $_POST['id'];

$up_post = $con->prepare("update posts set post_title='$title', post_content='$desc' where post_id='$id' ");
$up_post->execute();
?>