<?php 
//header('Location:keyManager.php');
include("../config/conn.php");
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../function/keyManager.php");
?>
<?php
if(isset($_GET['k'])){  
    $edit_id=$_GET['k']; 
    $key=  $_GET['key'];
    $num=$_GET['num'];
    $perc=$_GET["perc"]; 
    ?>
<input id="key_name"style="border: 1px solid #CCC;font-size: 14px;padding: 0px 8px;margin-top: 0px;width: 100%;" name="edit_key" type="text" placeholder="名称" value="<?php echo $key;?>"/>
<form id="imageform1" method="post" enctype="multipart/form-data" action="../function/uploadFC.php" style="height: 146px;margin-top:10px;">
<h6>修改封面</h6> 
<div id='preview1' style="width:100%;margin-top:8px;">
	<img id="pre_img" src="../images/keyFrontCover/<?php echo $edit_id;?>.jpg" style="width: 80px;height: 90px;"></img>
</div>
<input type="file" name="photoimg" id="photoimg1" />
<input type="text" style="visibility:hidden;height:0px;" name="kid" value="<?php echo $edit_id;?>"/>
</form>
<button class="red_btn" style="position: relative;" onclick="post_edit_key('<?php echo $edit_id;?>','<?php echo $num;?>','<?php echo $perc;?>')">保存</button>
    <?php
}
if(isset($_POST['key_name'])){
	$edit_key=$_POST['key_name'];
	$edit_id=$_POST['kid'];
	$num=$_POST['id'];
	//echo $edit_id."-".$edit_key."-".$num;
	edit_key_name($conn,$edit_id,$edit_key);
	$perc_like=$_POST['perc'];
	$this_key=getakey_byid($conn,$edit_id,$user_id);
	//var_dump($this_key);
?>
<a><?php echo $user_name;?></a><p>制作</p>
    <a target="_blank" href="playPage.php?thiskey=<?php echo $edit_id;?>&other_user=<?php echo $user_id;?>">
        <div class="edit_key">
            <img alt="<?php echo $edit_key;?>" src="../images/keyFrontCover/<?php echo $edit_id;?>.jpg"></img>
            <a target="_blank" href="playPage.php?thiskey=<?php echo $edit_id;?>&other_user=<?php echo $user_id;?>"><?php echo $edit_key;?></a> 
            <div style="float:right;width:44%;margin:5px auto;border-bottom:1px solid #e7e7e7;"></div>
            <div class="key_info">
                <p>获得的喜欢</p>
                <span class="icon-uniE600"></span>
                <strong><?php echo $this_key["sum_like"];?></strong></br>
                
            </div>       
        </div>
    </a>
    <div><text>喜爱程度</text><text><?php echo $perc_like;?>%</text></div>
    <div style="margin-top:8px;"><text>链接个数</text><text><?php echo $this_key["amount"];?></text></div>
    <div class="btn_key">
    <button onclick="edit_my_key('<?php echo $edit_id;?>','<?php echo $num;?>','<?php echo $edit_key;?>','<?php echo $perc_like;?>')" type="button">修改</button>
    <button onclick="delete_key('<?php echo $edit_id;?>','<?php echo $num;?>');" type="button">删除</button>
    </div>
    <?php
}
?>
