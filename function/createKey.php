<?php
session_start();
include("../config/conn.php");
include("../function/getVideoKey.php");
include("../function/crawler.php");
include("../function/folderManager.php");
include("../function/webManager.php");
$user_id=$_SESSION['user_id'];
if(!isset($_POST["link"])){
?>
<article>
    <strong>制作链接，收藏并分享你的兴趣</strong>
    <p>点击-关闭控制台-即可退出制作</p>
    <input type="link" name="link" id="input_link" placeholder="粘贴要制作的链接网址"/>
    <button style="margin-left:8px;" onclick="post_input_link()" class="red_btn">收录链接！</button>
    <div id="loader" style="width:110px;float: right;margin-top: 8px;display:none;">
    <text>获取链接中</text>
    <img src="../images/loader/screen_loader.gif" alt="获取链接中">
    </div>
</article>
<?php
}else{
$link=$_POST["link"];
$allkeys=select_allkeys_byuser($conn,$user_id);
$title=get_title($link);
$folder=get_all_folders($conn);
$web=get_web($link);
$type=get_web_attr($web,$conn);
?>
<article style="height:960px;">
    <strong>编辑链接</strong>
    <p>点击-关闭控制台-即可退出制作</p>
    <form id="create_key" enctype="multipart/form-data" action="" method="post" style="height: 91%;">
        <div class="link_title link_input">
            <text>链接题目：</text></br>
            <?php
            if($title!=""){?>
                <input style="width:440px;" type="text" name="url_title" id="url_title" placeholder="链接题目" value="<?php echo $title;?>"/>
            <?php
            }else{
            ?>
                <input style="width:440px;" type="text" name="url_title" id="url_title" placeholder="链接题目"/></br>
            <?php
            }
            ?>
        </div>
        <?php
        if($type==""){ //type is null, which means this web is new or never be classified.
        ?>
        <div class="link_input link_type">
            <text>链接类型: </text></br>
            <div class="selector link_input" style="width:80px;">
                <li onclick="load_type()" id="select_type" name="select_type" value="<?php echo "1";?>">视频</li>      
            <div class="sub_select" id="sub_type" style="width:80px;display:none;" >
                <li onclick="pass_type('<?php echo "1";?>','视频')">视频</li>
                <li onclick="pass_type('<?php echo "2";?>','图文')">图文</li>
            </div>
            </div>
            <div  class="input_content" id="input_content_div">
                <text>视频FLASH代码：</text></br>
                <input style="width:440px;" type="link" name="content" id="input_content" placeholder="粘贴视频FLASH地址(.swf)"/>
            </div>
        </div>
        <?php
        }else{//type is not null.
            $web_con=get_web_cont($web,$conn);
            if($type=="video"){
                $same_link="";
                if(stristr($link,$web_con["from_link"])){
                    $same_temp=explode($web_con["from_link"], $link);
                    $same_temp1=explode($web_con["from_offset"], $same_temp[1]);
                    $same_link=$same_temp1[0];
                }
                ?>
                <input style="display:hidden;" id="input_content" value="<?php echo $web_con["content"].$same_link.$web_con["offset"];?>"/>
                <li style="display:none;" id="select_type" name="select_type" value="<?php echo "1";?>">视频</li>
                <object width="440" height="356" data="<?php echo $web_con["content"].$same_link.$web_con["offset"];?>"></object>
                <?php
            }
        }
        ?>
        <div class="link_input">
            <text>评论或描述这个链接：</text></br>
            <textarea name="linkdes" id="link_des" placeholder="请说说你对这个链接的看法"></textarea>
        </div>  
        <div class="link_input">
            <text>选择夹子：</text> </br>
            <div style="height: 40px;">
                <div class="selector" style="float:left">
                    <li onclick="load_selector('<?php echo $user_id;?>')" id="select_key" style="height:15px;"name="select_key" value="<?php if(isset($allkeys["id"][0])){echo $allkeys["id"][0];}?>">
                        <?php if(isset($allkeys["value"][0])){echo $allkeys["value"][0];}?>
                    </li>
                <div class="sub_select"id="sub_select" style="display:none;" >
                </div>
            </div>
            <text style="margin-right: 8px;">或者</text>
                <button type="button" class="green_btn" style="height: 36px;"onclick="show_create_new_key()" href="javascript:void(0);">创建新夹子</button>
                <button type="button" id="cancle_create" style="height: 36px;display:none;"onclick="hide_create_new_key()">取消</button>
            </div>
        </div>
        <div class="link_input" id="create_new_key" style="height:236px;display:none;">
            <input type="text" name="input_key" id="input_key" placeholder="新夹子名称：" ></input>
            <div class="selector">
                <li onclick="load_folder()" id="select_folder" name="folder" value="<?php if(isset($folder[0]["fid"])){echo $folder[0]["fid"];}?>">
                    <?php if(isset($folder[0]["f_name"])){echo $folder[0]["f_name"];}?>
                </li>
                <div class="sub_select" id="folder" style="display:none;" >
                <?php
                for($i=0;$i<sizeof($folder);$i++){
                ?>
                    <li onclick="pass_folder('<?php echo $folder[$i]["fid"]?>','<?php echo $folder[$i]["f_name"]?>')">
                        <?php echo $folder[$i]["f_name"]?>
                    </li>
                <?php
                }
                ?>
                </div>
            </div>
            <div class="link_input" style="position:absolute;width: 200px;">
                <text>夹子封面:</text></br>
                <img id="uploadPreview" style="width:100px;height:107px;display:none;float:left" />
                <input type="file" name="key_cover" id="key_cover" onchange="previewImage();"/>
            </div>
        </div>          
    <button  style="width:70px;font-size:14px;height:36px;" class="red_btn" type="button" onclick="postcreateKey('<?php echo $link;?>')">保存</button>
    </form>   
</article>
<?php
}
?>
