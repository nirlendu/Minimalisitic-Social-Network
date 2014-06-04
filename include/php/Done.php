<?php
session_start();
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$pmaadhar=$_POST['pmaadhar'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
$aadhar = $_POST['aadhar'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$relation = $_POST['relation'];
$no_past_visits= $_POST['no_past_visits'];
$last_visit = $_POST['last_visit'];
$health_rating=$_POST['Choice'];
mysql_query("insert into dependent values ('".$pmaadhar."','".$aadhar."','".$fname."','".$gender."','".$age."','".$relation."','".$phone."')",$link);
mysql_query("insert into past_yatra values('".$aadhar."','".$no_past_visits."','".$last_visit."')",$link);
mysql_query("insert into health_rating values('".$aadhar."','".$health_rating."')",$link);
mysql_close($link);
header("Location:Profile.php?VID=".$_SESSION['uid']);
?>