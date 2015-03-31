<?php 
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
if($user_id!=""){
?>
<article>  
<strong>个人设置</strong>
<p>点击-关闭控制台-即可退出编辑</p> 
<div id="uploadImgScreen">
</div>
<button type="button" onclick="loadXMLuploadImg()">上传头像</button>
<form id="change_des" name="change_des">
	<text style="float:left;">编辑个人简介：</text>
	<textarea name="edit_des" id="edit_des"></textarea></br>
	<button class="red_btn" onclick="post_des(document.getElementById('edit_des').value)" type="button" value="保存">保存简介</button>
	<span class="des_sucess" style="display:none;">个人签名保存成功</span>
</form>  
</article>        
<?php
}else{
	echo "抱歉，您访问的页面不允许显示,请返回主页面<a href=\"main.php\">返回</a>";
}
?>