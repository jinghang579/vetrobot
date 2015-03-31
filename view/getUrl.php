<?php 
include("../config/conn.php");
include("../function/likeUrl.php");
include("../function/webManager.php");
session_start();
//header("Location:main.php ");
$user_id=$_SESSION['user_id'];
$input_key=addslashes($_POST["input_key"]);
$select_key=$_POST["select_key"];
$link_des=htmlspecialchars($_POST["linkdes"]);
$input_type=addslashes($_POST["type"]);
$input_url=$_POST["url_link"];
$path = "../images/keyFrontCover/";
$valid_formats = array("jpg", "png", "gif", "bmp");
$title=$_POST["url_title"];
$folder=$_POST["folder"];
$content_link=$_POST["content"];
//echo $user_id;
//echo "input:".$input_key;
//echo "select_key:".$select_key;
//echo $input_url;
//echo $title;
//echo $folder;
//echo $content_link;
//echo $input_type;
//echo "</br>";
$same_link=get_same_substring($content_link,$input_url);
//var_dump($same_link);
?>
<article>
<?php
if($input_url==""){
	die("<span>抱歉，输入的URL链接不得为空，请关闭控制台后重新输入。</span>");
}
if($input_key!=""){
	$result_link = mysqli_query($conn,"SELECT link FROM vt_link where uid='$user_id' && link='$input_url'") or die(mysqli_error());//判断用户是否已经拥有这个链接
    if($row = mysqli_fetch_array($result_link)){
    echo "<span>抱歉".$input_url."链接已经存在，不能重复添加。</span>";
    //echo "</br>";
    //echo "<a href='main.php'>重新输入</a>"."</br>";
    }else{		
        $array_input_web=split("/",$input_url,-1);
	    $input_web=$array_input_web[2];//此处的链接是去掉HTTP://的
        if($input_web!=""){
            //echo $input_web."成功获取链接的网站URL"."</br>";
            $wid=data_web($conn,$user_id,$input_web,$input_type);
            
            //echo $wid."</br>";
        }
        if($wid!=""){
            $update_web_attr=update_web_content($same_link,$content_link,$conn,$wid,$input_url);
            $lid=data_link($conn,$user_id,$wid,$input_url,$input_type,$link_des,$title,$content_link);
            if($lid!=""){
                //echo $lid."</br>";
                $kid=data_video_key($conn,$user_id,$input_key,$folder);
                    //echo $kid."</br>";
                lid_kid($conn,$user_id,$lid,$kid);
                wid_kid($conn,$user_id,$wid,$kid);
                uid_kid($conn,$user_id,$kid);
                //echo "制作链接成功！";
            }else{
            //echo "LID未获得！";
            } 
        }
            $name = $_FILES['key_cover']['name'];
            //echo $name;
            if($name!=""){
                $size = $_FILES['key_cover']['size'];
                //echo $name.$size;
                if(strlen($name)){
                    list($txt, $ext) = explode(".", $name);
                    if(in_array($ext,$valid_formats)){
                        if($size<(50*1024)){
                            $actual_image_name = $kid.".jpg";//.$ext;
                            $tmp = $_FILES['key_cover']['tmp_name'];
                            if(move_uploaded_file($tmp, $path.$actual_image_name)){
                                echo "<strong>制作链接成功！</strong></br>
                                <p>点击-关闭控制台-退出</p>".
                                "<text>封面更新为：</text></br>".
                                "<img src='../images/keyFrontCover/".$actual_image_name."'  class='preview'></br>
                                <form style=\"margin-top:18px;margin-bottom:5px;\" action=\"main.php\"><button style=\"width:70px;font-size:14px;height:36px;\" class=\"red_btn\" type=\"submit\">确定</button></form>";
                            }else{
                                echo "failed";
                            }
                        }else{
                            echo "图片大小最大为 50 KB";
                        }
                    }else{
                        echo "图片的格式不符合要求";                                    
                    }
                }
            }       
    }
}else{
	$result_link = mysqli_query($conn,"SELECT link FROM vt_link where uid='$user_id' && link='$input_url'") or die(mysqli_error());//判断用户是否已经拥有这个链接
    if($row = mysqli_fetch_array($result_link)){
        echo "<span>抱歉".$input_url."链接已经存在，不能重复添加。</span>";
    //echo "</br>";
    //echo "<a href='main.php'>重新输入</a>"."</br>";
    }else{		
            $array_input_web=split("/",$input_url,-1);
	        $input_web=$array_input_web[2];//此处的链接是去掉HTTP://的
            $name="";
            if(isset($_FILES['key_cover']['name'])){
                $name = $_FILES['key_cover']['name'];    
            }
            if($name!=""){
                $size = $_FILES['key_cover']['size'];
                if(strlen($name)){
                list($txt, $ext) = explode(".", $name);
                    if(in_array($ext,$valid_formats)){
                        if($size<(50*1024)){
                            $actual_image_name = $select_key.".".$ext;
                            $tmp = $_FILES['key_cover']['tmp_name'];
                            //unlink($path.$actual_image_name);
                            if(move_uploaded_file($tmp, $path.$actual_image_name)){
                                echo "已经成功更新封面";//."</br>"."<img src='../images/keyFrontCover/".$actual_image_name."'  class='preview'>";
                            }else{
                                echo "failed";
                            }
                        }else{
                            echo "图片大小最大为 50 KB";
                        }
                    }else{
                        echo "图片的格式不符合要求";                                    
                    }
                } 
            }
            if($input_web!=""){
                //echo $input_web."成功获取链接的网站URL"."</br>";
                $wid=data_web($conn,$user_id,$input_web,$input_type);
                //echo $wid."</br>";
            }
            if($wid!=""){
                $update_web_attr=update_web_content($same_link,$content_link,$conn,$wid,$input_url);
                $lid=data_link($conn,$user_id,$wid,$input_url,$input_type,$link_des,$title,$content_link);
                //echo $lid."</br>";
                if($lid!=""){
                    lid_kid($conn,$user_id,$lid,$select_key);
                    wid_kid($conn,$user_id,$wid,$select_key);
                    uid_kid($conn,$user_id,$select_key);           
                    echo "<strong>制作链接成功！</strong></br><p>点击-关闭控制台-退出</p></br>
                    <form style=\"margin-top:18px;margin-bottom:5px;\" action=\"main.php\"><button style=\"width:70px;font-size:14px;height:36px;\" class=\"red_btn\" type=\"submit\">确定</button></form>"; 
                }else{
                    echo "LID未获得";
                }   
            }
    }

}

?>
</article>