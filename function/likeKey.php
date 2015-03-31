<?php
function add_sumlike_bykid($conn,$kid){
    $update=mysqli_query($conn,"UPDATE vt_video_key SET sum_like=sum_like+1 WHERE id='$kid'");
    return true;
}
function min_sumlike_bykid($conn,$kid){
    $update=mysqli_query($conn,"UPDATE vt_video_key SET sum_like=sum_like-1 WHERE id='$kid'");
    return true;
}
function add_sumlike_byuid($conn,$uid){
    $update=mysqli_query($conn,"UPDATE vt_users SET sumLikes=sumLikes+1 WHERE id='$uid'");
    return true;
}
function min_sumlike_byuid($conn,$uid){
    $update=mysqli_query($conn,"UPDATE vt_users SET sumLikes=sumLikes-1 WHERE id='$uid'");
    return true;
}
function add_sumlike_bywid($conn,$lid){
    $select_wid=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row_wid=mysqli_fetch_array($select_wid);
    if(mysqli_num_rows($select_wid)==1){
        $wid=$row_wid["wid"];
        $update=mysqli_query($conn,"UPDATE vt_web SET sum_like=sum_like+1 WHERE id='$wid'");
    }
}
function min_sumlike_bywid($conn,$lid){
    $select_wid=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row_wid=mysqli_fetch_array($select_wid);
    if(mysqli_num_rows($select_wid)==1){
        $wid=$row_wid["wid"];
        $update=mysqli_query($conn,"UPDATE vt_web SET sum_like=sum_like-1 WHERE id='$wid'");
    }
}
function like_thiskey($conn,$uid,$kid){
    $select=mysqli_query($conn,"SELECT * FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==0){
    	$insert=mysqli_query($conn, "INSERT INTO vt_uid_kid (uid,kid,ulike) VALUES ('$uid','$kid',1)");
    	return true;
    }else{
        $update=mysqli_query($conn,"UPDATE vt_uid_kid SET ulike=ulike+1 WHERE uid='$uid' && kid='$kid'");
    	return false;
    }
}
function dislike_key($conn,$uid,$kid){
    $select=mysqli_query($conn,"SELECT * FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==1){
        $delete=mysqli_query($conn,"DELETE FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
        return true;
    }
    return false;
}
function like_thislink($conn,$uid,$lid,$kid){
    $select=mysqli_query($conn,"SELECT ulike FROM vt_lid_kid WHERE uid='$uid' && lid='$lid' && kid='$kid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==0){
        $insert=mysqli_query($conn,"INSERT INTO vt_lid_kid (uid,lid,kid,ulike) VALUES ('$uid','$lid','$kid',1)");
        $update=mysqli_query($conn,"UPDATE vt_link SET sumLikes=sumLikes+1 WHERE id='$lid'");
        $select_like=mysqli_query($conn,"SELECT sumLikes FROM vt_link WHERE id='$lid'");
        $row_link=mysqli_fetch_array($select_like);
        if(mysqli_num_rows($select_like)==1){
            return $row_link["sumLikes"];
        }
    }
    return null;
}
function dislike_thislink($conn,$uid,$lid,$kid){
    $select=mysqli_query($conn,"SELECT ulike FROM vt_lid_kid WHERE uid='$uid' && lid='$lid' && kid='$kid'");
    if(mysqli_num_rows($select)==1){
        $delete=mysqli_query($conn,"DELETE FROM vt_lid_kid WHERE uid='$uid' && lid='$lid' && kid='$kid'");
        $update=mysqli_query($conn,"UPDATE vt_link SET sumLikes=sumLikes-1 WHERE id='$lid'");
        $select_like=mysqli_query($conn,"SELECT sumLikes FROM vt_link WHERE id='$lid'");
        $row_link=mysqli_fetch_array($select_like);
        if(mysqli_num_rows($select_like)==1){
            return $row_link["sumLikes"];
        }
    }
    return null;
}
function dislike_thiskey($conn,$uid,$kid){
    $select=mysqli_query($conn,"SELECT ulike FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==1){
        $ulike=$row["ulike"];
        if($ulike<=1){
            $delete=mysqli_query($conn,"DELETE FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
            return true;
        }else{
            $update=mysqli_query($conn,"UPDATE vt_uid_kid SET ulike=ulike-1 WHERE uid='$uid' && kid='$kid'");
            return false;
        }
    }
    return;
}
function check_like($conn,$uid,$kid){
    $select=mysqli_query($conn,"SELECT * FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
    if(mysqli_num_rows($select)==1){
        return true;
    }
    return false;
}
function check_like_link($conn,$uid,$lid){
    $select=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE uid='$uid' && lid='$lid'");
    if(mysqli_num_rows($select)==1){
        return 1;
    }
    return 0;
}
function like_web_bylid($conn,$lid,$uid){
    $select_wid=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row_wid=mysqli_fetch_array($select_wid);
    if(mysqli_num_rows($select_wid)==1){
        $wid=$row_wid["wid"];
        $select=mysqli_query($conn,"SELECT ulike FROM vt_uid_wid WHERE uid='$uid' && wid='$wid'");
        $row=mysqli_fetch_array($select);
        if(mysqli_num_rows($select)==1){
            $update=mysqli_query($conn,"UPDATE vt_uid_wid SET ulike=ulike+1 WHERE uid='$uid' && wid='$wid'");
            return false;
        }else if(mysqli_num_rows($select)==0){
            $insert=mysqli_query($conn,"INSERT INTO vt_uid_wid (uid,wid,ulike) VALUES ('$uid','$wid',1)");
            return true;
        }
    }
    return;
}
function dislike_web_bylid($conn,$lid,$uid){
    $select_wid=mysqli_query($conn,"SELECT wid FROM vt_link WHERE id='$lid'");
    $row_wid=mysqli_fetch_array($select_wid);
    if(mysqli_num_rows($select_wid)==1){
        $wid=$row_wid["wid"];
        $select=mysqli_query($conn,"SELECT ulike FROM vt_uid_wid WHERE uid='$uid' && wid='$wid'");
        $row=mysqli_fetch_array($select);
        if(mysqli_num_rows($select)==1){
            $ulike=$row["ulike"];
            if($ulike<=1){
                $delete=mysqli_query($conn,"DELETE FROM vt_uid_wid WHERE uid='$uid' && wid='$wid'");
                return true;
            }else{
                $update=mysqli_query($conn,"UPDATE vt_uid_wid SET ulike=ulike-1 WHERE uid='$uid' && wid='$wid'");
                return false;
            } 
        }
    }
    return;
}
function delete_likekey_bykid($conn,$uid,$kid){
   $delete_uid_kid=mysqli_query($conn,"DELETE FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
   $select=mysqli_query($conn,"SELECT uid FROM vt_video_key WHERE id='$kid'");
   $row=mysqli_fetch_array($select);
   if(mysqli_num_rows($row)==1){
       if($row["uid"]!=$uid){
           $delete_lid_kid=mysqli_query($conn,"DELETE FROM vt_lid_kid WHERE uid='$uid' && kid='$kid'");
       }
   }
   $update_sumlike=mysqli_query($conn,"UPDATE vt_video_key SET sum_like=sum_like-1 WHERE id='$kid'");
}
?>