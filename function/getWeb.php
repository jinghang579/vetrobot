<?php
function get_web_bywid($conn,$wid){
    $select=mysqli_query($conn,"SELECT web FROM vt_web WHERE id='$wid'");
    $row=mysqli_fetch_array($select);
    if(mysqli_num_rows($select)==1){
        $result=$row["web"];
        return $result;
    }else{
    	return "";
    }
}
?>