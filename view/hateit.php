<?php
include("../function/hateUrl.php");
include("../config/conn.php");
session_start();
$user_id=$_SESSION['user_id'];
$input_key=$_SESSION['readykey_byuser'];
$input_url=$_SESSION['readylink_byuser'];
$array_input_web=split("/",$input_url,-1);
$input_web=$array_input_web[2];//此处的链接是去掉HTTP://的
echo $user_id."--".$input_key."--".$input_url."--".$input_web;
?>