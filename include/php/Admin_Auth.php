<?php
include 'AccountsImp.php';
session_start();
$a_email=$_POST['a_email'];
$a_password=$_POST['a_password'];
$check= new AccountsImp();
if(!$check->OAuth_User($a_email,$a_password)){
header("Location:AdminHome.php");
}
else{
header("Location:signIn.html");
}
?>