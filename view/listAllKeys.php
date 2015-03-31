<?php 
include("../function/keyManager.php");
include("../config/conn.php");
if(isset($_GET["p"]) &&isset($_GET["f"])){
    $page=$_GET["p"];
    $folder=$_GET["f"];   
}
if(isset($_POST["q"])){
    $q=$_POST["q"];
}
if(!isset($page)||$page==""){
    $page=0;
}
if(isset($folder)&&$folder!=""){
    $allkeys=select_9keys_byfolder($conn,$page,$folder); 
}else{
    if(isset($q)&&$q!=""){
       //echo $q;
    }else{
       $allkeys=select_9keys($conn,$page);  
    }
}
//echo $page;
//var_dump($allkeys);
for($i=0;$i<9;$i=$i+1){
if(isset($allkeys[$i]["kid"]) && $allkeys[$i]["kid"]!=""){
    $end=false;
?>
<article>
    <a title="<?php echo $allkeys[$i]["key"];?>" target="_blank" href="play.php?thiskey=<?php echo $allkeys[$i]["kid"];?>&other_user=<?php echo $allkeys[$i]["uid"];?>">
        <img alt="<?php echo $allkeys[$i]["key"];?>" src="../images/keyFrontCover/<?php echo $allkeys[$i]["kid"];?>.jpg"></img>
    </a>
    <div class="article_right">
    <text>制作</text></br>
    <img alt="<?php echo $allkeys[$i]["user_name"];?>" class="smallportrait" src="../users/<?php echo $allkeys[$i]["uid"];?>/portrait/myface.jpg"></img>
    <strong><?php echo $allkeys[$i]["user_name"];?></strong>
    <div class="key_info">
    <p>获得的喜欢</p>
    <span class="icon-uniE600"></span><strong style="position:relative;bottom:5px;left:8px;"><?php echo $allkeys[$i]["sumlike"];?></strong>
    </div>
    </div>
    <div class="wrap_main">
        <a target="_blank" href="play.php?thiskey=<?php echo $allkeys[$i]["kid"];?>&other_user=<?php echo $allkeys[$i]["uid"];?>"><?php echo $allkeys[$i]["key"];?></a>
        <a class="tag" onclick="choose_folder('<?php echo $allkeys[$i]["fid"];?>')" href="javascript:void(0);"><?php echo $allkeys[$i]["folder"];?></a></br>
        <text style="margin-left:10px;margin-top:8px;"><?php echo $allkeys[$i]["key_des"];?></text></br>
        <a target="_blank" class="link" href="<?php echo $allkeys[$i]["link"];?>"><?php echo $allkeys[$i]["l_title"];?></a></br>
        <text style="margin-left:20px;"><?php echo $allkeys[$i]["l_des"];?></text>
    </div>
    <div class="wrap_bottom">
        <text style="float:left;">链接个数</text><text style="margin-left:5px;"><?php echo $allkeys[$i]["amount"];?></text>
        <a target="_blank" href="play.php?thiskey=<?php echo $allkeys[$i]["kid"];?>&other_user=<?php echo $allkeys[$i]["uid"];?>">更多</a> 
    </div>
</article>
<?php
}else{
    $end=true;
}
}
if($end==true){
    ?>
    <button style="float:left;"type="button" class="red_btn" >没有了..</button>
    <?php
}else{
    ?>
    <button id="page=<?php echo $page;?>" onclick="load_more_key('<?php echo $page;?>','<?php echo $folder;?>')" style="float:left;" type="button" class="green_btn" >加载更多</button>
    <?php
}
?>
