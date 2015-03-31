<?php

function remove_readylink($conn,$readylink,$uid){
	$delete_readylink=mysqli_query($conn,"DELETE FROM vt_readylinks WHERE uid='$uid'&& pageLink='$readylink'");
	$select_counter=mysqli_query($conn,"SELECT id FROM vt_readylinks WHERE uid='$uid'");
    $row_counter=mysqli_fetch_array($select_counter);
    $counter=mysqli_num_rows($select_counter);
    $update_counter=mysqli_query($conn,"UPDATE vt_counter SET readylinks='$counter' WHERE uid='$uid'");
}
?>