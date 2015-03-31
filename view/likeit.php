<?php
include("../function/likeUrl.php");
include("../config/conn.php");
session_start();
if (!isset($_GET["uid"]) || empty($_GET["uid"])){
	exit;
}
$user_id=$_GET['uid'];
$key=$_GET['kid'];
$link=$_GET['link'];
$likeornot=$_GET['likeornot'];
$ifexist=$_GET['ifexist'];
$method=$_GET['method'];
//echo $user_id."--".$key."--".$ifexist."--".$link."--".$likeornot."</br>";
if($method=="update"){
	$temp=explode(",",$key);
	$other_user=$temp[0];
	$kid=$temp[2];
	$lid=$temp[1];
	//echo $kid.$lid.$other_user;
if($likeornot==1){
	if($ifexist==0){
	    $result_like=like_update_readylink($conn,$user_id,$kid,$lid,$other_user);
	    if($result_like==1){
	    	echo "您已成功收藏这个链接！"."</br>";
	    }else{
	    	echo "抱歉，未收藏成功。。"."</br>";
	    }
    }else if($ifexist==1){
        return;
    }else{
    	return;
    }
}
else if($likeornot==0){
	//echo "DISLIKE";
	$result_dislike=dislike_readylink($conn,$user_id,$kid,$lid);
    if($result_dislike==1){
	    echo "您已成功取消收藏这个链接！"."</br>";
	}else{
	    echo "抱歉，操作失败。。"."</br>";
	}
}
}
?>