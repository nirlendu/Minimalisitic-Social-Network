<?php

include 'ConnectionImp.php';
class AccountsImp extends ConnectionImp{

		function an($uid){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			mysql_query("insert into friends values('0','".$uid."')",$link);
			return;
		}

		function OAuth_User($u_email,$u_password){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("select * from users where u_email='".$u_email."'",$link);
			$Row=mysql_fetch_array($Res);
			if($Row['u_password']==$u_password){
					return true;
					}
			else
				return false;	
		}
		
		
		function GetUserID($u_email,$u_password){
			if($this->OAuth_User($u_email,$u_password)){
				$auth= new ConnectionImp();
				$link=$auth->OpenConn();
				$Res=mysql_query("select * from users where u_email='".$u_email."'",$link);
				$Row=mysql_fetch_array($Res);
				$auth->CloseConn($link);
				return $Row['uid'];
				}
			}
		
		function OAuth_Admin($a_email,$a_password){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$Res=mysql_query("select * from admin_datas where a_email='".$a_email."'",$link);
			$Row=mysql_fetch_array($Res);
			$auth->CloseConn($link);
			if($Row['a_password']==$a_password){
					return true;
					}
			else
				return false;
				
				}
				
		
		function Trigger($uid){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$query="create trigger T1 after insert on users 
			for each row begin
			when '".$uid."' <> '0'
			insert into friends values('0','".$uid."')
			end";
			mysql_query($query,$link);
			return;
		}
		
		
		function CheckUserID($uid){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$this->an($uid);
			if(mysql_fetch_array(mysql_query("Select count(*) from users where uid='".$uid."' ",$link))[0])
			return true;
			else
			return false;
		}
		
		function CheckEmailID($u_email){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			$this->an($uid);
			if(mysql_fetch_array(mysql_query("Select count(*) from users where u_email='".$u_email."' ",$link))[0])
			return true;
			else
			return false;
		}
		
				
		function Add_User($u_email,$u_password,$u_name){
			$auth= new ConnectionImp();
			$link=$auth->OpenConn();
			do{
			$uid=rand()%100000;
			}while($this->CheckUserID($uid));
			mysql_query("insert into users values('".$uid."','".$u_email."','".$u_password."','".$u_name."')",$link);
			$this->Trigger($uid);
			$auth->CloseConn($link);
			return;
			}
		}
?>