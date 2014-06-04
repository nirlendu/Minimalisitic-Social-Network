<?php
//session_start();
if(!$_SESSION['uid']){
	header("Location:Error.php");
	}
?>