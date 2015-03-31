<?php
function get_update_link($conn,$uid,$kid){
	$select_other_uid=mysqli_query($conn,"SELECT uid FROM vt_video_key WHERE id='$kid'");
    $row_other_uid=mysqli_fetch_array($select_other_uid);
    if(mysqli_num_rows($select_other_uid)==1){
        $other_uid=$row_other_uid["uid"];
    }else{
        return 0;
    }
    //echo $other_uid;
    $select_lid=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE uid='$other_uid' && kid='$kid'");
    $lid=array();
    while($row_lid=mysqli_fetch_array($select_lid)){
        array_push($lid, $row_lid["lid"]);
    }
    //var_dump($lid);
    $result=array();
    for($i=0;$i<sizeof($lid);$i++){
        $check=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE lid='$lid[$i]' && uid='$uid'");
        $row_check=mysqli_fetch_array($check);
        if(mysqli_num_rows($check)==0){
            $select_link=mysqli_query($conn,"SELECT id,uid,link,l_title,link_des FROM vt_link WHERE id='$lid[$i]'");
            $row_select_link=mysqli_fetch_array($select_link);
            if(mysqli_num_rows($select_link)==1){
                $temp=array("lid"=>$row_select_link["id"],"other_uid"=>$row_select_link["uid"],"link"=>$row_select_link["link"],"title"=>$row_select_link["l_title"]);
                array_push($result,$temp);
            }
        }
    }
    return $result;
}
function get_key($conn,$kid){
    $key="";
    $select_key=mysqli_query($conn,"SELECT video_key FROM vt_video_key WHERE id='$kid'");
    while($row_key=mysqli_fetch_array($select_key)){
        $key=$row_key['video_key'];
    }
    return $key;
}
function get_lid($conn,$kid,$other_uid){
	$lid=array();
	$select_lid=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE kid='$kid' && uid='$other_uid'");
	while($row_lid=mysqli_fetch_array($select_lid)){
        //echo $row_lid['lid']."</br>";
        $lid[]=$row_lid['lid'];
    }
    $ran_lid=rand(0,count($lid)-1);
	//echo $ran_lid."</br>";
	return $lid[$ran_lid];
}
function get_diff_lid($conn,$kid,$other_uid){
	$lid=array();
	$kid=array();
	$result=array();
	$select_lid=mysqli_query($conn,"SELECT lid,kid FROM vt_lid_kid WHERE kid!='$kid' && uid='$other_uid'");
	while($row_lid=mysqli_fetch_array($select_lid)){
        //echo $row_lid['lid']."</br>";
        $lid[]=$row_lid['lid'];
        $kid[]=$row_lid['kid'];
    }
    $ran_lid=rand(0,count($lid)-1);
	//echo $ran_lid."</br>";
	$result[0]=$lid[$ran_lid];
	$result[1]=$kid[$ran_lid];
	return $result;
}
function get_lid_bykid($conn,$kid,$uid){
	//echo $kid.$uid;
    $lid=array();
    $select_lid=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE kid='$kid'&& uid='$uid'");
    while($row_lid=mysqli_fetch_array($select_lid)){
        //echo $row_lid['lid']."</br>";
        $lid[]=$row_lid['lid'];
    }
    if(sizeof($lid)!=0){
    	return $lid;
    }else{
    	return "";
    }
}
function get_link($conn,$lid){
	//echo $lid."</br>";
	$select_link=mysqli_query($conn,"SELECT wid,link ,link_des,sumLikes,l_title ,content,type FROM vt_link WHERE id='$lid'");
	$row_link=mysqli_fetch_array($select_link);
	$count=mysqli_num_rows($select_link);
	if($count==1){
		$result=array("title"=>$row_link["l_title"],"wid"=>$row_link["wid"],"link"=>$row_link['link'],
            "des"=>$row_link['link_des'],"sumlike"=>$row_link['sumLikes'],"content"=>$row_link["content"],
            "link_type"=>$row_link["type"]);
		//var_dump($result);
	    return $result;
	}
}

?>