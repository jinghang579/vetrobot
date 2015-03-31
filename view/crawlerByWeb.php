<?php
session_start();
include("../config/conn.php");
include("../function/getVideoKey.php");
include("../function/getLinkFromUser.php");
include("../function/crawler.php");
include("../function/insertReadyLink.php");
include("../function/getReadyLinks.php");
$user_id=$_SESSION['user_id'];
$key_id=array();
$key_value=array();
$key_name=array();
$sum=0;
$select_key_value=mysqli_query($conn,"SELECT id,video_key,ulike,dislike FROM vt_video_key WHERE uid='$user_id'");
while($row_key_value=mysqli_fetch_array($select_key_value)){
	$key=$row_key_value['video_key'];
	//echo $key;
	$perc=$row_key_value['ulike']/($row_key_value['ulike']+$row_key_value['dislike'])."</br>";
	$sum=$sum+$perc;
	//echo $perc;
	array_push($key_id,$row_key_value['id']);
	array_push($key_name, $key);
	array_push($key_value, $perc);
}
//echo $sum."</br>";
$result_num=key_perc($key_name,$key_value,$sum);
//echo $result_num."</br>";
$result_key=$key_name[$result_num];
$result_kid=$key_id[$result_num];
//echo $result_kid.$result_key."</br>";
$lid=get_lid($conn,$result_kid,$user_id);
$this_link=get_link($conn,$lid);
$this_title=get_title($this_link);
if($this_title==""){
	echo "没有挖掘到链接标题。"."</br>";
}
//echo $this_title;
$result_link=get_a_inpage($this_link,$result_key);
var_dump($result);
?>