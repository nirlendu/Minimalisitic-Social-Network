<?php
session_start();
include 'chat.html';
include 'FunctionsImp.php';
include 'AutoCheck.php';
$uid=$_SESSION['uid'];
$check=new FunctionsImp();
$check->AcceptFriendRequest($uid);
?>