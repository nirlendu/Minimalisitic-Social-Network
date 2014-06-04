<?php
session_start();
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);	
if (isset($_POST['Submit1'])){
		$post_id=$_GET['a'];
		$Val=$_POST['Choice'];
		mysql_query("update posts_new set valid=".$Val." where post_id='".$post_id."'",$link);
		}
header("Location:Check.php");
?>

