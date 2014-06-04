<?php
session_start();
include 'FunctionsImp.php';
include 'chata.html';
$check=new FunctionsImp();
if(isset($_GET['post'])){
$post=$_GET['post'];
$check->PublishPostAdmin($post);
}
?>
<html>
<center>
<form method='get' action=''>
<input type="text" placeholder="Type here..." name="post"/>
<input type="submit" value="Post">
</html>