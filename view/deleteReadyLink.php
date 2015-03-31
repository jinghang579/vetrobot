<?php
session_start();
include("../config/conn.php");
include("../function/deleteReadyLink.php");
include("../function/getReadyLinks.php");
$user_id=$_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
	exit;
}
if (!isset($_GET["rid"]) || empty($_GET["rid"])){
	exit;
}
//echo $user_id."--".$rid."</br>";

$rid=$_GET["rid"];
$lid=$_GET["lid"];
$kid=$_GET["kid"];
//echo $rid.$lid.$kid;
$d_readylink=delete_readylink($conn,$user_id,$rid);
dislike_lid_kid($conn,$user_id,$kid,$lid);
//echo $d_readylink;
if($d_readylink==1){
	$num_readylinks=get_numreadylinks($conn,$user_id);
	if($num_readylinks>0){
		header("Location: listReadyLinks.php");
	}else{
        header("Location:miningScreen.php");
	}
	//echo "删除成功";
}
//echo "删除失败";
