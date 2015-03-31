<?php
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
if($user_id==""){
	$button_add_info="class=\"button_add_info\" href=\"#login_box\" ";
}else{
	$button_add_info="";
}

?>
<div id="mine">
	<div id="mine_border" class="mine_border_1">

	<button <?php echo $button_add_info;?> onmouseout="i_not_pause()" onmouseover="i_pause()" title="开始挖掘！" onclick="getReadybyuser('<?php echo $user_id;?>')" href="javascript:void(0);">
		<p>开始挖掘！出动！</p>
		
	</button>
    </div>
</div>
