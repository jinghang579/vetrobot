<?php 
header("Content-Type: text/html; charset=utf-8");

?>
<html>

<head>
    <meta name="title" content="维特罗机器人,收藏,发现你感兴趣的信息,维特罗" />
    <meta name="keywords" content="维特罗机器人,收藏,发现你感兴趣的信息,维特罗" />
    <meta name="description" content="维特罗机器人,收藏,发现你感兴趣的信息,维特罗,数据挖掘,信息推送,智能搜索,社交网络" />
    <title>维特罗机器人-收藏，发现你感兴趣的信息-维特罗</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../scripts/hideit.js"></script>
    <script type="text/javascript" src="../scripts/inputCheck.js"></script>
    <link rel="stylesheet" href="../css/style.css" media="screen,print" type="text/css" /> 
    
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
 
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31488433-2', 'vetrobot.com');
  ga('send', 'pageview');

</script>
</head>
<body ><!--style="background-color:#099AD3"-->
<div class="login_wrapper">
    <div class="login_header">
        <h1>维特罗<strong>机器人</strong></h1>
    </div>
    <div id="reg_box" style="display:none">
        <form id="regForm" name="regForm" method="post" action="register.php" onSubmit="return InputCheck(this)">
        <input id="user_regname" type="text" name="user_name" maxlength="15" placeholder="用户名："/>
        <span class="error"id="user_result"></span>
        <input type="password" name="user_passwd" placeholder="密码："/>
        <input type="password" name="user_repasswd"placeholder="重复密码："/>
        <input type="text" name="user_email"placeholder="电子邮箱："/>
        <input id="in_button" type="submit" name="sub_reg"value="提交"/>
        </form>        
    </div>
    <div id="login_box">
        <form id="loginForm"method="post" action="login.php">
        <input id="login_name" type="text" name="user_name"placeholder="用户名：" value tabindex="1"/></br>
        <input id="login_passwd"type="password" name="user_passwd" placeholder="密码：" value tabindex="2"/></br>
        <input id="in_button" type="submit" value="登陆">
        <input id="in_button" type="button" value="注册" onclick="showreg()">
        </form>        
    </div>
</div>
<?php
include("footer.php");
?>
</body>
</html>
