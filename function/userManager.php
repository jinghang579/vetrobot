<?php
function get_des_byuser($conn,$uid){
	$select=mysqli_query($conn,"SELECT des FROM vt_users WHERE id='$uid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)==1){
		$des=$row["des"];
	}
	return $des;
}
function update_des($conn,$uid,$des){
    $update=mysqli_query($conn,"UPDATE vt_users SET des='$des' WHERE id='$uid'");
    return true;
}
function get_user_info($conn,$uid){//name+des
	$select=mysqli_query($conn,"SELECT user_login,des,sumLikes FROM vt_users WHERE id='$uid'");
	$row=mysqli_fetch_array($select);
	$this_info=array();
	if(mysqli_num_rows($select)==1){
        $this_info=array("id"=>$uid,"name"=>$row["user_login"],"des"=>$row["des"],"sum_like"=>$row["sumLikes"]);
	}
	return $this_info;
}
?>