<?php
function insertreadylink_byotheruser($conn,$uid,$key,$link,$title,$type,$searchType,$offset){
	$select_readylink=mysqli_query($conn,"SELECT link FROM vt_readylinks WHERE uid='$uid'");
	$exist=false;
	while($row_readylink=mysqli_fetch_array($select_readylink)){
		if($row_readylink['link']==$link){
			$exist=true;
		}
	}
	if(mysqli_num_rows($select_readylink)>5||mysqli_num_rows($select_readylink)==5){
		echo "已经有5个了，够你看的了！";
		return 0;
	}else if($exist==true){
        //echo "链接已经在READYLINK中存在啦！";
        return 0;
	}else{
		$ins_readylink=mysqli_query($conn,"INSERT INTO vt_readylinks (uid,link,thisTitle,type,thisKey,searchType,offset) VALUES ('$uid','$link','$title','$type','$key','$searchType','$offset')");
	    //echo "已经添加READYLINK"."</br>";
	    $select_counter=mysqli_query($conn,"SELECT readylinks FROM vt_counter WHERE uid='$uid'");
	    $row_counter=mysqli_fetch_array($select_counter);
	    if($row_counter!=null){
	    	$counter=$row_counter['readylinks'];
		    if($counter<0||$counter==0){
			    //echo "counter为0"."</br>";
                $update_sql="UPDATE vt_counter SET readylinks='1' WHERE uid='$uid'";
                //echo "更新counter为1"."</br>";
		    }else{
			    //echo "counter不为0"."</br>";
			    $counter=$counter+1;
			    $update_sql="UPDATE vt_counter SET readylinks='$counter' WHERE uid='$uid'";
			    //echo "更新counter为+1"."</br>";
			}
		}
		$update_counter=mysqli_query($conn,$update_sql);
		//echo "已经更新COUNTER"."</br>";
		return 1;
	}
	
}
function insertreadylink_bysearchengine($conn,$uid,$key,$link,$title,$type,$searchType,$offset){
    $select_readylink=mysqli_query($conn,"SELECT link FROM vt_readylinks WHERE uid='$uid'");
	$exist=false;
	while($row_readylink=mysqli_fetch_array($select_readylink)){
		if($row_readylink['pagelink']==$link){
			$exist=true;
		}
	}
	if(mysqli_num_rows($select_readylink)>5||mysqli_num_rows($select_readylink)==5){
		echo "您已经有5个准备就绪的链接，请先观看或者删除它们。";
		return 0;
	}else if($exist==true){
        echo "链接已经在准备链接中存在啦！";
        return 0;
	}else{
		$insert=mysqli_query($conn,"INSERT INTO vt_readylinks (uid,link,thisTitle,type,thisKey,searchType,offset) VALUES ('$uid','$link','$title','$type','$key','$searchType','$offset') ");
		$select_counter=mysqli_query($conn,"SELECT readylinks FROM vt_counter WHERE uid='$uid'");
	    if(mysqli_num_rows($select_counter)==0){
	    	$insert_counter=mysqli_query($conn,"INSERT INTO vt_counter (uid,readylinks) VALUES ('$uid','1')");
	    	return 1;
	    }else if(mysqli_num_rows($select_counter)==1){
	    	//$new_num=$row_counter["readylinks"];
	    	$update_counter=mysqli_query($conn,"UPDATE vt_counter SET readylinks=readylinks+1 WHERE uid='$uid'");
	    	return 1;
	    }
	    return 0;
	}
	return 0;
}
?>