<?php 
function data_web($conn,$uid,$web,$type){
	$result_web=mysqli_query($conn,"SELECT id,sum_like FROM vt_web WHERE web='$web'");
	$row_web=mysqli_fetch_array($result_web);
	if(mysqli_num_rows($result_web)==1){//判断出网站已经存在在用户数据库中
		$wid=$row_web['id'];
		$wlike=$row_web['sum_like'];
		//echo "判断出网站URL已经存在在用户数据库中".$wid."||".$wlike."</br>";
		$update_web=mysqli_query($conn,"UPDATE vt_web SET sum_like='$wlike'+1 WHERE id='$wid'");
		//echo "已经成功将网站LIKE值+1";
		$update_uid_wid=mysqli_query($conn,"SELECT * FROM vt_uid_wid WHERE uid='$uid' && wid='$wid'");
		$row_update_uid_wid=mysqli_fetch_array($update_uid_wid);
		if(mysqli_num_rows($update_uid_wid)==0){
			$insert_uid_wid=mysqli_query($conn,"INSERT INTO vt_uid_wid (uid,wid,ulike) VALUES('$uid','$wid','1')");
		}else{
			$update_uid_wid=mysqli_query($conn,"UPDATE vt_uid_wid SET ulike=ulike+1");
		}
		return $wid;
	}if(mysqli_num_rows($result_web)==0){//判断出网站不存在在用户数据库中
		//echo "判断出网站不存在在用户数据库中"."</br>";
        if($insert_web=mysqli_query($conn,"INSERT INTO vt_web (web,sum_like,type) VALUES ('$web','1','$type')")){
        	//echo "成功将网站添加的用户数据库中，默认LIKE值为1"."</br>";
            $get_web_id=mysqli_query($conn,"SELECT id FROM vt_web WHERE web='$web'");
	        $row_web_id=mysqli_fetch_array($get_web_id);
	        $wid=$row_web_id['id'];
	        $insert_uid_wid=mysqli_query($conn,"INSERT INTO vt_uid_wid (uid,wid,ulike) VALUES('$uid','$wid','1')");
	        //echo "已成功添加新的网站进入用户数据库".",ID:".$wid."</br>";
	        return $wid;
        }else{
        	return "";
        }
	}
}

