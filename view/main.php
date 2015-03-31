<?php 
session_start();
include("header.php");
if(isset($_SESSION['user_id'])){
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['user_id'];    
}else{
    $user_id="";
}
include("../config/conn.php");
include("../function/getReadyLinks.php");
include("../function/linkManager.php");
include("../function/getVideoKey.php");
include("../function/userManager.php");
$num_readylinks=get_numreadylinks($conn,$user_id);
//echo $num_readylinks;
#$readylink_byuser=$_SESSION['readylink_byuser'];
?>
<html>    
<head>
    <?php
    if($user_id!=""){
        $title_add_info="的主屏幕-"; 
        $button_add_info="";
    }else{
        $title_add_info="";
        $button_add_info="data-action=\"button_add_info\" href=\"#login_box\" ";
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

<meta name="keywords" content="维特罗机器人,收藏,发现你感兴趣的信息,维特罗" />
<meta name="description" content="维特罗机器人,收藏,发现你感兴趣的信息,通过数据挖掘为用户推送他感兴趣的信息，以互联网链接为基础的社交平台" />
<script src="../scripts/jquery.core.js"></script>
<script type="text/javascript" src="../scripts/loadArea.js"></script>
<script type="text/javascript" src="../scripts/uploadImg.js"></script>
<script type="text/javascript" src="../scripts/hideit.js"></script>
<script type="text/javascript" src="../scripts/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>
<script type="text/javascript" src="../scripts/postjQuery.js"></script>
<script type="text/javascript" src="../scripts/selectKey.js"></script>
<script type="text/javascript" src="../scripts/mine_button.js"></script>
</head>
<body>
<div style="width:950px;margin:0 auto">
<div id="featured">
    <article>
        <?php
        if($user_id==""){
            //header("Location:index.php");
            ?>
            <aside id="leftaside">
            <?php echo "<img id='portrait' src='../users/0/portrait/myface".".jpg"."'> ";?>    
            <h2 style="margin: 9px 3px;width: 114px;">游客</h2>        
            <div class="achieve">
                <div id="score" onmouseover="showachieve(1)" onmouseout="hideachieve(1)"><?php echo countlikelinks($conn,$user_id);?></div>
                <div id="score" onmouseover="showachieve(2)" onmouseout="hideachieve(2)"><?php echo countinputlinks($conn,$user_id);?></div>
                <div id="score" onmouseover="showachieve(3)" onmouseout="hideachieve(3)"><?php echo countnumlikesyou($conn,$user_id);?></div>
                <div class="achieve_hide"id="achieve_hide1" style="display:none;">喜欢的链接</div>
                <div class="achieve_hide"id="achieve_hide2" style="display:none;">注入的链接</div>
                <div class="achieve_hide"id="achieve_hide3" style="display:none;">喜欢你的人</div>
            </div>
            <div id="des">
                我是游客我自豪
            </div>
            </aside>
            <?php
        }else{
            ?>
            <aside id="leftaside">
            <?php echo "<img id='portrait' src='../users/".$user_id."/portrait/myface".".jpg"."'> ";?>    
            <h2 style="margin: 9px 3px;width: 114px;"><?php echo $user_name?></h2>        
            <div class="achieve">
                <div id="score" onmouseover="showachieve(1)" onmouseout="hideachieve(1)"><?php echo countlikelinks($conn,$user_id);?></div>
                <div id="score" onmouseover="showachieve(2)" onmouseout="hideachieve(2)"><?php echo countinputlinks($conn,$user_id);?></div>
                <div id="score" onmouseover="showachieve(3)" onmouseout="hideachieve(3)"><?php echo countnumlikesyou($conn,$user_id);?></div>
                <div class="achieve_hide"id="achieve_hide1" style="display:none;">喜欢的链接</div>
                <div class="achieve_hide"id="achieve_hide2" style="display:none;">注入的链接</div>
                <div class="achieve_hide"id="achieve_hide3" style="display:none;">喜欢你的人</div>
            </div>
            <div id="des">
                <?php 
                    $des=get_des_byuser($conn,$user_id);
                    echo $des;
                ?>
            </div>
        </aside>
            <?php
        }
        ?>    

        <aside id="rightaside">
            <div class="r1">
                <button class="red_btn" title="制作你喜欢的链接夹子，程序会根据你喜爱的链接为你挖掘更有有趣的信息" <?php echo $button_add_info;?> type="button" onclick="loadInputURL(<?php echo $user_id;?>)">制作链接</button>
                <a title="机器人自动为你提供你可能喜欢的内容" class="green_a" href="autoPlay.php?p=0" target="_blank">开始观看</a>                
            </div>
            
            <div class="r2">
                <button   type="button" onclick="loadlikeKey(<?php echo $user_id;?>)">了解自己</button> 
                <button title="关闭当前控制台窗口" type="button" onclick="hideit()">关闭控制台</button>
            </div>
        </aside>
        <aside id="num_Ready">
            <?php include ("showScreen.php");?>
        </aside>
    </article>
</div>
<div id="ctrlScreen">
    <?php
    if($num_readylinks>0){
        //include("listReadyLinks.php");
    }else{
        //include("miningScreen.php");
    }
    ?>

</div>
<!--
<div class="ad">
    <a target="_blank" href="http://tnc.org.cn/ivory/web"><img title="为大象发声" src="../images/ad/ad1.jpg"></img></a>
    <a target="_blank" href="http://ent.qq.com/a/20140728/017167.htm"><img title="十分之一的幸福" src="../images/ad/ad2.jpg"></img></a>
</div>
-->
<div class="sub_header">
    <div class="nav">
        <li><a onclick="choose_folder(1)" href="javascript:void(0);">互联网</a></li>
        <li><a onclick="choose_folder(2)"href="javascript:void(0);">文摘</a></li>
        <li><a onclick="choose_folder(3)"href="javascript:void(0);">游戏</a></li>
        <li><a onclick="choose_folder(4)"href="javascript:void(0);">音乐</a></li>
        <li><a onclick="choose_folder(5)"href="javascript:void(0);">体育</a></li>
        <li><a onclick="choose_folder(6)"href="javascript:void(0);">动漫</a></li>
        <div class="search_bar">
            <input type="text" name="q" id="search_input" class="search_input" value="" placeholder="夹子名称，制作者..."></input>
            <button type="button" onclick="post_search();" class="icon-search"></button>
            <div id="search_auto">
            
            </div>
        </div>
    </div>
</div>
<div id="container">
<div class="wrap">
    <?php include("listAllKeys.php");?>
</div>
<?php 
    include("footer.php");
?>
</div>
</div>
</body>
</html>
