<?php
session_start();
//header("Location:main.php;");
//include("header.php");
include("../config/conn.php");
include("../function/getVideoKey.php");
include("../function/getLinkFromUser.php");
include("../function/insertReadyLink.php");
include("../function/getReadyLinks.php");
$uid=$_GET['u'];
if($uid==""){
	exit;
}
//echo $uid;
$key_value=select_keyvalue($conn,$uid);
//var_dump($key_value);
$result_num=key_perc($key_value);
//echo $result_num."</br>";
$result_key=$key_value[$result_num]["key"];
$result_kid=$key_value[$result_num]["id"];
if($result_kid==""){
    exit;
}
//echo "成功确定本次关键词为".$result_key."</br>";
?>
<div id="loader">
	<?php echo "挖掘中";?>
	<img src="../images/loader/screen_loader.gif" alt="通过搜索引擎挖掘中...">
</div>
<?php
$m=0;
$j=0;
while($j<5){
	$link=array();
	$link=get_update_link($conn,$uid,$key_value[$m]["id"]);
	$m++;
	$j=$j+sizeof($link);
	if($m==sizeof($key_value)){
		echo "更新内容的挖掘已完成。"."</br>";
		break;
	}
	if($link==0){
		continue;
	}
	if(sizeof($link)!=0){
	    //var_dump($link);
	    for($i=0;$i<sizeof($link);$i++){
            $insert=insertreadylink_byotheruser($conn,$uid,$key_value[$m-1]["key"],$link[$i]["link"],$link[$i]["title"],"unknown","update",$link[$i]["other_uid"].",".$link[$i]["lid"].",".$result_kid);
	        if($insert==1){echo "成功挖掘。"."</br>";}
	    }
    }

}
$num_readylinks=get_numreadylinks($conn,$uid);
if($num_readylinks!=0){
    include("listReadyLinks.php");	
}else{
	echo "没有更新的内容"."</br>";
}

?>
