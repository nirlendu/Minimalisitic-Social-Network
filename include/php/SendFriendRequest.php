<?php
session_start();
include 'AutoCheck.php';
include 'FunctionsImp.php';
$VID=$_GET['VID'];
$uid=$_SESSION['uid'];
$check= new FunctionsImp();
$check->SendFriendRequest($uid,$VID);
header("Location:Profile.php?VID=".$VID."");
?>