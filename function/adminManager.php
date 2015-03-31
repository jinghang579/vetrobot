<?php
function show_users($conn){
	$result=array();
    $select=mysqli_query($conn,"SELECT user_login FROM vt_users");
    while($row=mysqli_fetch_array($select)){
        array_push($result, $row["user_login"]);   
    }
    $num=mysqli_query($conn,"SELECT count(id) as amount FROM vt_users");
    $row_=mysqli_fetch_array($num);
    $result["amount"]=$row_["amount"];
    return $result;
}
?>
