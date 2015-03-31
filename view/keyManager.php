<?php 
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../function/keyManager.php");
include("../config/conn.php");
$result_allkey=getallkeys($conn,$user_id);
$result_amount=getamount($conn,$user_id);
$sum=$result_allkey["sum"];
//var_dump($result_allkey);
//echo $result_amount."</br>";
?>
<div style="width:975px;">
    <strong>我的夹子</strong>
    <p style="margin-bottom: -10px;margin-top: 8px;">编辑我制作的夹子，点击-关闭控制台-退出</p>
<?php
for($i=0;$i<sizeof($result_allkey)-1;$i++){
$ulike=$result_allkey[$i]["ulike"];
$perc_like=$ulike/$sum*100;
?>
<article class="my_key" id="my_key_<?php echo $i;?>">
    <a><?php echo $user_name;?></a><p>制作</p>
    <a target="_blank" href="play.php?thiskey=<?php echo $result_allkey[$i]["id"];?>&other_user=<?php echo $user_id;?>">
        <div class="edit_key">
            <img alt="<?php echo $result_allkey[$i]["video_key"];?>" src="../images/keyFrontCover/<?php echo $result_allkey[$i]["id"];?>.jpg"></img>
            <div style="float:right;width:44%">
            <a target="_blank" href="play.php?thiskey=<?php echo $result_allkey[$i]["id"];?>&other_user=<?php echo $user_id;?>" style="width:91px;"><?php echo $result_allkey[$i]["video_key"];?></a> 
            <div style="float:right;width:100%;margin:5px auto;border-bottom:1px solid #e7e7e7;"></div>
            <div class="key_info">
                <p>获得的喜欢</p>
                <span class="icon-uniE600"></span>
                <strong><?php echo $result_allkey[$i]["sum_like"];?></strong></br>
                
            </div>   
            </div>    
        </div>
    </a>
    <div><text>喜爱程度</text><text><?php echo number_format($perc_like,2);?>%</text></div>
    <div style="margin-top:8px;"><text>链接个数</text><text><?php echo $result_allkey[$i]["amount"];?></text></div>
    <div class="btn_key">
    <button onclick="edit_my_key('<?php echo $result_allkey[$i]["id"];?>','<?php echo $i;?>','<?php echo $result_allkey[$i]["video_key"];?>','<?php echo number_format($perc_like,2);?>')" type="button">修改</button>
    <button onclick="delete_key('<?php echo $result_allkey[$i]["id"];?>','<?php echo $i;?>');"type="button">删除</button>
    </div>
</article>
<?php
}
?>
</div>
