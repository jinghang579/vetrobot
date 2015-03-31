<?php 
include("header.php");
include("../config/conn.php");
include("../function/insertUsers.php");
if(!isset($_POST['sub_reg'])){
    echo "抱歉，您访问的页面不允许显示,请返回主页面<a href=\"main.php\">返回</a>";
}
$user_name = $_POST['user_name'];
$user_passwd = $_POST['user_passwd'];
$user_email = $_POST['user_email'];
$insert=insert_users($conn,$user_name,$user_passwd,$user_email);
if($insert){
  echo "注册成功，请返回主页面<a href=\"main.php\">返回</a>";
}else{
  echo "注册失败，请返回主页面<a href=\"main.php\">返回</a>";
}
?>
