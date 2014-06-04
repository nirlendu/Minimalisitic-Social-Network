<?php
session_start();
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$count=0;
$pmaadhar=$_POST['pmaadhar'];
if(strlen($pmaadhar)!=10){
	$count=1;
	}
$fname = $_POST['fname'];
if(preg_match("/^1234567890/",$fname)){
	$count=1;
	}
$mname = $_POST['mname'];
if(preg_match("/^1234567890/",$mname)){
	$count=1;
	}
$lname = $_POST['lname'];
if(preg_match("/^1234567890/",$lname)){
	$count=1;
	}
$age = $_POST['age'];
$aadhar = $_POST['aadhar'];
if(strlen($aadhar)!=10){
	$count=1;
	}
$gender = $_POST['gender'];
$phone = $_POST['phone'];
if(strlen($phone)!=10){
	$count=1;
	}
$relation = $_POST['relation'];
$no_past_visits= $_POST['no_past_visits'];
if(($no_past_visits)<0){
	$count=1;
	}
$last_visit = $_POST['last_visit'];
$health_rating=$_POST['Choice'];
if($count==1){
	header("Location:ErrorEntering.php");
	}
mysql_query("insert into dependent values ('".$pmaadhar."','".$aadhar."','".$fname."','".$gender."','".$age."','".$relation."','".$phone."')",$link);
mysql_query("insert into past_yatra values('".$aadhar."','".$no_past_visits."','".$last_visit."')",$link);
mysql_query("insert into health_rating values('".$aadhar."','".$health_rating."')",$link);
mysql_close($link);
header("Location:dependent_aadhar.html");
?>