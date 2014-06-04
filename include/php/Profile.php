<?php
session_start();
include 'FunctionsImp.php';
include'chat.html';
include 'AutoCheck.php';
$VID=$_GET['VID'];
$uid=$_SESSION['uid'];
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$Res=mysql_query("Select * from users where uid='".$VID."'",$link);
while($row=mysql_fetch_array($Res)){
	echo "<center>".$row['u_name'];
	echo "<br/>";
	echo $row['uid'];}
$check = new FunctionsImp();
if($check->CheckIfFriends($uid,$VID)){
	echo "<center><br/>already your Friend !<br/>";
	}
elseif($uid==$VID){
	echo "<center><br/><a href='Notifications.php'>Timeline</a><br/>";
	echo "<a href='PostUser.php'>Post Something</a><br/>";
	echo "<a href='FriendRequests.php'>Pending Friend Requests</a><br/>";
	echo "<a href='reg_prime_aadhar.html'>Register for a Tour</a><br/>";
	echo "<a href='Logout.php'>Logout</a><br/>";
}
elseif($check->SentFriendRequest($uid,$VID)){
	echo "<br/>Friend request sent<br/>";
	}
else{
	echo "<form method='post' action='SendFriendRequest.php?VID=".$VID."'>
					<Input type = 'Submit' Name = 'Submit1' VALUE = 'Send Friend Request'>
					</FORM>";
	}
?>