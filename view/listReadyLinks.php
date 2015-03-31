<?php
session_start();
include("../config/conn.php");
$user_id=$_SESSION['user_id'];
//echo $user_id."</br>";
if($user_id!=""){
    $a_add_info="href=\"javascript:void(0);\"";
}else{
    $a_add_info="href=\"#login_box\"";
    $a_add_class="class=\"likeit\"";
}
//echo "这里是LIST OF READYLINKS！"."</br>";
$ready_list=array();
$ready_list=get_readylinks($conn,$user_id);
//var_dump($ready_list);
for($i=0;$i<sizeof($ready_list);$i++){
	if($ready_list[$i]["from"]=="se_google"){
		$ifexist=check_exist($conn,$user_id,$ready_list[$i]["link"],$ready_list[$i]["offset"]);
		if($ifexist==1){
            $a_add_class="class=\"remove_like_link\""."title=\"点击-》不喜欢这个链接\"";
        }else{
            $a_add_class="class=\"like_link\""."title=\"点击-》喜欢这个链接\"";
        }
		?>
        <div class="ready_link">
            <p>来自谷歌</p>
            <a class="alink" target="_blank" title="<?php echo $ready_list[$i]["title"];?>" href="<?php echo $ready_list[$i]["link"];?>"><?php echo $ready_list[$i]["title"];?></a>
            <a class="alink" target="_blank" href="playPage.php?thiskey=<?php echo $ready_list[$i]["offset"];?>&other_user=<?php echo $user_id;?>">[<?php echo $ready_list[$i]["key"];?>]</a> 
            <a id="like_readylink_<?php echo $user_id?>_<?php echo $i?>" <?php echo $a_add_info;?> <?php echo $a_add_class;?> onclick="like_readylink('<?php echo $user_id;?>','<?php echo $ready_list[$i]["offset"];?>','<?php echo $ready_list[$i]["link"];?>','<?php echo $ifexist;?>','<?php echo $i;?>')">
                <span class="arrow"></span>喜欢
            </a> 
            <a class="delete_readylink" onclick="delete_readylink('<?php echo $ready_list[$i]["id"];?>')" href="javascript:void(0);">删除</a>
        </div>
		<?php
	}else if($ready_list[$i]["from"]=="update"){
        $temp=explode( ",",$ready_list[$i]["offset"]);
        $kid=$temp[2];
        $lid=$temp[1];
        $ifexist=check_exist_bylid($conn,$user_id,$lid,$kid);
        if($ifexist==1){
            $a_add_class="class=\"remove_like_link\""."title=\"点击-》不喜欢这个链接\"";
        }else{
            $a_add_class="class=\"like_link\""."title=\"点击-》喜欢这个链接\"";
        }
        ?>
        <div class="ready_link">
            <p>更新</p>
            <img src="../users/<?php $temp=explode(',', $ready_list[$i]["offset"]);echo $temp[0];?>/portrait/myface.jpg"></img>
            <a class="alink" target="_blank" title="<?php echo $ready_list[$i]["title"];?>" href="<?php echo $ready_list[$i]["link"];?>"><?php echo $ready_list[$i]["title"];?></a>
            <a class="alink" target="_blank" href="playPage.php?thiskey=<?php echo $ready_list[$i]["offset"];?>&other_user=<?php echo $user_id;?>">[<?php echo $ready_list[$i]["key"];?>]</a> 
            <a id="like_readylink_<?php echo $user_id?>_<?php echo $i?>" <?php echo $a_add_info;?> <?php echo $a_add_class;?> onclick="like_readylink('<?php echo $user_id;?>','<?php echo $ready_list[$i]["offset"];?>','<?php echo $ready_list[$i]["link"];?>','<?php echo $ifexist;?>','<?php echo $i;?>','update')">
                <span class="arrow"></span>喜欢
            </a> 
            <a class="delete_readylink" onclick="delete_readylink('<?php echo $ready_list[$i]["id"];?>','<?php echo $temp[1];?>','<?php echo $temp[2];?>','update')" href="javascript:void(0);">删除</a>
        </div>
        <?php
    }
}
?>
<script type="text/javascript" src="../scripts/maniLink.js"></script>
