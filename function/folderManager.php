<?php
function get_all_folders($conn){
	$result=array();
    $select=mysqli_query($conn,"SELECT * FROM vt_folder");
    while($row=mysqli_fetch_array($select)){
        $result[]=array("fid"=>$row["fid"],"f_name"=>$row["folder"]);
    }
    return $result;
}
?>