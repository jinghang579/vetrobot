<?php
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../config/conn.php");
include("../function/linkManager.php");
include("../function/getLinkFromUser.php");
if(!isset($_POST["lid"])||$user_id==""){
	exit;
}
?>
<?php
$lid=$_POST["lid"];
$title=$_POST["title"];
$des=$_POST["des"];
$m=$_POST["m"];
$link_add_class="class=\"remove_like_link\""."title=\"点击-》不喜欢这个链接\"";
//echo $lid.$title.$des;
if($m=="edit"){
	edit_titledes($conn,$lid,$title,$des);
	$link=get_link($conn,$lid);
	?>
	<div id="<?php echo $lid;?>" class="info">
        <div class="title">
            <a title="<?php echo $key_info["key"];?>-<?php echo $link["title"];?>" href="<?php echo $link["link"];?>" target="_blank"><?php echo $link["title"];?></a>
                
                <div id="likeit">
                    <a id="like_link_<?php echo $user_id?>_<?php echo $lid?>" <?php echo $a_add_info;?> <?php echo $link_add_class;?> onclick="like_link('<?php echo $user_id;?>','<?php echo $thiskey;?>','<?php echo $lid;?>','<?php echo $key_info["uid"];?>','<?php echo $lid;?>')">
                    </a> 
                    <text style="position: relative;bottom: 2px;margin-right: 12px;">喜欢</text>
                    <button type="button" id="edit_link" onclick="show_edit_link(<?php echo $lid;?>)" href="javascript:void(0);">编辑</button>
                    <button type="button" id="delete_link" class="red_btn" onclick="delete_link(<?php echo $lid;?>)" href="javascript:void(0);">删除</button>
                </div>
        </div>
                <div class="des">
                    <?php echo $link["des"];?>
                </div>
    </div>
    <form id="<?php echo $lid;?>_form" method="POST" action="editLink.php" class="info_edit" style="display:none;">
                <div class="title">
                    <input type="text" name="title_<?php echo $lid;?>" title="<?php echo $key_info["key"];?>-<?php echo $link["title"];?>" value="<?php echo $link["title"];?>"/>
                
                <div id="likeit">
                    <a id="like_link_<?php echo $user_id?>_<?php echo $lid;?>" <?php echo $a_add_info;?> <?php echo $link_add_class;?> onclick="like_link('<?php echo $user_id;?>','<?php echo $thiskey;?>','<?php echo $lid;?>','<?php echo $key_info["uid"];?>','<?php echo $lid;?>')">
                    </a> 
                    <text style="position: relative;bottom: 2px;margin-right: 12px;">喜欢</text>
                        <button type="button" class="red_btn" onclick="post_edit_link(<?php echo $lid;?>)" href="javascript:void(0);" id="save_edit_link" >保存</button>
                        <input name="lid_<?php echo $lid;?>" style="visibility:hidden;width:0px;" value="<?php echo $lid;?>"/>
                        <input name="m_<?php echo $lid;?>" style="visibility:hidden;width:0px;" value="edit"/>
                </div>
                </div>
                <textarea id="link_des_edit" name="des_<?php echo $lid;?>" class="des" ><?php echo $link["des"];?></textarea>
            </form>
    <?php
}else if($m=="del"){
    $kid=$_POST["kid"];
    delete_link($conn,$lid,$kid);
}
?>
