<?php
session_start();
include'chat.html';
include 'AutoCheck.php';
include 'FunctionsImp.php';
$uid=$_SESSION['uid'];
$check=new FunctionsImp();
$check->UpdateTimelineUser($uid);
?>