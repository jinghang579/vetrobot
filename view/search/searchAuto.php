<?php
$q=$_GET["q"];
//echo $q;
if($q==""){
	exit;
}
include("../../config/conn.php");
include("../../function/getVideoKey.php");
$key=get_key_bykey_about($conn,$q);
//var_dump($key);
if(sizeof($key)!=0){
	for($i=0;$i<sizeof($key);$i++){
		?>
		<li>
			<a target="_blank"href="play.php?thiskey=<?php echo $key[$i]["kid"];?>&other_user=<?php echo $key[$i]["uid"];?>">
			<?php echo $key[$i]["key"]?>
			</a>
		</li>
		<?php
	}
}
?>