function data_link($conn,$uid,$wid,$link,$type,$link_des,$title,$content_link){
	//echo $title;
	$select=mysqli_query($conn,"SELECT id FROM vt_link WHERE link='$link' && uid='$uid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)!=0){
        return $row["id"];
	}
	$insert_link=mysqli_query($conn,"INSERT INTO vt_link (uid,wid,link,link_des,type,l_title,content) VALUES ('$uid','$wid','$link','$link_des','$type','$title','$content_link')");
	//echo "已经成功添加新链接到用户数据库，默认LIKE值为1"."</br>";
	$get_link_id=mysqli_query($conn,"SELECT id FROM vt_link WHERE uid='$uid' && link='$link'");
	$row_link_id=mysqli_fetch_array($get_link_id);
	if(mysqli_num_rows($get_link_id)==1){
		$lid=$row_link_id['id'];
	}	
	if($lid!=""){
		//echo "成功获取LID".$lid."</br>";
	    return $lid;
	}else{
		return "";
	}
}
function like_link($conn,$uid,$wid,$link,$type,$other_uid,$kid){
	$result_link = mysqli_query($conn,"SELECT id,sumLikes FROM vt_link where uid='$other_uid' && link='$link'",$bd) or die(mysql_error());	
	$row=mysqli_fetch_array($result_link);
	if(mysqli_num_rows($result_link)==1){
		$lid=$row["id"];
		$sum_likes=$row["sumLikes"];
	}
	$update_sumlikes=mysqli_query($conn,"UPDATE vt_link SET sumLikes='$sum_likes'+1 WHERE id='$lid'");
	$select_lid_kid=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE uid='$uid' && lid='$lid' && kid='$kid'");
	$row_select=mysqli_fetch_array($select_lid_kid);
	if(mysqli_num_rows($select_lid_kid)==0){
		$insert_lid_kid=mysqli_query($conn,"INSERT INTO vt_lid_kid (uid,lid,kid) values ('$uid','$lid','$kid')");
	}    
}
function data_video_key($conn,$uid,$video_key,$folder){
	$result_video_key=mysqli_query($conn,"SELECT id FROM vt_video_key WHERE uid='$uid' && video_key='$video_key'");
	$row_video_key=mysqli_fetch_array($result_video_key);
	if(mysqli_num_rows($result_video_key)==1){//判断出关键词已经存在在用户数据库中
		$kid=$row_video_key['id'];
		//echo "判断出关键词已经存在在用户数据库中".$kid."</br>";
		return $kid;
	}else if(mysqli_num_rows($result_video_key)==0){//判断出关键词不存在在用户数据库中
		//echo "判断出关键词不存在在用户数据库中";
        $insert_video_key=mysqli_query($conn,"INSERT INTO vt_video_key (uid,video_key,belong) VALUES ('$uid','$video_key','$folder')");
        //echo "成功将关键词添加的用户数据库中，默认LIKE值为1"."</br>";
        $get_video_key_id=mysqli_query($conn,"SELECT id FROM vt_video_key WHERE uid='$uid' && video_key='$video_key'");
	    $row_video_key_id=mysqli_fetch_array($get_video_key_id);
	    $kid=$row_video_key_id['id'];
	    //echo "已成功添加新的关键词进入用户数据库".",ID:".$kid."</br>";
	    return $kid;
	}
}
function lid_kid($conn,$uid,$lid,$kid){
	//echo $lid;
	$result_lid_kid=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE uid='$uid' && lid='$lid' && kid='$kid'");
	$row_lid_kid=mysqli_fetch_array($result_lid_kid);
	if(mysqli_num_rows($result_lid_kid)==1){//判断出关键词与链接的关联已经存在在用户数据库中
		//echo "判断出关键词与链接的关联已经存在在用户数据库中"."</br>";
	}if(mysqli_num_rows($result_lid_kid)==0){//判断出关键词与链接的关联不存在在用户数据库中
		//echo "判断出关键词与链接的关联不存在在用户数据库中".$uid.$lid.$kid;
        $insert_lid_kid=mysqli_query($conn,"INSERT INTO vt_lid_kid (uid,lid,kid) VALUES ('$uid','$lid','$kid')");
	    //echo "已成功添加新的关键词与链接的关联进入用户数据库"."</br>";
	}
}

