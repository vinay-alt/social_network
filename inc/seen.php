<?php
include('db.php');
session_start();
$id = $_SESSION['account_id'];
$seen = $con->prepare("update messages set mes_seen = 'yes' where user_to = '$id' and mes_seen='no' ");
$seen->execute();