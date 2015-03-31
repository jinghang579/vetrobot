<?php
session_start();
include("../../config/conn.php");
include("../../function/likeKey.php");
if (!isset($_GET["uid"]) || empty($_GET["uid"])){
    //echo "None";
	exit;
}
$this_uid=$_GET["uid"];
$kid=$_GET["kid"];
$lid=$_GET["lid"];
$other_uid=$_GET["other_uid"];
if($this_uid==$other_uid){
    exit;
}
$likeornot=  $_GET["likeornot"];
//echo $this_uid."-".$kid."-".$likeornot."-".$lid."-".$other_uid;
if($likeornot==1){
    $_SESSION["dislike_count"]=0;
    //判断关键词是否已经存在，若不存在则添加
    $like_thiskey=like_thiskey($conn,$this_uid,$kid);
    if($like_thiskey==true){//说明为新用户，不是一个用户重复喜欢，要为所有SUMLIKE+1 
        add_sumlike_bykid($conn,$kid);
        add_sumlike_byuid($conn,$other_uid);
    }
    $like_web=like_web_bylid($conn,$lid,$this_uid);
    if($like_web==true){
        add_sumlike_bywid($conn,$lid);
    }
    $link_sumlikes=like_thislink($conn,$this_uid,$lid,$kid);
}else if($likeornot==0){
    $link_sumlikes=dislike_thislink($conn,$this_uid,$lid,$kid);
    $dislike_key=dislike_thiskey($conn,$this_uid,$kid);
    if($dislike_key==true){
        min_sumlike_bykid($conn,$kid);
        min_sumlike_byuid($conn,$other_uid);
    }
    $dislike_web=dislike_web_bylid($conn,$lid,$this_uid);
    if($dislike_web==true){
        min_sumlike_bywid($conn,$lid);
    }
}
echo $link_sumlikes;
?>