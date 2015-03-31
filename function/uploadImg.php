<?php
session_start();
$user_id=$_SESSION['user_id'];
$path = "../users/".$user_id."/portrait/";
$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];
    if(strlen($name)){
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats)){
            if($size<(50*1024)){
                $actual_image_name = "myface.jpg";//.$ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name)){
                    echo "已经成功更新头像为："."</br>"."<img src='../users/".$user_id."/portrait/".$actual_image_name."'  class='preview'>";
                }else{
                    echo "failed";
                }
            }else{
                echo "图片大小最大为 50KB";
            }
        }else{
            echo "图片的格式不符合要求";                                    
        }
    }       
exit;
}
?>