//like-------------------------------------------------------------------------------------------------------------------//
function like_key($conn,$uid,$video_key,$other_uid){
    $result_video_key=mysqli_query($conn,"SELECT id,sum_like FROM vt_video_key WHERE uid='$other_uid' && video_key='$video_key'");
	$row_video_key=mysqli_fetch_array($result_video_key);
	if(mysqli_num_rows($result_video_key)==1){//判断出关键词已经存在在用户数据库中
		$kid=$row_video_key['id'];
		$klike=$row_video_key['sum_like'];
		//echo "判断出关键词已经存在在用户数据库中".$kid."||".$klike."</br>";
		$update_video_key=mysqli_query($conn,"UPDATE vt_video_key SET sum_like='$klike'+1 WHERE id='$kid'");
		//echo "已经成功将关键词LIKE值+1"."</br>";
		return $kid;
	}
}
function like_web($conn,$uid,$web){
	$result_web=mysqli_query($conn,"SELECT id,sum_like FROM vt_web WHERE web='$web'");
	$row_web=mysqli_fetch_array($result_web);
	if(mysqli_num_rows($result_web)==1){//判断出网站已经存在在用户数据库中
		$wid=$row_web['id'];
		$wlike=$row_web['sum_like'];
		//echo "判断出网站URL已经存在在用户数据库中".$wid."||".$wlike."</br>";
		$update_web=mysqli_query($conn,"UPDATE vt_web SET sum_like='$wlike'+1 WHERE id='$wid'");
		//echo "已经成功将网站LIKE值+1";
		return $wid;
	}
}
function uid_kid($conn,$uid,$kid){
    $select_uid_kid=mysqli_query($conn,"SELECT * FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
    $row=mysqli_fetch_array($select_uid_kid);
    if(mysqli_num_rows($select_uid_kid)==1){
    	$ulike=$row["ulike"];
    	$update=mysqli_query($conn,"UPDATE vt_uid_kid SET ulike='$ulike'+1 WHERE uid='$uid' && kid='$kid'");
    }else{
    	$insert=mysqli_query($conn,"INSERT INTO vt_uid_kid (uid,kid,ulike) VALUES('$uid','$kid',1)");
    }
}
function uid_wid($conn,$uid,$wid){
    $select_uid_wid=mysqli_query($conn,"SELECT * FROM vt_uid_wid WHERE uid='$uid' && wid='$wid'");
    $row=mysqli_fetch_array($select_uid_wid);
    if(mysqli_num_rows($select_uid_wid)==1){
    	$ulike=$row["ulike"];
    	$update=mysqli_query($conn,"UPDATE vt_uid_wid SET ulike='$ulike'+1 WHERE uid='$uid' && wid='$wid'");
    }else{
    	$insert=mysqli_query($conn,"INSERT INTO vt_uid_wid (uid,wid,ulike) VALUES('$uid','$wid',1)");
    }
}
function wid_kid($conn,$uid,$wid,$kid){
	$result_wid_kid=mysqli_query($conn,"SELECT * FROM vt_wid_kid WHERE uid='$uid' && wid='$wid' && kid='$kid'");
	$row_wid_kid=mysqli_fetch_array($result_wid_kid);
	if(mysqli_num_rows($result_wid_kid)==1){//判断出关键词与网站的关联已经存在在用户数据库中
		//echo "判断出关键词与网站的关联已经存在在用户数据库中"."</br>";
	}if(mysqli_num_rows($result_wid_kid)==0){//判断出关键词与网站的关联不存在在用户数据库中
		//echo "判断出关键词与网站的关联不存在在用户数据库中".$uid.$wid.$kid;
        $insert_wid_kid=mysqli_query($conn,"INSERT INTO vt_wid_kid (uid,wid,kid) VALUES ('$uid','$wid','$kid')");
	    //echo "已成功添加新的关键词与网站的关联进入用户数据库"."</br>";
	}
}
function like_update_readylink($conn,$uid,$kid,$lid,$other_user){
    $select_link=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row_link=mysqli_fetch_array($select_link);
    if(mysqli_num_rows($select_link)==1){
    	$wid=$row_link["wid"];
    }
    if($wid==""){
    	return 0;
    }
    $update_websumlike=mysqli_query($conn,"UPDATE vt_web SET sum_like=sum_like+1 WHERE id='$wid'");
    uid_wid($conn,$uid,$wid);
    $update_link_sumlike=mysqli_query($conn,"UPDATE vt_link SET sumLikes=sumLikes+1 WHERE id='$lid'");
    wid_kid($conn,$uid,$wid,$kid);
    $update_key_sumlike=mysqli_query($conn,"UPDATE vt_video_key SET sum_like=sum_like+1 WHERE id='$kid'");
    uid_kid($conn,$uid,$kid);
    lid_kid($conn,$uid,$lid,$kid);
    return 1;
}
/**Dislike Link -----------------------------------------------------------------------------Start**/
function dislike_readylink($conn,$uid,$kid,$lid){
    $update_key_sumlike=mysqli_query($conn,"UPDATE vt_video_key SET sum_like=sum_like-1 WHERE id='$kid'");
    $update_uid_kid=mysqli_query($conn,"UPDATE vt_uid_kid SET ulike=ulike-1 WHERE uid='$uid' && kid='$kid'");
    $update_link=mysqli_query($conn,"UPDATE vt_link SET sumLikes=sumLikes-1 WHERE id='$lid'");
    $select_wid=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row=mysqli_fetch_array($select_wid);
    $wid="";
    if(mysqli_num_rows($select_wid)==1){
    	$wid=$row["wid"];
    }
    $update_lid_kid=mysqli_query($conn,"DELETE FROM vt_lid_kid WHERE uid='$uid' && kid='$kid' && lid='$lid'");
    if($wid!=""){
    	$update_web=mysqli_query($conn,"UPDATE vt_web SET sum_like=sum_like-1 WHERE id='$wid'");
    	$update_uid_wid=mysqli_query($conn,"UPDATE vt_uid_wid SET ulike=ulike-1 WHERE uid='$uid' && wid='$wid'");
    	return 1;
    }
    return 0;
}
?>