<?php
function delete_readylink($conn,$uid,$rid){
	$uid=1;
	//echo $uid."--".$rid."</br>";
	$select=mysqli_query($conn,"SELECT * FROM vt_readylinks WHERE id='$rid'");
	if(mysqli_num_rows($select)==1){
		$update_counter=mysqli_query($conn,"UPDATE vt_counter SET readylinks=readylinks-1 WHERE uid='$uid'");
		$delete=mysqli_query($conn,"DELETE FROM vt_readylinks WHERE id='$rid'");
		return 1;
	}
	$update_counter=mysqli_query($conn,"UPDATE vt_counter SET readylinks=readylinks-1 WHERE uid='$uid'");
    return 0;
}
function dislike_lid_kid($conn,$uid,$kid,$lid){
	$check=mysqli_query($conn,"SELECT * FROM vt_lid_kid WHERE uid='$uid' && kid='$kid' && lid='$lid'");
	$row_check=mysqli_fetch_array($check);
	if(mysqli_num_rows($check)==0){
		$insert=mysqli_query($conn,"INSERT INTO vt_lid_kid (uid,lid,kid,ulike) VALUES ('$uid','$lid','$kid','0')");
	}
	return;
}
?>