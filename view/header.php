<?php
    header("Content-Type:text/html; charset=utf-8");
?>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/style.css" media="screen,print" type="text/css" />
    <script type="text/javascript" src="../scripts/hideit.js"></script>
    <script type="text/javascript" src="../scripts/inputCheck.js"></script>
    <link rel="icon" href="../images/favicon.ico" mce_href="../images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../images/favicon.ico" mce_href="../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../images/favicon.ico" type="image/gif" >
</head>
<header id="banner">
<section>
    <a id="logo" href="main.php">
    	维特罗机器人
    </a>
    <?php
    if(isset($_SESSION['user_id'])){
        $user_name=$_SESSION['user_name'];
        $user_id=$_SESSION['user_id'];    
    }
    if(!isset($user_id)||$user_id==""){
        ?>
        <div class="regbanner">
            <a href="#reg_box" class="reg-window">注册</a>
            <div id="reg_box">
            <form id="regForm" name="regForm" method="post" action="register.php" onSubmit="return InputCheck(this)">
            <input id="user_regname" type="text" name="user_name" maxlength="15" placeholder="用户名："/>
            <span class="error"id="user_result"></span>
            <input type="password" name="user_passwd" placeholder="密码："/>
            <input type="password" name="user_repasswd" placeholder="重复密码："/>
            <input type="text" name="user_email" placeholder="电子邮箱："/>
            <input id="in_button" type="submit" name="sub_reg"value="提交"/>
        </form>       
            </div>
        </div>
        <div class="regbanner">
            <a href="#login_box" class="login-window">登陆</a>
            <div id="login_box">
            <form id="loginForm" method="post" action="login.php">
                <input id="login_name" type="text" name="user_name"placeholder="用户名：" value tabindex="1"/></br>
                <input id="login_passwd"type="password" name="user_passwd" placeholder="密码：" value tabindex="2"/></br>
                <input id="in_button" type="submit" value="登陆">
                <a href="#reg_box" class="reg-window">注册</a>
            </form>       
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="regbanner">
            <a href="javascript:void(0);" title="编辑你制作的链接夹子" onclick="loadkeyManager()">我的夹子</a>
            <a title="设置用户头像及签名" href="javascript:void(0);" onclick="loadUserSetup(<?php echo $user_id;?>)">设置</a>
            <a href="logout.php">登出</a>    
        </div>
        <?php
    }
    ?>
</section>
</header>