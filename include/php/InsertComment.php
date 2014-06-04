<?php
include 'FunctionsImp.php';
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$check = new FunctionsImp();
$post_id=$_GET['post_id'];
$uid=$_GET['uid'];
$Comment=$_POST['Comment'];
do{
$Comment_ID=rand()%100000;
}while($check->CheckCommentID($Comment_ID));
$var=(3600*24);
$hour=(int)((time()+(3600*(5.5)))%$var/3600);
$min=(int)(((time()+(3600*(5.5)))%$var%3600)/60);
$sec=(int)(((time()+(3600*(5.5)))%$var%3600)%60);
$time=$hour.":".$min.":".$sec;
mysql_query("insert into comments values('".$post_id."','".$uid."','".$Comment_ID."','".$Comment."','".date('d-m-Y')."','".$time."','".time()."')",$link);
header("Location:Notifications.php");   
?>