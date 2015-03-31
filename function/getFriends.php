<?php
function get_9user_bykey($conn,$uid,$kid){
	$result_users=array();
    $select=mysqli_query($conn,"SELECT uid FROM vt_uid_kid WHERE kid='$kid'&&uid!='$uid'");  
    if(mysqli_num_rows($select)==0){
        return "";    
    }
    while($row=mysqli_fetch_array($select)){
        array_push($result_users,$row["uid"]);
    }
    $result_users=array_unique($result_users);
    return $result_users;
}
function select_allkid_bylike($conn,$uid){
    $result_keys=array();
    $select=mysqli_query($conn,"SELECT kid FROM vt_uid_kid WHERE uid='$uid'");
    while($row=mysqli_fetch_array($select)){
        array_push($result_keys, $row["kid"]);
    }
    return $result_keys;
}
?>