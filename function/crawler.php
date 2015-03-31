<?php
function get_title($url){
    $fp=@fopen($url, "r");
    $title="";
    $result=array();
    $this_line="";
    $meta=array();
    $meta=stream_get_meta_data($fp);
    $meta=$meta["wrapper_data"];
    if (in_array("Content-Encoding: gzip",$meta)){
        $fp=gzopen($url,"r");
        while(!feof($fp)){
            $this_line=fread($fp,1024);
            if(stristr($this_line,"<title>")){
                $title=$this_line;
                $temp=explode("<title>",$title);
                if(isset($temp[1]) && $temp[1]!==""){
                    $result=$temp[1];
                    $result=explode("</title>",$result);
                    if($result[0]!=""){
                        return $result[0];
                    }     
                }else{
                    $title=fread($fp,1024);
                    $result=explode("</title>",$result);
                    if($result[0]!=""){
                        return $result[0];
                    }
            //echo $title."</br>";
                break;
                }
            }
        }
    }else{
        while(!feof($fp)){     
        $this_line=fread($fp,1024);
        if(stristr($this_line,"<title>")){
            $title=$this_line;
            $temp=explode("<title>",$title);
            if(isset($temp[1]) && $temp[1]!==""){
                $result=$temp[1];
                $result=explode("</title>",$result);
                if($result[0]!=""){
                    return $result[0];
                }    
            }else{
                $title=fread($fp,1024);
                $result=explode("</title>",$result);
                if($result[0]!=""){
                    return $result[0];
                }
            }
            //echo $title."</br>";
            break;
            }
        }  
    }
    fclose($fp);
    return "";
}
function get_web($url){
    $temp=array();
    if(stristr($url, "https://")){
        $temp=explode("https://", $url);
    }else{
        $temp=explode("http://", $url);
    }
    if(isset($temp[1])){
        $result=array();
        $result=explode("/", $temp[1]);
        if($result[0]!=""){
            return $result[0];
        }
        return null;
    }
    return null;
}
function get_google_sameweb($this_web,$url){
    $page=0;
    $result=array();
    while($page<=3){
    if($page==0){
        $suffix="";
    }else{
        $suffix="&start=".strval($page)."0";
    }
    $newurl="https://www.google.com/search?q=".$url.$suffix;
    $context = stream_context_create( array('http'=>array('timeout' => 2.0)));
    if(!$fp=fopen($newurl,"r",false, $context)){
        return false;
    }
    $this_line="";
    while(!feof($fp)){
        $this_line=fgets($fp,4096);
        if(stristr($this_line,"<a")){
            $temp1=array();
            $temp1=explode("href=\"",$this_line);
            //var_dump($temp1);
            for($i=1;$i<sizeof($temp1);$i++){
                //echo $temp1[$i];
                $temp2=array();
                $temp2=explode("\"", $temp1[$i]);
                //var_dump($temp2);
                if(stristr($temp2[0],"/url?q=")){
                    $temp3=array();
                    $temp3=explode("/url?q=http://", $temp2[0]);
                    $temp4=explode("&", $temp3[1]);
                    if(!stristr($temp4[0],"http://") && !stristr($temp4[0],"https://")){
                        if(!in_array($temp4[0],$result)){
                           array_push($result, $temp4[0]); 
                        }  
                    }
                }     
            }
        }
    }
    $page++;
    }
    //array_unique($result);
    //var_dump($result);
    return $result;
}
function get_link_inweb($this_web,$result_key){
    ini_set('max_execution_time', 0);
    $suffix="";
    $newurl="http://".$this_web.$suffix;
    $result=array(5);
    $queue=array();
    array_push($queue, $newurl);
    while($result[4]=="" && sizeof($queue)!=0){
        $this_url=array_pop($queue);
        $context = stream_context_create( array('http'=>array('timeout' => 1.0)));
        if(!$fp=@fopen($this_url,"r",false, $context)){
            continue;
        }
        $this_line="";
        while(!feof($fp)){
            $this_line=fgets($fp,4096);
            if(stristr($this_line,"<a")){
                $temp1=array();
                $temp1=explode("href=\"",$this_line);
                //var_dump($temp1);
                for($i=1;$i<sizeof($temp1);$i++){
                    //echo $temp1[$i];
                    $temp2=array();
                    $temp2=explode("\"", $temp1[$i]);
                    //var_dump($temp2);
                    //echo $temp2[0]."</br>";
                    if(stristr($temp2[0],"http") && stristr($temp2[0],$this_web)){
                        array_push($queue, $temp2[0]);
                    }
                }     
            }else{
                if(stristr($this_line,"<title>") && stristr($this_line,"</title>")){
                    if(stristr($this_line,$result_key)){
                        echo "Result:".$this_url;
                        return;
                    }
                }
            }
        }
    } 
}
?>