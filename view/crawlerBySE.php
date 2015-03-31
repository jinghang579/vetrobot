<?php
session_start();

//include("header.php");
include("../config/conn.php");
include("../function/getVideoKey.php");
include("../function/getLinkFromUser.php");
include("../function/crawler.php");
include("../function/insertReadyLink.php");
include("../function/getWeb.php");
include("../function/linkManager.php");
$user_id=$_SESSION['user_id'];
if($user_id==""){
	exit;
}
$key_value=select_keyvalue($conn,$user_id);
//var_dump($key_value);

$result_num=key_perc($key_value);
//echo $result_num."</br>";
$result_key=$key_value[$result_num]["key"];
$result_kid=$key_value[$result_num]["id"];
echo "成功确定本次关键词为".$result_key."</br>";
?>
<div id="loader">
	<?php echo "挖掘中";?>
	<img src="../images/loader/screen_loader.gif" alt="通过搜索引擎挖掘中...">
</div>
<?php
$lid=get_lid($conn,$result_kid,$user_id);
$this_link=get_link($conn,$lid);
//echo $this_link["link"]."</br>";
$this_web=get_web_bywid($conn,$this_link["wid"]);
//echo $this_web."--".$result_key."</br>";
if($this_web!="" && $result_key!=""){
	//$result_link=get_google_sameweb($this_web,$result_key);//GOOGLE 会将IP屏蔽
	$result_filter_link=array();
	$title_filter_link=array();
	$title_other_link="";
	//var_dump($result_link);
	if($result_link==false){
		echo "搜索引擎过于繁忙..."."</br>";
		exit;
	}
	for($i=0;$i<sizeof($result_link);$i++){
		//echo $result_link[$i]."</br>";
		if(stristr($result_link[$i],$this_web)){
			//echo $result_link[$i]."</br>";
			$temp_title=get_title("http://".$result_link[$i]);
		    //echo $temp_title.$result_link[$i]."</br>";
		    if($temp_title!=""){
		    	$ifexist=check_exist($conn,$user_id,"http://".$result_link[$i],$result_kid);
		    	if($ifexist==0){
		    		array_push($result_filter_link, $result_link[$i]);
		    	    array_push($title_filter_link,$temp_title);
		    	}
		    }
		    continue;	
		}else if($title_other_link==""){
			$result_other_link=$result_link[rand(0,sizeof($result_link)-1)];//这里使用随机抓取网站，链接质量无法保证，以后会有更加科学抓取方法
			$ifexist=check_exist($conn,$user_id,$result_link[$i],$result_kid);
			if($ifexist==0){
		    	$title_other_link=get_title("http://".$result_other_link);
		    }
		}
	}
	var_dump($result_filter_link);
	//var_dump($title_filter_link);
	if(sizeof($result_filter_link)!=0){
		$i=rand(0,sizeof($result_filter_link)-1);
		//echo $result_filter_link[$i].$title_filter_link[$i];
		$insert_readylink=insertreadylink_bysearchengine($conn,$user_id,$result_key,"http://".$result_filter_link[$i],$title_filter_link[$i],"NA","se_google",$result_kid);
		if($insert_readylink==1){
            echo "成功挖掘到链接"."</br>";
        }else{
        	echo "未成功挖掘到链接"."</br>";
        }
	}
	//echo $result_other_link.$title_other_link."</br>";
	if($result_other_link!=""){
        $insert_readylink=insertreadylink_bysearchengine($conn,$user_id,$result_key,"http://".$result_other_link,$title_other_link,"NA","se_google",$result_kid);
        if($insert_readylink==1){
        	echo "成功挖掘到链接"."</br>";
        }else{
        	echo "未成功挖掘到链接"."</br>";
        }
	}
}else{
}
?>

			