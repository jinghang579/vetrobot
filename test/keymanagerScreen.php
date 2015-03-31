<?php 
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
if($user_id!=""){
?>
<iframe src="keyManager.php">
</iframe>
<?php
}else{
	exit;
}
?>
