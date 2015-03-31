<?php
include("../config/conn.php");
include("../function/getVideoKey.php");
if(!isset($_GET["uid"])){
	return;
}
$user_id=$_GET["uid"];
$allkeys=select_allkeys_byuser($conn,$user_id);
for($i=0;$i<sizeof($allkeys);$i++){
	if(isset($allkeys["id"][$i]) && isset($allkeys["value"][$i])){
	?>
	<li onclick="pass_col('<?php echo $allkeys["id"][$i]?>','<?php echo $allkeys["value"][$i]?>')"><?php echo $allkeys["value"][$i]?></li>
	<?php
    }
}