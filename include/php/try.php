<?php
include 'AutoCheck.php';
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$count=0;
$fname = $_POST['fname'];
if(preg_match("/^1234567890/",$fname)){
	$count=1;
	echo "here".$fname;
	}
$mname = $_POST['mname'];
if(preg_match("/^1234567890/",$mname)){
	$count=1;
	echo "here".$mname;
	}
$lname = $_POST['lname'];
if(preg_match("/^1234567890/",$lname)){
	$count=1;
	echo "here".$lname;
	}
$age = $_POST['age'];
	if($age<15){
		$count=1;
		echo "here".$age;
	}
$pmaadhar = $_POST['pmaadhar'];
if(strlen($pmaadhar)!=10){
	$count=1;
	echo "here".$pmaadhar;
	}
$gender = $_POST['gender'];
$phone = $_POST['phone'];
if(strlen($phone)!=10){
	$count=1;
	echo "here".$phone;
	}
$state = $_POST['state'];
$address = $_POST['address'];
$pma = $_POST['pma'];
if(strlen($pma)!=10){
	$count=1;
	echo "here".$pma;
	}
$relative_name = $_POST['relative_name'];
if(preg_match("/^1234567890/",$relative_name)){
	$count=1;
	echo "here".$relative_name;
	}
$nr_phone = $_POST['nr_state'];
$nr_address = $_POST['nr_address'];
$nr_state = $_POST['nr_phone']; 
if(strlen($nr_phone)!=10){
	$count=1;
	echo "here".$nr_phone."state";
	}
$health_rating=$_POST['Choice'];
$start_date=$_POST['start_date'];
		$check=explode("-",$start_date);
		if($check[0]<=0 or $check[0]>=31){
				$count=1;
			}
		if($check[1]<=0 or $check[1]>=13){
				$count=1;
			}
		if($check[2]<=2000 or $check[2]>=2013){
				$count=1;
			}
$end_date=$_POST['end_date'];
		$checky=explode("-",$end_date);
		if($checky[0]<=0 or $checky[0]>=31){
				$count=1;
			}
		if($checky[1]<=0 or $checky[1]>=13){
				$count=1;
			}
		if($checky[2]<=2000 or $checky[2]>=2013){
				$count=1;
			}
		
		if($check[2]>$checky[2]){
			$count=1;
		}
		else{
			if($check[0]>$checky[0]){
				$count=1;
			}
			else{
				if($check[0]>$checky[0]){
					$count=1;
				}
			}
		
		}
		
if($count==1){
	header("Location:ErrorEntering.php");
	}
$_SESSION['pmaadhar']=$pmaadhar;
mysql_query("insert into prime_member values ('".$fname."','".$mname."','".$lname."','".$pmaadhar."','".$age."','".$gender."','".$phone."','".$state."','".$address."')",$link);
mysql_query("insert into nrr_relative values ('".$pmaadhar."','".$relative_name."','".$nr_state."','".$nr_address."')",$link);
mysql_query("insert into nr_phone values ('".$pma."','".$nr_phone."')",$link);
mysql_query("insert into dependent values ('".$pmaadhar."','".$pmaadhar."','".$fname."','".$gender."','".$age."','self','".$phone."')",$link);
mysql_query("insert into health_rating values('".$pmaadhar."','".$health_rating."')",$link);
mysql_query("insert into yatra_details values('".$pmaadhar."','".$start_date."','".$end_date."')",$link);
mysql_close($link);
if($count==0)
header("Location:dependent_aadhar.html");
?>