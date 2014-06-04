<?php
include 'chata.html';
$link = mysql_connect('localhost', 'root','systemachinist' ,'work');
mysql_select_db('work',$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$AadharList=array();
$row=array();
$Re=array();
$Count=0;
$Visit=[];
$Check=0;
  
  if(!empty($_POST['PastVisit'])){
    $Visit =$_POST['PastVisit'];
    $N = count($Visit);
	$row="(".$Visit[0].")";
    for($i=1; $i < $N; $i++){
	  $row=$row." or (".$Visit[$i].")";
    }
	$Res=mysql_query("select paadhar from past_yatra where ".$row,$link);
	while($Row=mysql_fetch_array($Res)){
		$Check=1;
		if(empty($AadharList)){
		$Re[]=$Row['paadhar'];
		}
		else{	
			//find common elements;
			foreach($AadharList as $Ad){
				if($Ad==$Row['paadhar'])
				$Re[]=$Ad;
				}
			}
		}
		if(!count($Re))
		$Count=1;
		$AadharList=$Re;
		$Re=[];
	}
	
  
  if(!empty($_POST['Age'])){
    $Visit = $_POST['Age'];
    $N = count($Visit);
	$row="(".$Visit[0].")";
    for($i=1; $i < $N; $i++){
	  $row=$row." or (".$Visit[$i].")";
    }
	$Res=mysql_query("select daadhar from dependent where ".$row,$link);
	while($Row=mysql_fetch_array($Res)){
		if(empty($AadharList))
		$Re[]=$Row['daadhar'];
		else{	
			foreach($AadharList as $Ad){
				if($Ad==$Row['daadhar']){
				$Re[]=$Ad;}
				}
			}
		}
		if(!count($Re))
		$Count=1;
		$AadharList=$Re;
		$Re=[];
	}
	
	
	
   if(!empty($_POST['NoDependent'])){
    $Visit = $_POST['NoDependent'];
    $N = count($Visit);
	$row="(".$Visit[0].")";
    for($i=1; $i < $N; $i++){
	  $row=$row." or (".$Visit[$i].")";
    }
	$Res=mysql_query("select pmar from dependent as a where ".$row,$link);
	while($Row=mysql_fetch_array($Res)){
		if(empty($AadharList))
		$Re[]=$Row['pmar'];
		else{	
			foreach($AadharList as $Ad){
				if($Ad==$Row['pmar']){
				$Re[]=$Ad;}
				}
			}
		}
		if(!count($Re))
		$Count=1;
		$AadharList=$Re;
		$Re=[];
	}
	
	
	
   if(!empty($_POST['Gender'])){
    $Visit = $_POST['Gender'];
    $N = count($Visit);
	$row="(".$Visit[0].")";
    for($i=1; $i < $N; $i++){
	  $row=$row." or (".$Visit[$i].")";
    }
	$Res=mysql_query("select daadhar from dependent where ".$row,$link);
	while($Row=mysql_fetch_array($Res)){
		if(empty($AadharList))
		$Re[]=$Row['daadhar'];
		else{	
			foreach($AadharList as $Ad){
				if($Ad==$Row['daadhar']){
				$Re[]=$Ad;}
				}
			}
		}
		if(!count($Re))
		$Count=1;
		$AadharList=$Re;
		$Re=[];
	}
	
	
	$N = count($AadharList);
	$Sel='';
	if($N){
	$Sel="daadhar='".$AadharList[0]."'";
    for($i=1; $i < $N; $i++){
	  $Sel=$Sel." or daadhar='".$AadharList[$i]."'";
    }}
	if($Count){
			echo "<center>Sorry ! No Results Found !";
	}
	elseif(!empty($Sel)){
		$Res=mysql_query("select * from dependent where ".$Sel,$link);
		while($Row=mysql_fetch_array($Res)){
			echo "<center>".$Row['daadhar'];
			echo " ";
			echo $Row['name'];
			echo "<br/>";
			}
	}
	elseif(!$Visit){
		$Res=mysql_query("select * from dependent",$link);
		while($Row=mysql_fetch_array($Res)){
			echo "<center>".$Row['daadhar'];
			echo "<br/>";
			echo $Row['name'];
			echo "<br/>";
		}
	}
?>