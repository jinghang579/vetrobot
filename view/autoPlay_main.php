<?php
include("../config/conn.php");
include("../function/getLink.php");
include("../function/userManager.php");
include("../function/linkManager.php");
include("../function/adManager.php");
include("../function/getVideoKey.php");
if(isset($_SESSION['user_id'])){
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['user_id'];    
}else{
    $user_id="";
    $_SESSION['login_page']="autoPlay.php?p=0";
}
?>

<article>
<?php
$this_key=array();
if($user_id==""){  //用户未登录
    if(isset($_GET["p"])){
        $_SESSION['p']=$_GET["p"];
        $p=$_SESSION['p'];
    }else{
        $p=$_SESSION['p'];
    }
    $this_link=get_link_by_p($conn,$p);
    $this_key=get_link_key($conn,$this_link["lid"]);
    //var_dump($this_link);
    $up_user=get_user_info($conn,$this_link["up_uid"]);
    $this_ad_id=get_ad_by_lid($conn,$this_link["lid"]);
    $this_ad=get_ad_by_aid($conn,$this_ad_id);
    $like_link_class="href=\"#login_box\" onclick=\"prompt_login()\" class=\"like_link\"";
}else{  
    if(!isset($_GET["p"])){
        echo "Error!";
    }else{
        $p=$_GET["p"];
        if($p=="0"){//第一个视频，初始化！
            $watched_list=array();
            $will_watch=array();
            $dislike_count=0;
            $key_value=select_keyvalue($conn,$user_id);
            if(sizeof($key_value)>1){
                $result_num=key_perc($key_value);
                $this_key=array("kid"=>$key_value[$result_num]["id"],"key"=>$key_value[$result_num]["key"]);
                $will_watch=get_link_by_kid($conn,$this_key["kid"],$user_id,$watched_list);
            }
            if(sizeof($key_value)<=1 or sizeof($will_watch)==0){//没有更多喜欢的KEY
                $this_kids=get_diff_kid_by_other_beta($conn,$user_id);//寻找similar user的keys
                if(sizeof($this_kids)!=0){
                    foreach($this_kids as $this_kid){
                        $will_watch=get_link_by_kid($conn,$this_kid,$user_id,$watched_list);
                        if(sizeof($will_watch)!=0){
                            break;
                        }
                    }
                }
                if(sizeof($this_kids)==0 or sizeof($will_watch)==0){//没有similar user，找most popular user
                    $this_kids=get_diff_kid_by_popular($conn,$user_id);
                    //var_dump($this_kids);
                    foreach($this_kids as $this_kid){//选择三个popular user，这里有个BUG，仍有可能没有找到LINKS。
                        $will_watch=get_link_by_kid($conn,$this_kid,$user_id,$watched_list);
                        if(sizeof($will_watch)!=0){
                            break;
                        }
                    }
                }
            }
        }else{//连续观看
            $watched_list=$_SESSION["watched_list"];//获取watched_list
            $will_watch=$_SESSION["will_watch"];
            $dislike_count=$_SESSION["dislike_count"];
            if(array_key_exists($p,$watched_list)){//先判断是不是刷新
                $dislike_count=$dislike_count-1;
                $t=$_SESSION["this_lid"];
                array_push($will_watch,get_link_by_lid($conn,$t));
            }else{//不是刷新
                $watched_list[$p]=1;//将之前观看的link加入watched_list中
                $pre_kid=$_SESSION["current_kid"];//获得当前KEY
                if($dislike_count>3){//需要更换current_key
                    $dislike_count=0;
                    $key_value=select_keyvalue($conn,$user_id);//1.选择用户喜欢的其他KEY
                    if(sizeof($key_value)>1){
                        $result_num=key_perc($key_value);
                        $this_key=array("kid"=>$key_value[$result_num]["id"],"key"=>$key_value[$result_num]["key"]);                       
                    }
                    if($this_key["kid"]!=$pre_kid){
                        $will_watch=get_link_by_kid($conn,$this_key["kid"],$user_id,$watched_list);    
                    }
                    if(sizeof($will_watch)==0){
                        $this_kids=get_diff_kid_by_other_beta($conn,$user_id);//2.寻找similar user的keys
                            if(sizeof($this_kids)!=0){
                            foreach($this_kids as $this_kid){
                                if($this_kid==$pre_kid){
                                    continue;
                                }
                                $will_watch=get_link_by_kid($conn,$this_kid,$user_id,$watched_list);
                                if(sizeof($will_watch)!=0){
                                    break;
                                }
                            }
                        }
                    }
                }else{
                    if(sizeof($will_watch)<=0){//链接数量不够，需要挖掘,SAME KEY
                        $will_watch=get_link_by_kid($conn,$pre_kid,$user_id,$watched_list);
                    }
                }
            }
        }
        $dislike_count=$dislike_count+1;
        $this_link=array_pop($will_watch);
        $up_user=get_user_info($conn,$this_link["up_uid"]);
        $this_ad_id=get_ad_by_lid($conn,$this_link["lid"]);
        $this_ad=get_ad_by_aid($conn,$this_ad_id); 
        if(sizeof($this_key)==0){

            $this_key["kid"]=get_kid_by_lid($conn,$this_link["lid"],$this_link["up_uid"]);
            //var_dump($this_link);
            //var_dump($this_key);
            $temp_key=get_key_byid($conn,$this_key["kid"]);
            //var_dump($temp_key);
            $this_key["key"]=$temp_key["key"];
        }
        $_SESSION["this_lid"]=$this_link["lid"];
        $_SESSION["dislike_count"]=$dislike_count;
        $_SESSION["current_kid"]=$this_key["kid"];
        $_SESSION["will_watch"]=$will_watch;
        $_SESSION["watched_list"]=$watched_list;
        //var_dump($will_watch);
        //echo $_SESSION["dislike_count"];
    }
    //var_dump($watched_list);
    //var_dump($this_link);
    $check_liked=check_exist_bylid($conn,$user_id,$this_link["lid"],$this_key["kid"]);
    if($check_liked==1){
        $like_link_class="href=\"javascript:void(0);\" 
                      id=\"like_link_".$user_id."_".$this_link["lid"]."\" 
                      onclick=\"like_link(".$user_id.",".$this_key["kid"].",".$this_link["lid"].",".$this_link["up_uid"].")\"
                      class=\"remove_like_link\"";
    }else{
        $like_link_class="href=\"javascript:void(0);\" 
                      id=\"like_link_".$user_id."_".$this_link["lid"]."\" 
                      onclick=\"like_link(".$user_id.",".$this_key["kid"].",".$this_link["lid"].",".$this_link["up_uid"].")\"
                      class=\"like_link\"";
    }
}
?>
<div class="c1">
        <div class="link_ page">
        <div class="link_title">
            <a target="_blank" href="<?php echo $this_link["link_url"];?>">
                <h4><?php echo $this_link["link_title"];?></h4>
            </a>
        </div>
        <div class="up_user">
            <img src="../users/<?php echo $up_user["id"];?>/portrait/myface.jpg" alt="<?php echo $up_user["name"];?>"/>
            <h5><?php echo $up_user["name"];?></h5>
            <text><?php echo $up_user["des"];?></text>
        </div>
        <div style="width:100%;height:30px;">
        <div class="link_like">
            <a title="点击-》喜欢这个链接" <?php echo $like_link_class;?>>
                <text>喜欢</text>
            </a>
            <text id="link_sumlikes"><?php echo $this_link["sum_like"];?></text>
            <text style="color:#985d3e;">如果喜欢这个内容请点击，网站会以此为你推荐更多你喜欢的内容！</text>
        </div>
        <div class="link_key">
            <a target="_blank" href="play.php?thiskey=<?php echo $this_key["kid"];?>&other_user=<?php echo $this_link["up_uid"];?>">
                <text>
                    <?php echo $this_key["key"];?>
                </text>
            </a>
        </div>
        </div>
        </div>
        <div class="ad page">
            <div class="ad_title">
                <a target="_blank" href="<?php echo $this_ad["ad_url"];?>">
                    <h5>支持内容提供者<h5>
                </a>
            </div>
            <div class="ad_des">
                <text><?php echo $this_ad["ad_name"];?></text>
                <price><?php echo $this_ad["ad_price"];?></price>
            </div>
            <div class="ad_content">
                <a target="_blank"href="<?php echo $this_ad["ad_url"];?>">
                    <img alt="<?php echo $this_ad["ad_name"];?>" src="<?php echo $this_ad["ad_pic"];?>"/>
                </a>
            </div>
        </div>
    </div>
    <div class="c2">
        <?php 
        if($this_link["link_type"]=="video"){
        ?>
        <object  style="position:relative;visibility: visible;" allowFullScreen="true" quality="high" allowScriptAccess="always" type="application/x-shockwave-flash" width="950px" height="550px" data="<?php echo $this_link["link_content"];?>">
            <param name="wmode" value="transparent"/>
        </object>
        <?php
        }
        ?>
    </div>
    <div class="c3">
        <div class="link_des page">
            <des><?php echo $this_link["link_des"];?> </des>
        </div>
        <div class="next_ page">
            <div style="height: 75; visibility:hidden;">
                <text ></text>
            </div>
            <a class="red_btn" href="autoPlay.php?p=<?php echo $this_link["lid"];?>">下一个</a>
        </div>
    </div>
</article>