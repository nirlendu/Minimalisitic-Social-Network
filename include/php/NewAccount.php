<?php
include 'AccountsImp.php';
$email = $_POST['email'];
$password1 = $_POST['password1'];
$name = $_POST['name'];
$password2 = $_POST['password2'];
$UID=rand()%10000;
if($password1!=$password2){
	header("Location:../signUp.html");
	}
$check= new AccountsImp();
$check->Add_User($email,$password1,$name);
header("Location:../signIn.html");
?>