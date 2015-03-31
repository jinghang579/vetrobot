<?php
include("../config/conn.php");
include("../function/keyManager.php");
if(!isset($_GET["u"])){
	exit;
}
$uid=$_GET["u"];
//echo $uid;
$likekeys=get_alllikekey_byuser($conn,$uid);
?>
<article>
	<div id="after_del"></div>
	<a onclick="del_select_likekey()" href="javascript:void(0)">删除选中夹子</a></br>
<?php
//var_dump($likekeys);
for($i=0;$i<sizeof($likekeys);$i++){
	?>
	<a name="likekey" id="<?php echo $likekeys[$i]["kid"];?>" onclick="choose_likekey(this)" class="a_tag" data-action="choose_likekey" href="javascript:void(0);"><!--playPage.php?thiskey=<?php echo $likekeys[$i]["kid"];?>&other_user=<?php echo $likekeys[$i]["other_uid"];?>-->
		<?php echo $likekeys[$i]["key"];?>
	</a>
	<?php
}
?>
</article>
