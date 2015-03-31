<?php
include("../config/conn.php");
function countlikelinks($conn,$uid){
    $result_count=array();
	$select_likelinks=mysqli_query($conn,"SELECT count(uid) as amount FROM vt_lid_kid WHERE uid='$uid'");
	while($row_likelinks=mysqli_fetch_array($select_likelinks)){
	    $result_count=$row_likelinks['amount'];
    }
    return $result_count;
}
function countinputlinks($conn,$uid){
    $result_count=array();
	$select_inputlinks=mysqli_query($conn,"SELECT count(id) as amount FROM vt_link WHERE uid='$uid'");
	while($row_inputlinks=mysqli_fetch_array($select_inputlinks)){
	    $result_count=$row_inputlinks['amount'];
    }
    return $result_count;
}
function countnumlikesyou($conn,$uid){
    $result_count=0;
	$select_wholikes=mysqli_query($conn,"SELECT sumLikes FROM vt_link WHERE uid='$uid'");
	while($row_wholikes=mysqli_fetch_array($select_wholikes)){
		$temp=$row_wholikes['sumLikes']-1;
	    $result_count=$result_count+$temp;
    }
    return $result_count;
}
function check_exist($conn,$uid,$link,$kid){
    $select_link=mysqli_query($conn,"SELECT id FROM vt_link WHERE link='$link'");
    $lid=array();
    while($row=mysqli_fetch_array($select_link)){
    	array_push($lid, $row["id"]);
    }
    for($i=0;$i<sizeof($lid);$i++){
    	$select_lid=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE lid='$lid[$i]' && uid='$uid'");
    	if(mysqli_num_rows($select_lid)!=0){
    		return 1;
    	}
    }
    return 0;
}
function check_exist_bylid($conn,$uid,$lid,$kid){
    $select=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE lid='$lid' && uid='$uid' && kid='$kid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)!=0){
        return 1;
    }
    return 0;
}
function edit_titledes($conn,$lid,$title,$des){
    $update=mysqli_query($conn,"UPDATE vt_link SET l_title='$title',link_des='$des' WHERE id='$lid'");
}
function delete_link($conn,$lid,$kid){
    $delete=mysqli_query($conn,"DELETE FROM vt_link WHERE id='$lid'");
    $delete_lid_kid=mysqli_query($conn,"DELETE FROM vt_lid_kid WHERE lid='$lid' && kid='$kid'");
}
function get_all_link($conn){
    $result=array();
    $select=mysqli_query($conn,"SELECT * FROM vt_link");
    while($row=mysqli_fetch_array($select)){
        $temp=array();
        $temp["lid"]=$row["id"];
        $temp["l_name"]=$row["l_title"];
        array_push($result,$temp);
    }
    return $result;
}
?>