<?php
function get_link_by_p($conn,$p){
	if($p==0){
		$select_=mysqli_query($conn,"SELECT MAX(id) as lid FROM vt_link");
		$row_=mysqli_fetch_array($select_);
		$lid=$row_["lid"];
		$select=mysqli_query($conn,"SELECT * FROM vt_link WHERE id='$lid'");
		$row=mysqli_fetch_array($select);
		if(mysqli_num_rows($select)==1){
			$result=array("lid"=>$row["id"],"up_uid"=>$row["uid"],"wid"=>$row["wid"],"link_url"=>$row["link"],
				"link_title"=>$row["l_title"],"link_content"=>$row["content"],"link_des"=>$row["link_des"],
				"sum_like"=>$row["sumLikes"],"link_type"=>$row["type"]);
			return $result;
		}else{
			return null;
		}
	}else{
		$select_=mysqli_query($conn,"SELECT MAX(id) as lid FROM vt_link WHERE id<'$p'");
		$row_=mysqli_fetch_array($select_);
		$lid=$row_["lid"];
		$select=mysqli_query($conn,"SELECT * FROM vt_link WHERE id='$lid'");
		$row=mysqli_fetch_array($select);
		if(mysqli_num_rows($select)==1){
			$result=array("lid"=>$row["id"],"up_uid"=>$row["uid"],"wid"=>$row["wid"],"link_url"=>$row["link"],
				"link_title"=>$row["l_title"],"link_content"=>$row["content"],"link_des"=>$row["link_des"],
				"sum_like"=>$row["sumLikes"],"link_type"=>$row["type"]);
			return $result;
		}else{
			return null;
		}
	}
}

function get_link_key($conn,$lid){
	$select=mysqli_query($conn,"SELECT kid FROM vt_lid_kid WHERE lid='$lid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)==1){
		$kid=$row["kid"];
		$select1=mysqli_query($conn,"SELECT video_key FROM vt_video_key WHERE id = '$kid'");
		$row1=mysqli_fetch_array($select1);
		if(mysqli_num_rows($select1)==1){
			$result=array("kid"=>$kid,"key"=>$row1["video_key"]);
			return $result;
		}else{
			return null;
		}
	}else{
		return null;
	}
}
function get_link_by_lid($conn,$lid){
	$select=mysqli_query($conn,"SELECT * FROM vt_link WHERE id='$lid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)==1){
		$result=array("lid"=>$row["id"],"up_uid"=>$row["uid"],"wid"=>$row["wid"],"link_url"=>$row["link"],
			"link_title"=>$row["l_title"],"link_content"=>$row["content"],"link_des"=>$row["link_des"],
			"sum_like"=>$row["sumLikes"],"link_type"=>$row["type"]);
		return $result;
	}else{
		return null;
	}
}

function get_link_by_kid($conn,$kid,$uid,$watched_list){
	$select_exist=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE uid='$uid'");
	$exist=array();
	while($row_exist=mysqli_fetch_array($select_exist)){
		array_push($exist, $row_exist["lid"]);
	}
    foreach($watched_list as $key=>$value){
    	array_push($exist, $key);
    }
	if(sizeof($exist)!=0){
		$select_lid=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE lid not in (".implode(',',$exist).") and kid='$kid' and uid!='$uid'");
	}else{
		$select_lid=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE kid='$kid' and uid!='$uid'");
	}
	$result=array();
	while($row_lid=mysqli_fetch_array($select_lid)){
		$lid=$row_lid["lid"];
		$select=mysqli_query($conn,"SELECT * FROM vt_link WHERE id='$lid'");
		$row=mysqli_fetch_array($select);
		if(mysqli_num_rows($select)==1){
			$temp=array("lid"=>$row["id"],"up_uid"=>$row["uid"],"wid"=>$row["wid"],"link_url"=>$row["link"],
				"link_title"=>$row["l_title"],"link_content"=>$row["content"],"link_des"=>$row["link_des"],
				"sum_like"=>$row["sumLikes"],"link_type"=>$row["type"]);
			array_push($result, $temp);
		}
	}
	return $result;
}

function get_lid_by_same($conn,$p,$user_id,$watched_list){
	$select_uid=mysqli_query($conn,"SELECT uid FROM vt_link WHERE id='$p'");
	$row_uid=mysqli_fetch_array($select_uid);
	if(mysqli_num_rows($select_uid)==1){
		$uid=$row_uid["uid"];
		$select=mysqli_query($conn,"SELECT lid FROM vt_lid_kid WHERE kid=(SELECT kid FROM vt_lid_kid WHERE uid='$uid' and lid='$p') AND uid!='$user_id'");
		while($row=mysqli_fetch_array($select)){
			if(!array_key_exists($row["lid"],$watched_list)){
				return $row["lid"];
			}
		}
		return null;
	}else{
		return null;
	}
}
?>