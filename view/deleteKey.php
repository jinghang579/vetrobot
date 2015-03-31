<?php 
include("../config/conn.php");
include("../function/keyManager.php");
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
if(isset($_POST['del'])){  
    $delete_id=$_POST['del'];    
}
//echo $delete_id; 
delete_key($conn,$delete_id,$user_id);
?>