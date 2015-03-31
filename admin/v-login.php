<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../config/conn.php");
include("../function/adminManager.php");
?>
<form method="POST" action="v-login.php">
<input type="text" name="login" />
<input type="password" name="passwd"/>
<input type="submit" value="submit"/>
</form>
<?php
if(isset($_POST["login"]) && isset($_POST["passwd"])){
	$login=$_POST["login"];
    $passwd=$_POST["passwd"];
    $_SESSION["admin"]=$login;
}else{
	$login="";
    $passwd="";
}

if($login=="admin"&&$passwd=="faith250"){
    $allusers=show_users($conn);
    //var_dump($allusers);
    echo "用户个数：".$allusers["amount"]."</br>";
    for($i=0;$i<sizeof($allusers)-1;$i++){
    	echo "用户名：".$allusers[$i]."</br>";
    }
    echo "<a href=\"ad-manager.php\">AD MANAGEMENT</a>";
}else{
	exit;
}
?>
