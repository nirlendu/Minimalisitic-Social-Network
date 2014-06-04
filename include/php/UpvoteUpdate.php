<?php
include 'AutoCheck.php';
$post_id=$_GET['post_id'];
$uid=$_GET['uid'];
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//mysql_query("delete from upvote where post_id='".$post_id."' and uid='".$uid."'",$link);
mysql_query("insert into upvote values('".$post_id."','".$uid."')",$link);
//echo "Upvote!";
header("Location:Notifications.php");
?>