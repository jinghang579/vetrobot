<?php
include("../config/conn.php");
include("../function/insertUsers.php");
if(isset($_POST["username"])){
    $user_name=$_POST["username"];
    $username_exist=check_username($conn,$user_name);
    if($username_exist>0){
        echo "抱歉，用户名已经存在";
        $user_exist=true;
    }else{
    	$user_exist=false;
        echo "用户名可用";
    }

}else{
	echo "Username check invalid";
}
    function user_exist(){
        return $user_exist;
    }
?>