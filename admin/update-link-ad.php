<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../config/conn.php");
include("../function/adManager.php");
if (isset($_POST["lid"])){
	$lid=$_POST["lid"];
	$aid=$_POST["aid"];
    insert_link_ad($conn,$lid,$aid);
    echo "<a href=\"ad-manager.php\">返回广告管理</a>";
}
?>