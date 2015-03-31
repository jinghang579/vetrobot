<?php
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../config/conn.php");
include("../function/likeKey.php");
$del=$_POST["del_kid"];
//var_dump($del);
for($i=0;$i<sizeof($del);$i++){
	delete_likekey_bykid($conn,$user_id,$del[$i]);
}
echo "删除成功！";
?>