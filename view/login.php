<?php
session_start();
include("../config/conn.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // username and password sent from Form 
    $myusername=addslashes($_POST['user_name']); //addslashes 添加转义字符
    $mypassword=addslashes($_POST['user_passwd']); 
    $mypassword=MD5($mypassword);
    $sql="SELECT id FROM vt_users WHERE user_login='$myusername' and user_pass='$mypassword'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $user_id=$row['id'];
    $count=mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1){
    	$_SESSION['user_name']=$myusername;
        $_SESSION['user_id']=$user_id;
        if (isset($_SESSION['login_page']) && $_SESSION['login_page']!=""){
            $jump_page=$_SESSION['login_page'];
            header("location:".$jump_page);
        }else{
            header("location: main.php"); 
        }
    }else {
        echo "Your Login Name or Password is invalid";
        ?>
        </br>
        <a href="main.php">重新登录</a></br>
        <?php
    }
}else{
    echo "抱歉，需要先登录才能访问页面<a href=\"main.php\">返回登录</a>";
}
?>
