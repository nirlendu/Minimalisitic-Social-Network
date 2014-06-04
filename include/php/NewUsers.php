<?php
include 'AccountsImp.php';
$new_email = $_POST['email'];
$new_password1 = $_POST['password1'];
$new_name = $_POST['name'];
$new_password2 = $_POST['password2'];
if($new_password1 != $new_password2){
	header("Location:signUp.html");
}
else{
	if($check->CheckEmailID($new_email)){
		$check=new AccountsImp();
		$check->Add_User($new_email,$new_password1,$new_name);
		header("Location:signin.html");
	}
	else{
	header("Location:signUp.html");
	}
}
?>