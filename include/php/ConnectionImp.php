<?php
Class ConnectionImp{
		private $DataBase='work';
		function OpenConn(){
			$link = mysql_connect('localhost', 'root','systemachinist' ,$this->DataBase);
			mysql_select_db($this->DataBase,$link);	
			if (!$link) {
				die('Could not connect: ' . mysql_error());
				}
			return $link;
			}
			
		function CloseConn($link){
			mysql_close($link);		
		}
	}
?>