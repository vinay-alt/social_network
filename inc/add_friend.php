<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$to_id = $_POST['data'];
$add_friend = $con->prepare("insert into request (request_to, request_from, request_status, request_date) values ('$to_id', '$id', 'no', current_timestamp()) ");
$add_friend->execute();


?>