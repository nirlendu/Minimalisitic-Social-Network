<?php
include 'chata.html';
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if(isset($_POST['query'])){
	$admin_query=$_POST['query'];
	//echo $query;
	$lol=mysql_query($admin_query,$link);
	$row=mysql_fetch_array($lol);
	print_r($row);
	//echo "<center>";
	//print_r(mysql_fetch_array(mysql_query($query,$link)));
}
?>
<html>
<center>
<form method="post" action="">
<INPUT TYPE = "Text" VALUE ="" NAME = "query">
<br/>
<input type="submit" value="Hit Query !">
</form>
</html>