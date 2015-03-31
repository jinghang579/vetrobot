<?php
session_start();
include("header.php");
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../config/conn.php");
include("../function/getVideoKey.php");
include("../function/userManager.php");
if($user_id==""||$_GET["u"]==""){
	exit;
}
$other_user_id=$_GET["u"];
//echo $other_user;
$other_user=get_user_info($conn,$other_user_id);
?>
<head>
<meta name="title" content="<?php echo $key_info["key"];?>-维特罗机器人" />
<meta name="keywords" content="<?php echo $key_info["key"];?>,维特罗机器人,维特罗" />
<meta name="description" content="<?php echo $key_info["key"];?>,<?php echo $key_info["des"];?>-维特罗机器人,收藏,发现你感兴趣的信息,通过数据挖掘为用户推送他感兴趣的信息，以互联网链接为基础的社交平台" />
<title><?php echo $key_info["key"];?>-维特罗机器人-收藏，发现你感兴趣的信息-维特罗</title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31488433-2', 'vetrobot.com');
  ga('send', 'pageview');

</script>
</head>