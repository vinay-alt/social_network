<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$to_id = $_POST['data'];
$del_req = $con->prepare("delete from request where request_to='$to_id' and request_from='$id' ");
$del_req->execute();

?>