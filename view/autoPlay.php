<?php
session_start();
include("header.php");
include("../config/conn.php");
if(isset($_SESSION['user_id'])){
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['user_id'];    
}else{
    $user_id="";
}
?>
<html>    
<head>
    <?php
    if($user_id!=""){
        $title_add_info="的主屏幕-"; 
    }else{
        $title_add_info="";
    }
    ?>
<?php
if($user_id!=""){
?>
<meta name="title" content="<?php echo $user_name.$title_add_info;?>维特罗机器人-收藏,发现你感兴趣的信息-维特罗" />
<title><?php echo $user_name.$title_add_info;?>维特罗机器人-收藏，发现你感兴趣的信息-维特罗</title>
<?php
}else{
?>
<meta name="title" content="维特罗机器人-收藏,发现你感兴趣的信息-维特罗" />
<title>维特罗机器人-收藏，发现你感兴趣的信息-维特罗</title>
<?php
}
?>
<link rel="stylesheet" href="../css/autoPlay_style.css" media="screen,print" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/loadArea.js"></script>
<script type="text/javascript" src="../scripts/autoPlay.js"></script>
<script type="text/javascript" src="../scripts/hideit.js"></script>
<script type="text/javascript" src="../scripts/postjQuery.js"></script>
<script type="text/javascript" src="../scripts/autoPlay.js"></script>
<meta name="keywords" content="维特罗机器人,收藏,发现你感兴趣的信息,维特罗" />
<meta name="description" content="维特罗机器人,收藏,发现你感兴趣的信息,通过数据挖掘为用户推送他感兴趣的信息，以互联网链接为基础的社交平台" />
</head>
<body>
    <div id="autoPlay">
        <?php include("autoPlay_main.php");?>
    </div>
</body>
</html>