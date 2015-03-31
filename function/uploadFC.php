<?php
session_start();
$user_id=$_SESSION['user_id'];
$edit_id=$_POST["kid"];
$path = "../images/keyFrontCover/";
//echo $edit_id;
$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];
    if(strlen($name)){
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats)){
            if($size<(50*1024)){
                $actual_image_name = $edit_id.".jpg";//.$ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name)){
                    echo "<img style='width:80px;height:90px;' src='../images/keyFrontCover/".$actual_image_name."'>";
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