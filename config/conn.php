<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "250250250";
$mysql_database = "waitit";
$conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) //此处为mysqli并非mysql
or die("Opps some thing went wrong");
mysqli_query($conn,"set names utf8");
?>
