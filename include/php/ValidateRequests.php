<?php
session_start();
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);	
$uid1=$_SESSION['uid'];
if (isset($_POST['Submit1'])){
		$VID=$_GET['VID'];
		$Val=$_POST['Choice'];
		mysql_query("update friend_req set flag=".$Val." where uid2='".$VID."' and uid1='".$uid1."'",$link);
		mysql_query("insert into friends values('".$VID."','".$uid1."')",$link);
		}
header("Location:FriendRequests.php");
?>