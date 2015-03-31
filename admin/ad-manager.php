<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../config/conn.php");
include("../function/linkManager.php");
include("../function/adManager.php");
if(!isset($_SESSION["admin"])){
	exit;
}
if(isset($_POST["ad_name"])){
	$ad_name=$_POST["ad_name"];
	$ad_pic=$_POST["ad_pic"];
	$ad_url=$_POST["ad_url"];
	$ad_price=$_POST["ad_price"];
	insert_ad($conn,$ad_name,$ad_pic,$ad_url,$ad_price);
}
?>
<form action="" method="post">
	<input value="" name="ad_name"/>
	<input value="" name="ad_price"/>
	<input value="" name="ad_pic"/>
	<input value="" name="ad_url"/>
	<input type="submit" value="Insert_AD">
</form>
<?php
$links=get_all_link($conn);
#var_dump($links);
$ads=get_all_ad($conn);
if(sizeof($ads)!=0){
	for($i=0;$i<sizeof($ads);$i++){
		echo $ads[$i]["aid"]." Name:".$ads[$i]["ad_name"]." Price:".$ads[$i]["price"]." Pic:".$ads[$i]["pic"]." Url:".$ads[$i]["url"]."</br>";
	}
}
if(sizeof($links)==0){
	exit;
}
for($i=0;$i<sizeof($links);$i++){
	?>
	<li>
		<div>
			<?php echo $links[$i]["l_name"];?>
		</div>
		<div>
			<?php
			$this_ad_id=get_ad_by_lid($conn,$links[$i]["lid"]);
			$this_ad=get_ad_by_aid($conn,$this_ad_id);
			echo "广告：".$this_ad["ad_name"]."</br>";
			?>
		</div>
		<form action="update-link-ad.php" method="post">
			<input style="visibility:hidden;" value="<?php echo $links[$i]["lid"];?>" name="lid">
			<select name="aid">
				<?php
				for($j=0;$j<sizeof($ads);$j++){
					?>
					<option value="<?php echo $ads[$j]["aid"];?>"><?php echo $ads[$j]["ad_name"];?></option>
					<?php
				}
				?>
			</select>
			<input type="submit" value="Submit"/>
		</form>
	</li>
	<?php
}
?>