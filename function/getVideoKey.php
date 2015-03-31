<?php
function select_keyvalue($conn,$uid){
    $result=array();
    $sum=0;
    $select_uid_kid=mysqli_query($conn,"SELECT kid,ulike FROM vt_uid_kid WHERE uid='$uid'");
    while($row=mysqli_fetch_array($select_uid_kid)){
        $kid=$row["kid"];
        $ulike=$row["ulike"];
        $select_key=mysqli_query($conn,"SELECT uid,video_key FROM vt_video_key WHERE id='$kid'");
        $row_key=mysqli_fetch_array($select_key);
        if(mysqli_num_rows($select_key)==1&&$row_key["uid"]!=$uid){
            $key=$row_key["video_key"];
            $temp=array("id"=>$kid,"key"=>$key,"perc"=>$ulike);
            array_push($result, $temp);
            $sum=$sum+$ulike;
        } 
    }
    $result["sum"]=$sum;
    return $result;
}
function key_perc($e){
    //echo var_dump($e)."</br>";
    for($i=0;$i<sizeof($e)-1;$i++){
    	$key_perc[$i]=($e[$i]["perc"]/$e["sum"])*100;
    	//echo $key_perc[$i]."--".$i."</br>";
    }
    $ran=rand(0,100);
    //echo $ran."</br>";
    $x=0;
    for($i=0;$i<sizeof($e)-1;$i++){
    	$x+=($e[$i]["perc"]/$e["sum"])*100;
        //echo $x."</br>";
    	if($x>=$ran){
    		$result_num=$i;
            //echo $result_num."</br>";
    		return $result_num;
    	}
    }
    return null;

}
function select_allkeys_byuser($conn,$uid){
    $result=array();
    $id=array();
    $value=array();
    $select_allkeys = mysqli_query($conn,"SELECT id,video_key FROM vt_video_key where uid='$uid'");
    while($row=mysqli_fetch_array($select_allkeys)){
        array_push($id,$row["id"]);
        array_push($value,$row["video_key"]);
    }
    $result=array("id"=>$id,"value"=>$value);
    return $result;
}
function select_allkeys($conn){
    $result=array();
    $select_allkeys=mysqli_query($conn,"SELECT id,uid,video_key FROM vt_video_key");
    while($row=mysqli_fetch_array($select_allkeys)){
        $uid=$row["uid"];
        $select_username=mysqli_query($conn,"SELECT user_login FROM vt_users WHERE id='$uid'");
        $row_username=mysqli_fetch_array($select_username);
        $temp=array("kid"=>$row["id"],"uid"=>$uid,"user_name"=>$row_username["user_login"],"key"=>$row["video_key"]);
        array_push($result, $temp);
    }
    return $result;
}
function get_key_byid($conn,$kid){
    $select_key=mysqli_query($conn,"SELECT uid,video_key,key_des,sum_like FROM vt_video_key WHERE id='$kid'");
    $result=array();
    if($row=mysqli_fetch_array($select_key)){
        $uid=$row["uid"];
        $select_username=mysqli_query($conn,"SELECT user_login FROM vt_users WHERE id='$uid'");
        $row_username=mysqli_fetch_array($select_username);
        $result=array("uid"=>$row["uid"],"user_name"=>$row_username["user_login"],"key"=>$row["video_key"],"des"=>$row["key_des"],"sumlike"=>$row["sum_like"]);
    }
    return $result;
}
function get_key_bykey_about($conn,$key){
    $select_key=mysqli_query($conn,"SELECT id,uid,video_key,key_des,sum_like FROM vt_video_key WHERE video_key like '%$key%'");
    $result=array();
    while($row=mysqli_fetch_array($select_key)){
        $uid=$row["uid"];
        $select_username=mysqli_query($conn,"SELECT user_login FROM vt_users WHERE id='$uid'");
        $row_username=mysqli_fetch_array($select_username);
        $temp=array("kid"=>$row["id"],"uid"=>$row["uid"],"user_name"=>$row_username["user_login"],"key"=>$row["video_key"],"des"=>$row["key_des"],"sumlike"=>$row["sum_like"]);
        array_push($result,$temp);
    }
    return $result;
}
function get_diff_kid($conn,$list,$uid){
    $newlist=array();
    foreach ($list as $key=>$value){
        $temp=explode("v_", $key);
        if($temp[1]!=""){
            array_push($newlist, $temp[1]);
        } 
    }
    //var_dump($newlist);
    $select_key=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE kid NOT IN (".implode(',', $newlist).") AND uid='$uid'");
    $result=array();
    while($row_key=mysqli_fetch_array($select_key)){
        $kid=$row_key["kid"];
        array_push($result, $kid);
    }
    return $result;
}

function get_diff_kid_by_other_beta($conn,$uid){
    $select_kids=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE uid='$uid'");
    $kids=array();
    while($row_kids=mysqli_fetch_array($select_kids)){
        $kids[$row_kids["kid"]]=1;
    }
    //var_dump($kids);
    $users=array();
    foreach ($kids as $key=>$value){
        $select_user=mysqli_query($conn,"SELECT uid FROM vt_uid_kid WHERE kid='$key' and uid!='$uid'");
        while($row_user=mysqli_fetch_array($select_user)){
            $this_uid=$row_user["uid"];
            if(array_key_exists($this_uid, $users)){
                $users[$this_uid]=$users[$this_uid]+1;
            }else{
                $users[$this_uid]=1;
            }
        }
    }
    arsort($users);
    //var_dump(array_keys($kids));
    //var_dump($users);
    $other_kid=array();
    foreach($users as $other_uid){
        $select_other_kid=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE kid not in (".
            implode(',', array_keys($kids)).
            ") and uid='$other_uid'");
        while($row_other_kid=mysqli_fetch_array($select_other_kid)){
            array_push($other_kid, $row_other_kid["kid"]);
        }
    }
    return $other_kid;
}

function get_diff_kid_by_popular($conn,$uid){
    $select_kids=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE uid='$uid'");
    $kids=array();
    while($row_kids=mysqli_fetch_array($select_kids)){
        $kids[$row_kids["kid"]]=1;
    }
    $select_user=mysqli_query($conn,"SELECT id FROM vt_users WHERE id!='$uid' ORDER BY sumLikes DESC LIMIT 3");
    $users=array();
    while($row_user=mysqli_fetch_array($select_user)){
        array_push($users, $row_user["id"]);
    }
    //var_dump($users);
    $other_kid=array();
    foreach($users as $other_uid){
        if(sizeof($kids)>0){
            $select_other_kid=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE kid not in (".
            implode(',', array_keys($kids)).
            ") and uid='$other_uid'");
        }else{
            $select_other_kid=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE uid='$other_uid'");
        }
        while($row_other_kid=mysqli_fetch_array($select_other_kid)){
            array_push($other_kid, $row_other_kid["kid"]);
        }
    }
    return $other_kid;
}
function get_kid_by_lid($conn,$lid,$up_uid){
    $select=mysqli_query($conn,"SELECT kid FROM vt_lid_kid WHERE uid='$up_uid' && lid='$lid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==1){
        $kid=$row["kid"];
        return $kid;
    }
    return null;
}
?>