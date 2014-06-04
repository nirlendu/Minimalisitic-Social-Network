<?php
	include 'AccountsImp.php';
	
	class FunctionsImp extends AccountsImp{
		function PublishPostUsers($uid,$post){
			do{
			$Post_ID=rand()%100000;
			}while($this->CheckUserPostID($post_ID));
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Key=0;
			$var=(3600*24);
			$hour=(int)((time()+(3600*(5.5)))%$var/3600);
			$min=(int)(((time()+(3600*(5.5)))%$var%3600)/60);
			$sec=(int)(((time()+(3600*(5.5)))%$var%3600)%60);
			$time=$hour.":".$min.":".$sec;
			//mysql_query("create trigger R1 when posts_new.post_owner == '0' begin insert into posts_new values('".$Post_ID."','".$uid."','".$post."','1','".date('d-m-Y')."','".$time."','".time()."'); end",$link);
			//if($uid!=0){
			mysql_query("insert into posts_new values('".$Post_ID."','".$uid."','".$post."','".$Key."','".date('d-m-Y')."','".$time."','".time()."')",$link);
			//mysql_query("create trigger R1 after insert on posts_new for each row when New.post_owner == '0' begin update posts_new set valid='1' where post_owner='0' end",$link);
			$auth->CloseConn($link);
		}
		
		
		function PublishPostAdmin($post){
			do{
			$Post_ID=rand()%100000;
			}while($this->CheckUserPostID($post_ID));
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Key=1;
			$var=(3600*24);
			$uid=0;
			$hour=(int)((time()+(3600*(5.5)))%$var/3600);
			$min=(int)(((time()+(3600*(5.5)))%$var%3600)/60);
			$sec=(int)(((time()+(3600*(5.5)))%$var%3600)%60);
			$time=$hour.":".$min.":".$sec;
			//mysql_query("create trigger R1 when posts_new.post_owner == '0' begin insert into posts_new values('".$Post_ID."','".$uid."','".$post."','1','".date('d-m-Y')."','".$time."','".time()."'); end",$link);
			//if($uid!=0){
			mysql_query("insert into posts_new values('".$Post_ID."','".$uid."','".$post."','".$Key."','".date('d-m-Y')."','".$time."','".time()."')",$link);
			//mysql_query("create trigger R1 after insert on posts_new for each row when New.post_owner == '0' begin update posts_new set valid='1' where post_owner='0' end",$link);
			$auth->CloseConn($link);
		}
		
		
		function CheckCommentID($comment_id){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			if(mysql_fetch_array(mysql_query("Select count(*) from comments where comment_id='".$comment_id."' ",$link))[0])
			return true;
			else
			return false;
		}
		
		function CheckUserPostID($post_id){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			if(mysql_fetch_array(mysql_query("Select count(*) from posts_new where post_id='".$post_id."' ",$link))[0])
			return true;
			else
			return false;
		}
		
		
		function CheckAdminPostsID($post_id){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			if(mysql_fetch_array(mysql_query("Select count(*) from posts_admin where post_id='".$post_id."' ",$link))[0])
			return true;
			else
			return false;
		}
		
		
		function ValidatePosts($post_id){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			echo "<FORM name ='form1' method ='post' action ='ValidateAdminPosts.php?a=".$post_id."'>
			<Input type = 'Radio' Name ='Choice' value= '1'
			>      Validate<br/><br/>
			<Input type = 'Radio' Name ='Choice' value= '-1' 
			>      Don't Validate
			<P>
			<br/>
			<Input type = 'Submit' Name = 'Submit1' VALUE = 'Decision'>
			</FORM>";
			$auth->CloseConn($link);
			return;
		}
				
		function GetNotificationsAdmin(){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("Select * from posts_new where valid=0 ",$link);
			echo "<center>".mysql_fetch_array(mysql_query("Select count(*) from posts_new where valid=0 ",$link))[0]." new notifications <br/>";
			while($row=mysql_fetch_array($Res)){
				$name=mysql_fetch_array(mysql_query("Select u_name from users where uid='".$row['post_owner']."'",$link));
				echo"<a href=Profile.php?VID=".$row['post_owner'].">".$name['u_name']."</a><br/>";
				echo "<h3>".$row['post']."</h3>";
				$this->ValidatePosts($row['post_id']);
			}
		}
		
		
		function GetFriendsList($uid){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$list=array();
			$Res1=mysql_query("select * from friends where uid2='".$uid."'",$link);
			$Res2=mysql_query("select * from friends where uid1='".$uid."'",$link);
			while($row=mysql_fetch_array($Res1)){
					$list[]=$row['uid1'];
				}
			while($row=mysql_fetch_array($Res2)){
					$list[]=$row['uid2'];
				}
			$auth->CloseConn($link);
			return $list;
		}
		
		
		function CheckIfFriends($uid1,$uid2){
			$list=$this->GetFriendsList($uid1);
			foreach($list as $fr){
				if ($fr==$uid2)
				return true;
				}
			return false;
		}
		
		
		
		function SendFriendRequest($uid1,$uid2){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			mysql_query("insert into friend_req values('".$uid2."','".$uid1."','0')",$link);
		}
		
		
		function ValidateRequest($uid2){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			echo "<center><FORM name ='form1' method ='post' action ='ValidateRequests.php?VID=".$uid2."'>
			<Input type = 'Radio' Name ='Choice' value= '1'
			>Accept
			<Input type = 'Radio' Name ='Choice' value= '-1' 
			>Decline
			<P>
			<Input type = 'Submit' Name = 'Submit1' VALUE = 'Decision'>
			</FORM>";
			$auth->CloseConn($link);
			return;
		}
		
		
		function AcceptFriendRequest($uid1){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("Select * from friend_req where uid1='".$uid1."' and flag='0' ",$link);
			echo "<center>".mysql_fetch_array(mysql_query("Select count(*) from friend_req where flag='0'",$link))[0]." new friend requests <br/>";
			while($row=mysql_fetch_array($Res)){
				$name=mysql_fetch_array(mysql_query("Select u_name from users where uid='".$row['uid2']."'",$link));
				echo"<center><a href=Profile.php?VID=".$row['uid2'].">".$name['u_name']."</a><br/>";
				$this->ValidateRequest($row['uid2']);
			}
		}
		
		
		function SentFriendRequest($uid1,$uid2){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			if(mysql_fetch_array(mysql_query("Select count(*) from friend_req where (uid1='".$uid1."' and uid2='".$uid2."')or(uid1='".$uid2."' and uid2='".$uid1."')",$link))[0])
			return true;
			else
			return false;
		}
		
		
		function UpdateTimelineUser($uid){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("Select * from posts_new where valid=1 order by sec desc",$link);
			echo "<center>".mysql_fetch_array(mysql_query("Select count(*) from posts_new where valid=1",$link))[0]." new notifications <br/>";
			while($row=mysql_fetch_array($Res)){
				$name=mysql_fetch_array(mysql_query("Select u_name from users where uid='".$row['post_owner']."'",$link));
				echo"<p><a href=Profile.php?VID=".$row['post_owner'].">".$name['u_name']."</a><h5> posted on ".$row['date']." at ".$row['time']."</h5></p>";
				echo "<h3>".$row['post']."</h3>";
				if((mysql_fetch_array(mysql_query("Select uid from upvote where uid='".$uid."' and post_id='".$row['post_id']."'",$link))[0])==$uid){
					echo "<form method='post' action='DownvoteUpdate.php?uid=".$uid."&&post_id=".$row['post_id']."'>
					<Input type = 'Submit' Name = 'Submit1' VALUE = 'Downvote'>
					</FORM>";
					echo "You and ";
					echo (mysql_fetch_array(mysql_query("Select count(*) from upvote where post_id='".$row['post_id']."'",$link))[0]-1)." upvoted this this <br/>";
					}
				else{
					echo "<form method='post' action='UpvoteUpdate.php?uid=".$uid."&&post_id=".$row['post_id']."'>
					<Input type = 'Submit' Name = 'Submit1' VALUE = 'Upvote'>
					</FORM>";
				echo mysql_fetch_array(mysql_query("Select count(*) from upvote where post_id='".$row['post_id']."'",$link))[0]." upvoted this this <br/>";}
				$this->ShowComments($row['post_id']);	
				echo "<form method='post' action='InsertComment.php?uid=".$uid."&&post_id=".$row['post_id']."'>
					<input type='text' name='Comment'>
					<Input type ='Submit' Name = 'Submit1' VALUE = 'Comment'>
					</FORM>";
			}
			$auth->CloseConn($link);
			return ;
		}
		
		function ShowComments($post_id){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("select * from comments where post_id='".$post_id."'",$link);
			while($row=mysql_fetch_array($Res)){
				$name=mysql_fetch_array(mysql_query("Select u_name from users where uid='".$row['uid']."'",$link));
				echo"<a href=Profile.php?VID=".$row['uid'].">".$name['u_name']."</a> commented on".$row['date']." at ".$row['time'];
				echo "<br/>".$row['comment']."<br/>";
			}
			$auth->CloseConn($link);
			return;
		}
		
		function ValidateEntriesAdmin(){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("Select * from prime_member where valid=0 ",$link);
			while($row=mysql_fetch_array($Res1)){
				
			}
		}
		
		function Logout(){
			Session_start();
			Session_destroy();
			header("Location:index.html");
		}
	}
?>