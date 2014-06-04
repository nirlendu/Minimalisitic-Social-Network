<?php
$pid=$_GET['q'];
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$Res=mysql_query("select * from hotel where pid='".$pid."'",$link);
while($Row=mysql_fetch_array($Res)){
			echo $Row['hotel_name'];
			echo "<br/>";
		}
?>