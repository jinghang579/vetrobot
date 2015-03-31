<?php
session_start();
include("header.php");
include("../config/conn.php");
include("../function/removeReadyLink.php");
include("../function/getLinkFromUser.php");
include("../function/getVideoKey.php"); 
include("../function/likeKey.php");
include("../function/adManager.php");
if(isset($_SESSION['user_id'])){
   $user_id=$_SESSION['user_id']; 
}else{
    $user_id="";
}
//echo $user_id."</br>";
$thiskey=$_GET['thiskey'];
if($thiskey==""){
    echo "抱歉，您访问的页面不允许显示,请返回主页面<a href=\"main.php\">返回</a>";
}else{
    if(isset($_GET['other_user'])){
        $other_user=$_GET['other_user'];
    }else{
        $other_user="";
    }

//echo $other_user."</br>";
$check_like=check_like($conn,$user_id,$thiskey);

if($thiskey!=""){
    $key_info=get_key_byid($conn,$thiskey);
}
if($user_id!=""){
    $a_add_info="href=\"javascript:void(0);\"";
    if($check_like==1){
        $a_add_class="class=\"remove_likeit\"";
    }else{
        $a_add_class="class=\"likeit\"";
}
}else{
    $a_add_info="href=\"#login_box\"";
    $a_add_class="class=\"likeit\"";
}
?>
<head>
<meta name="title" content="<?php echo $key_info["key"];?>-维特罗机器人" />
<meta name="keywords" content="<?php echo $key_info["key"];?>,维特罗机器人,维特罗" />
<meta name="description" content="<?php echo $key_info["key"];?>,<?php echo $key_info["des"];?>-维特罗机器人,收藏,发现你感兴趣的信息,通过数据挖掘为用户推送他感兴趣的信息，以互联网链接为基础的社交平台" />
<title><?php echo $key_info["key"];?>-维特罗机器人-收藏，发现你感兴趣的信息-维特罗</title>
<script type="text/javascript" src="../scripts/maniLink.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/hideit.js"></script>
<script type="text/javascript" src="../scripts/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>
<script type="text/javascript" src="../scripts/postjQuery.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31488433-2', 'vetrobot.com');
  ga('send', 'pageview');

</script>
</head>
<?php
if($thiskey!=""){//这里只获取了KID，因为默认不同用户相同的KEY VALUE，其KEY ID也会不同。
    //var_dump($thiskey);
    $lid=array();
    $lid=get_lid_bykid($conn,$thiskey,$other_user);
    //var_dump($lid);
    $link=array();
    for($i=0;$i<sizeof($lid);$i++){
        if(isset($lid[$i])){
            $link[]=get_link($conn,$lid[$i]);
        }  
    }
    //var_dump($link);
    ?>
    <div class="playPage">
    <article>
        <?php echo "<img src='../images/keyFrontCover/".$thiskey.".jpg"."'> ";?>   
        <div class="play_middle">
            <h3><?php echo $key_info["key"]?></h3>
            <div class="play_info">
                <text>制作</text></br>
                <p><?php echo $key_info["user_name"];?></p>
            </div>
            <div id="likes">
                <a  id="like_key" <?php echo $a_add_info;?> <?php echo $a_add_class;?> onclick="like_key('<?php echo $user_id;?>',<?php echo $thiskey;?>)" >
                    <text style="position: relative;bottom: 5px;left: 8px;">喜欢
                    <strong id="key_sumlike"><?php echo $key_info["sumlike"];?></strong></text>
                </a>
            </div>      
            
        </div>
    </article>
    <?php
    //var_dump($link);
    for($i=0;$i<sizeof($lid);$i++){
        if (isset($lid[$i])){
            $check_like_link=check_like_link($conn,$user_id,$lid[$i]);
        }
        //echo $check_like_link."</br>";
        if($check_like_link==0){
            $link_add_class="class=\"like_link\""."title=\"点击-》喜欢这个链接\"";
        }else if($check_like_link==1){
            $link_add_class="class=\"remove_like_link\""."title=\"点击-》不喜欢这个链接\"";
        }
        ?>
        <article class="linkList" id="article_<?php echo $lid[$i];?>">
            <div id="<?php echo $lid[$i];?>" class="info">
                <div class="title">
                    <a title="<?php echo $key_info["key"];?>-<?php echo $link[$i]["title"];?>" href="<?php echo $link[$i]["link"];?>" target="_blank">
                        <?php echo $link[$i]["title"];?>
                    </a>
                    <div id="likeit">
                        <a id="like_link_<?php echo $user_id?>_<?php echo $lid[$i];?>" <?php echo $a_add_info;?> <?php echo $link_add_class;?> onclick="like_link('<?php echo $user_id;?>','<?php echo $thiskey;?>','<?php echo $lid[$i];?>','<?php echo $key_info["uid"];?>','<?php echo $lid[$i];?>')">
                        </a> 
                        <text style="position: relative;bottom: 2px;margin-right: 12px;">喜欢</text>
                    <?php
                    if($user_id==$other_user){
                        ?>
                        <button type="button" id="edit_link" onclick="show_edit_link(<?php echo $lid[$i];?>)" href="javascript:void(0);">编辑</button>
                        <button type="button" id="delete_link" class="red_btn" onclick="delete_link(<?php echo $lid[$i];?>,<?php echo $thiskey;?>)" href="javascript:void(0);">删除</button>
                        <?
                    }
                    ?>
                    </div>
                </div>
                <div class="link_content">
                    <?php
                    if(isset($link[$i]["content"]) && isset($link[$i]["link_type"]) && $link[$i]["link_type"]=="video" ){
                        ?>
                        <object  allowFullScreen="true" quality="high" allowScriptAccess="always" type="application/x-shockwave-flash" width="664" height="500" data="<?php echo $link[$i]["content"];?>"></object>
                        <?php
                    }
                    ?>
                </div>
                <div class="des">
                    <?php echo $link[$i]["des"];?>
                </div>
            </div>
            <form id="<?php echo $lid[$i];?>_form" method="POST" action="editLink.php" class="info_edit" style="display:none;">
                <div class="title">
                    <input style="width:100%"type="text" name="title_<?php echo $lid[$i];?>" title="<?php echo $key_info["key"];?>-<?php echo $link[$i]["title"];?>" value="<?php echo $link[$i]["title"];?>"/>
               
                <div id="likeit">
                    <a id="like_link_<?php echo $user_id?>_<?php echo $lid[$i];?>" <?php echo $a_add_info;?> <?php echo $link_add_class;?> onclick="like_link('<?php echo $user_id;?>','<?php echo $thiskey;?>','<?php echo $lid[$i];?>','<?php echo $key_info["uid"];?>','<?php echo $lid[$i];?>')">
                    </a> 
                    <text style="position: relative;bottom: 2px;margin-right: 12px;">喜欢</text>
                    <?php
                    if($user_id==$other_user){
                        ?>
                        <button type="button" class="red_btn" onclick="post_edit_link(<?php echo $lid[$i];?>)" href="javascript:void(0);" id="save_edit_link" class="linkButton" >保存</button>
                        <input name="lid_<?php echo $lid[$i];?>" style="visibility:hidden;width:0px;" value="<?php echo $lid[$i];?>"/>
                        <input name="m_<?php echo $lid[$i];?>" style="visibility:hidden;width:0px;" value="edit"/>
                        <?
                    }
                    ?>
                </div>
            </div>
                <textarea id="link_des_edit" name="des_<?php echo $lid[$i];?>" class="des" ><?php echo $link[$i]["des"];?></textarea>
            </form>
            <div class="link_ad">
                <?php
                $this_ad_id=get_ad_by_lid($conn,$lid[$i]);
                if(isset($this_ad_id) && $this_ad_id!="NULL"){
                    $this_ad=get_ad_by_aid($conn,$this_ad_id);
                    ?>
                    <div style="height:156px;">
                        <a target="_blank" href="<?php echo $this_ad["ad_url"];?>">
                            <img src="<?php echo $this_ad["ad_pic"];?>">
                        </a>
                    </div>
                    <div class="tag">
                        <a target="_blank" href="<?php echo $this_ad["ad_url"];?>"><?php echo $this_ad["ad_name"];?></a>
                    </div>    
                    <text class="ad_price"><?php echo $this_ad["ad_price"];?></text>
                    <?php
                }
                ?>
            </div>
        </article>
        <?php
    }
    ?>
</div>
<?php
}
}
?>
<div id="container">
            <?php 
    include("footer.php");
?>
    </div>