<?php
function get_same_substring($link,$test){
    $copy_test=$test;
    $add=0;
    $temp_link=$link;
    if(stristr($test, "https://")){
        $temp=explode("https://", $test);
        $temp_link=explode("https://", $link);
        $add==8;
    }
    if(stristr($test, "http://")){
        $temp=explode("http://", $test);
        $temp_link=explode("http://", $link);
        $add=7;
    }
    if(isset($temp) and sizeof($temp)>1){
        $test=$temp[1];
    }
    if(sizeof($temp_link)>1){
        $temp_link=$temp_link[1];
    }else{
        $temp_link=$temp_link[0];
    }
    $cut=0;
    for($i=0;$i<strlen($test);$i++){
        if($test[$i]!=$temp_link[$i]){
            $cut=$i;
            break;
        }
    }
    if($cut>0){
        $test=substr($test,$cut);
    }
    $find=false;
    $start=-1;
    $start1=-1;
    $end=-1;
    $max=0;
    $index="";
    $index1="";
    for($i=0;$i<strlen($link);$i++){
        $ii=$i;
        for($j=0;$j<strlen($test);$j++){
            if(isset($test[$j]) && isset($link[$ii]) && $test[$j]==$link[$ii]){
                if($find==false){
                    $find=true;
                    $start=$ii; 
                    $start1=$j;                 
                }
                $ii++;   
            }else{
                if($find==true){
                    $find=false;
                    $end=$ii;
                    $length=$end-$start;
                    if($length>=$max){
                        $max=$length;
                        $index=$start;
                        $result=substr($link,$start,$max);
                    }
                    $ii=$i;
                }
            }  
        }
        if($find==true){
            $find=false;
            $end=$ii;
            $length=$end-$start;
            if($length>=$max){
                $max=$length;
                $index=$start;
                $result=substr($link,$start,$max);
            }
        }
    }
    $index1=strpos($copy_test, $result);
    return array($result,$index,$max,$index1);
}
function update_web_content($same_link,$content_link,$conn,$wid,$link){
    if(sizeof($same_link)!=4){
        return;
    }
    $start=$same_link[1];
    $end=$start+$same_link[2];
    $content=substr($content_link,0,$start);
    $offset=substr($content_link,$end);
    if($same_link[0][0]=='?'){
        $from_link="?";
        $num=null;
    }else{
        $from_link=substr($link,0,$same_link[3]);
        for ($i=strlen($from_link)-1;$i>=0;$i--){
            if($i==strlen($from_link)-1 and $from_link[$i]=='/'){
                $num=0;
                for($j=0;$j<sizeof($from_link);$j++){
                    if($j=='/'){
                        $num++;
                    }
                }
                $from_link="/";
                break;
            }
            if($i!=strlen($from_link)-1 and $from_link[$i]=='/'){
                $from_link=substr($from_link,$i);
                break;
            }
        }
    }
    echo $from_link;
    $from_offset=substr($link,$same_link[3]+$same_link[2]);
    //$update=mysqli_query($conn,"UPDATE vt_web SET content='$content', offset='$offset' , from_link='$from_link' , from_offset='$from_offset' ,num='$num' WHERE id='$wid'");
    return true;
}
$content="http://vimeo.com/channels/staffpicks/112398958";
$input="player.vimeo.com/video/112398958";
$a=get_same_substring($input,$content);
var_dump($a);
$b=update_web_content($a,$input,$conn,$wid,$content);
?>