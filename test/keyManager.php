<?php 
session_start();
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
include("../function/keyManager.php");
include("../config/conn.php");
$result_allkey=getallkeys($conn,$user_id);
$result_amount=getamount($conn,$user_id);
var_dump($result_allkey);
echo $result_amount."</br>";
?>
<link rel="stylesheet" href="../css/style.css" media="screen,print" type="text/css" /> 
<body style="margin:auto 0;background:#fff;">
<?php
if( isset($_GET['page']) ){
    $page = intval( $_GET['page'] );
}else{
    $page = 1;
} 
$page_string = '';
if( $page == 1 ){
    $page_string .= '<a class="left">第一页</a><a class="middle">上一页</a>';
}else{
    $page_string .= '<a class="left" href=?page=1>第一页</a><a class="middle" href=?page='.($page-1).'>上一页</a>';
} 
if( ($page == $page_count) || ($page_count == 0) ){
    $page_string .= '<a class="middle">下一页</a><a class="right">尾页</a>';
}else{
    $page_string .= '<a class="middle" href=?page='.($page+1).'>下一页</a><a class="right" href=?page='.$page_count.'>尾页</a>';
}
?>
<article>
    <p  style="font-size: 12px;color:#985d3e;margin-top: 0px;">编辑您制作的夹子</p>
<div class="btn" >
<?php
echo $page_string."</br>";
?>
</div>
<?php
if($page_size*$page>(count($result_allkey)-1)){
    ?>
    <form style="margin-top:10px;"action="deleteKey.php" method="post">
    <input type="submit" value="删除选中">
    <?php
    $sum=$result_allkey["sum"];
    for($i=0;$i<(count($result_allkey)-1)-(($page-1)*$page_size);$i++){
        $ulike=$result_allkey[$i]["ulike"];
        $perc_like=$ulike/$sum*100;
    ?>
        <aside id="biglist">
            <input type="checkbox" name="check_keys[]"  value="<?php echo $result_allkey[$i+($page-1)*$page_size]["id"]?>">
            <a target="_blank" href="playPage.php?thiskey=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"];?>&other_user=<?php echo $result_allkey[$i+($page-1)*$page_size]["other_uid"];?>" title="<?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"];?>"><?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"];?></a>
            <?php echo "喜爱程度".$perc_like."%观看次数".$ulike?>
            <a title="更改封面或者介绍" href="editKey.php?edit=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"]?>">编辑</a>
            <a onclick="return confirm('确定要删除关键词[<?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"]?>]吗？')" href="deleteKey.php?del=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"]?>">删除</a>
        </aside>
    <?php
    }
    ?>
    </form>
    <?php
}else{
    ?>
    <form action="deleteKey.php" method="post" id="keyManager">
       <a href="javascript:select()">全选</a>/<a href="javascript:fanselect()">反选</a>/<a href="javascript:noselect()">全不选</a>
       <input type="submit" value="删除选中">
    <?php
    for($i=0;$i<$page_size;$i++){
	$ulike=(int)($result_allkey[$i+($page-1)*$page_size]["ulike"]);
	$perc_like=$ulike/$sum*100;
?>
    <aside id="biglist">
        <input type="checkbox" name="check_keys[]"  value="<?php echo $result_allkey[$i+($page-1)*$page_size]["id"]?>">
        <a target="_blank" href="playPage.php?thiskey=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"];?>&other_user=<?php echo $result_allkey[$i+($page-1)*$page_size]["other_uid"];?>" title="<?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"];?>"><?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"];?></a>
        <?php echo "喜爱程度".$perc_like."%观看次数".$ulike?>
        <a title="更改封面或者介绍" href="editKey.php?edit=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"];?>">编辑</a>
        <a onclick="return confirm('确定要删除关键词[<?php echo $result_allkey[$i+($page-1)*$page_size]["video_key"]?>]吗？')" href="deleteKey.php?del=<?php echo $result_allkey[$i+($page-1)*$page_size]["id"]?>">删除</a>
    </aside>
    <?php
    }
    ?>
    </form>
    <?php
}
?>
</article>
</body>