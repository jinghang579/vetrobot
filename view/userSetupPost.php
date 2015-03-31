<?php
session_start();
include("../config/conn.php");
include("../function/userManager.php");
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
//if(!isset($_POST['edit_des'])){
//    echo "抱歉，您访问的页面不允许显示,请返回主页面<a href=\"main.php\">返回</a>";
//}
$new_des=$_POST['edit_des'];
echo $new_des;
if($result=update_des($conn,$user_id,$new_des)){
	return true;
}else{
	return false;
}
?>