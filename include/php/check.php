<?php
	session_start();
	//include'FunctionsImp.php';
	include'AccountsImp.php';
	//include'chat.html';
	$check= new AccountsImp();
	//$check->GetNotificationsAdmin();
	//$uid=507;
	//$_SESSION['uid']=$uid;
	//$check->UpdateTimelineUser($uid);
	$check->Add_User('nikhil@gmail.com','nikhil','nikhil');
	//$post='2nd hey here !';
	//$check->PublishPostUsers($uid,$post);
	//$check->GetNotificationsAdmin();
	//$check->AcceptFriendRequest($uid);
	//echo time();
?>
<html>

</html>