<?php
session_start();
//if($_SESSION['uid']){
//header("Location:Error.php");
//}
include 'AutoCheckSign.php';
include 'AccountsImp.php';
$u_email=$_POST['email'];
$u_password=$_POST['password'];
$check= new AccountsImp();
//echo $u_email." ".$u_password;
if($check->OAuth_User($u_email,$u_password)){
$_SESSION['uid']=$check->GetUserID($u_email,$u_password);
header("Location:Profile.php?VID=".$_SESSION['uid']);
}
else{
header("Location:signIn.html");
}
?>
