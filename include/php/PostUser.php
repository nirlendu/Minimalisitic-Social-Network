<?php
session_start();
include 'FunctionsImp.php';
include 'chat.html';
include 'AutoCheck.php';
$uid=$_SESSION['uid'];
$check=new FunctionsImp();
if(isset($_GET['post'])){
$post=$_GET['post'];
$check->PublishPostUsers($uid,$post);}
?>
<html>
<center>
<form method='get' action=''>
<input type="text" placeholder="Type here..." name="email"/>
<input type="submit" value="Post">
</html>