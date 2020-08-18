<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$post_id = $_POST['data'];

$del = $con->prepare("delete from likes where post_id='$post_id' and user_id='$id'  ");
$del->execute();

?>