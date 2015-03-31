<?php
include("../config/conn.php");
include("../function/likeKey.php");
include("../function/getVideoKey.php");
if (isset($_GET["uid"]) && !empty($_GET["uid"])){
    $uid=$_GET["uid"];
    $kid=$_GET["kid"]; 
    $likeornot=  $_GET["likeornot"];
    //echo $uid."-".$kid."-".$likeornot;
    if($likeornot==1){
        //判断关键词是否已经存在，若不存在则添加
        $like_thiskey=like_key($conn,$uid,$kid);
        if($like_thiskey==true){
            //为KEY添加一个SUMLIKE 
            $add_sumlike=add_sumlike_bykid($conn,$kid);
            //echo "like";
        }
        
    }else if($likeornot==0){
        //判断关键词是否存在，若存在则删除
        $dislike_thiskey=dislike_key($conn,$uid,$kid);
        if($dislike_thiskey==true){
            $min_sumlike=min_sumlike_bykid($conn,$kid);
            //echo "dislike";
        }
    }
    $key_info=get_key_byid($conn,$kid);
    echo $key_info["sumlike"];
}
?>
