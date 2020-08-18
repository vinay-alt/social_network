<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$post_id = $_POST['data'];

$like = $con->prepare("INSERT INTO `likes` (`like_id`, `post_id`, `user_id`) VALUES (NULL, '$post_id', '$id');  ");
$like->execute();

?>