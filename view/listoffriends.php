<?php
include("../config/conn.php");
include("../function/getFriends.php");
if($user_id==""){
    ?>
    <div id="friend_info">
        <p>请注册并登陆，即刻与他人分享快乐</p>
    </div>
    <?php

}else{
$same_keys=select_allkid_bylike($conn,$user_id);
//var_dump($same_keys);
$result_users=array();
if(sizeof($same_keys!=0)){
	$i=0;
	while($i<sizeof($same_keys)&&sizeof($result_users)<9){
		$this_user=array();
        $this_user=get_9user_bykey($conn,$user_id,$same_keys[$i]);//$this_user=get_9user_bykey($conn,$user_id,$same_keys[$i]);这里关键词的顺序是一定的，但是当用户量大的时候，最好把关键词的顺序设为随机
        if($this_user[0]!=""){
            for($j=0;$j<sizeof($this_user);$j++){
        	    array_push($result_users,$this_user[$j]);
            }	
        }      
        $i++;
	}
    $result_users=array_unique($result_users);
}else{
    echo "请尝试制作或者喜欢一个夹子，维特罗机器人才能找到与您拥有相同兴趣的朋友";
    exit;
}
if(sizeof($result_users)!=0){
	$friend_info=array();
    for($i=0;$i<sizeof($result_users);$i++){
        $this_info=get_user_info($conn,$result_users[$i]);
        array_push($friend_info, $this_info);
    }
    //var_dump($friend_info);
    //array_unique($friend_info);
    for($i=0;$i<sizeof($friend_info);$i++){
    ?>
        <div id="friend_info">
            <a target="_blank" href="userShow.php?u=<?php echo $friend_info[$i]["id"];?>">
                <img src="<?php echo "../users/".$friend_info[$i]["id"]."/portrait/myface.jpg";?>"/></a>
            <a target="_blank" href="userShow.php?u=<?php echo $friend_info[$i]["id"];?>">
            <h6><?php echo $friend_info[$i]["name"]?></h6>
            </a>
        </div>
    <?php
    }
}else{
    echo "请尝试喜欢一下其他人的夹子吧，暂时没有人跟你有共同的兴趣，没错，是因为现在我们的用户太少了。不过一定会有更多的人加入进来，并且喜欢你的分享的！";
}
}
?>