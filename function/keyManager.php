<?php
function getallkeys($conn,$uid){
	$result=array();
	$select_allkeys=mysqli_query($conn,"SELECT id, uid,video_key ,sum_like FROM vt_video_key WHERE uid='$uid'");
    $sum=0;
    while($row_allkeys=mysqli_fetch_array($select_allkeys)){
        $kid=$row_allkeys["id"];
        $link_amount=mysqli_query($conn,"SELECT count(lid) as amount FROM vt_lid_kid WHERE uid='$uid' && kid='$kid'");
        $row_link_amount=mysqli_fetch_array($link_amount);
        if(mysqli_num_rows($link_amount)==0){
            $amount=0;
        }
        $amount=$row_link_amount["amount"];
        $select=mysqli_query($conn,"SELECT ulike FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
        $row=mysqli_fetch_array($select);
        if(mysqli_num_rows($select)!=0){
            $ulike=$row["ulike"];
            $sum=$sum+$ulike;
        }
	    $result[]=array("id"=>$kid,"video_key"=>$row_allkeys['video_key'],"ulike"=>$ulike,"other_uid"=>$row_allkeys['uid'],"amount"=>$amount,"sum_like"=>$row_allkeys['sum_like']);
    }
    $result["sum"]=$sum;
    return $result;
}
function getakey_byid($conn,$kid,$uid){
    $result=array();
    $select_allkeys=mysqli_query($conn,"SELECT sum_like FROM vt_video_key WHERE id='$kid'");
    $sum=0;
    while($row_allkeys=mysqli_fetch_array($select_allkeys)){
        $link_amount=mysqli_query($conn,"SELECT count(lid) as amount FROM vt_lid_kid WHERE uid='$uid' && kid='$kid'");
        $row_link_amount=mysqli_fetch_array($link_amount);
        if(mysqli_num_rows($link_amount)==0){
            $amount=0;
        }
        $amount=$row_link_amount["amount"];
        $select=mysqli_query($conn,"SELECT ulike FROM vt_uid_kid WHERE uid='$uid' && kid='$kid'");
        $row=mysqli_fetch_array($select);
        if(mysqli_num_rows($select)!=0){
            $ulike=$row["ulike"];
            $sum=$sum+$ulike;
        }
        $result=array("ulike"=>$ulike,"amount"=>$amount,"sum_like"=>$row_allkeys['sum_like']);
    }
    return $result;
}
function getamount($conn,$uid){
	$select_amount=mysqli_query($conn,"SELECT count(id) as amount FROM vt_video_key WHERE uid='$uid'");
    while($row_amount=mysqli_fetch_array($select_amount)){
	    $result=$row_amount['amount'];
    }
    return $result;
}
function delete_key($conn,$id,$uid){
    $delete_key=mysqli_query($conn,"DELETE from vt_video_key WHERE id='$id'");
    $delete_uid_kid=mysqli_query($conn,"DELETE FROM vt_uid_kid WHERE kid='$id' && uid='$uid'");
    if (is_dir('../images/keyFrontCover')) {
        unlink('../images/keyFrontCover/'.$id.'.jpg');
    }
    $result_lid=array();
    $select_lid=mysqli_query($conn,"SELECT lid from vt_lid_kid WHERE kid='$id'");
    while($row_lid=mysqli_fetch_array($select_lid)){
        $result_lid[]=$row_lid['lid'];
    }
    $result_wid=array();
    $select_wid=mysqli_query($conn,"SELECT wid from vt_wid_kid WHERE kid='$id'");
    while($row_wid=mysqli_fetch_array($select_wid)){
        $result_wid[]=$row_wid['wid'];
    }
    //var_dump($result_lid);
    //var_dump($result_wid);
    for($i=0;$i<count($result_lid);$i++){
        $delete_lid=mysqli_query($conn,"DELETE from vt_lid_kid WHERE lid='$result_lid[$i]' && kid='$id'");
        $delete_link=mysqli_query($conn,"DELETE from vt_link WHERE id='$result_lid[$i]'");
    }
    for($i=0;$i<count($result_wid);$i++){
        $delete_wid=mysqli_query($conn,"DELETE from vt_wid_kid WHERE wid='$result_wid[$i]' && kid='$id'");
        $delete_web=mysqli_query($conn,"DELETE from vt_web WHERE id='$result_wid[$i]'");
    }
}
function select_9keys($conn,$p){
    $result=array();
    $m=$p*9;
    $n=$p*9+9;
    $select_allkeys=mysqli_query($conn,"SELECT id,uid,video_key,key_des,sum_like,belong FROM vt_video_key ORDER BY id DESC LIMIT $m,$n");
    for($i=0;$i<9;$i++){
        $row=mysqli_fetch_array($select_allkeys);
        $uid=$row["uid"];
        $kid=$row["id"];
        $f=$row["belong"];
        if($kid==""){
            break;
        }
        if($f=="0"){
            $folder="其他";
        }else{
            $select_folder=mysqli_query($conn,"SELECT folder FROM vt_folder WHERE fid='$f'");
            $row_select_folder=mysqli_fetch_array($select_folder);
            if(mysqli_num_rows($select_folder)==1){
                $folder=$row_select_folder["folder"];
            }   
        }
        $select_username=mysqli_query($conn,"SELECT user_login FROM vt_users WHERE id='$uid'");
        $row_username=mysqli_fetch_array($select_username);
        $select_link=mysqli_query($conn,"SELECT count(lid) as amount,max(lid) as link FROM vt_lid_kid WHERE uid='$uid' && kid='$kid'");
        if($row_select_link=mysqli_fetch_array($select_link)){
            $amount_link=$row_select_link["amount"];
            $last_link=$row_select_link["link"];
            if($last_link!=""){
                $get_link=mysqli_query($conn,"SELECT link,l_title,link_des FROM vt_link WHERE id='$last_link'");
                if($row_get_link=mysqli_fetch_array($get_link)){
                    $link=$row_get_link["link"];
                    $l_title=$row_get_link["l_title"];
                    $l_des=$row_get_link["link_des"];
                }
            }
        }
        $temp=array("kid"=>$kid,"uid"=>$uid,"user_name"=>$row_username["user_login"],"key"=>$row["video_key"],"key_des"=>$row["key_des"],
            "sumlike"=>$row["sum_like"],"amount"=>$amount_link,"link"=>$link,"l_title"=>$l_title,"l_des"=>$l_des,"folder"=>$folder,"fid"=>$f);
        array_push($result, $temp);
    }
    return $result;
}
function select_9keys_byfolder($conn,$p,$f){
    $result=array();
    $select_allkeys=mysqli_query($conn,"SELECT id,uid,video_key,key_des,sum_like FROM vt_video_key WHERE belong='$f' ORDER BY id DESC");
    for($i=0;$i<9;$i++){
        $row=mysqli_fetch_array($select_allkeys);
        $uid=$row["uid"];
        $kid=$row["id"];
        if($kid==""){
            break;
        }
        if($f=="0"){
            $folder="其他";
        }else{
            $select_folder=mysqli_query($conn,"SELECT folder FROM vt_folder WHERE fid='$f'");
        $row_select_folder=mysqli_fetch_array($select_folder);
        if(mysqli_num_rows($select_folder)==1){          
            $folder=$row_select_folder["folder"];
        }  
        }

        $select_username=mysqli_query($conn,"SELECT user_login FROM vt_users WHERE id='$uid'");
        $row_username=mysqli_fetch_array($select_username);
        $select_link=mysqli_query($conn,"SELECT count(lid) as amount,max(lid) as link FROM vt_lid_kid WHERE uid='$uid' && kid='$kid'");
        if($row_select_link=mysqli_fetch_array($select_link)){
            $amount_link=$row_select_link["amount"];
            $last_link=$row_select_link["link"];
            if($last_link!=""){
                $get_link=mysqli_query($conn,"SELECT link,l_title,link_des FROM vt_link WHERE id='$last_link'");
                if($row_get_link=mysqli_fetch_array($get_link)){
                    $link=$row_get_link["link"];
                    $l_title=$row_get_link["l_title"];
                    $l_des=$row_get_link["link_des"];
                }
            }
        }
        $temp=array("kid"=>$kid,"uid"=>$uid,"user_name"=>$row_username["user_login"],"key"=>$row["video_key"],"key_des"=>$row["key_des"],
            "sumlike"=>$row["sum_like"],"amount"=>$amount_link,"link"=>$link,"l_title"=>$l_title,"l_des"=>$l_des,"folder"=>$folder,"fid"=>$f);
        array_push($result, $temp);
    }
    return $result;
}
function get_alllikekey_byuser($conn,$uid){
    $result=array();
    $select_uid_kid=mysqli_query($conn,"SELECT kid,ulike FROM vt_uid_kid WHERE uid='$uid'");
    while($row=mysqli_fetch_array($select_uid_kid)){
        $kid=$row["kid"];
        $select_key=mysqli_query($conn,"SELECT uid,video_key,key_des,sum_like FROM vt_video_key WHERE id='$kid'");
        $row_key=mysqli_fetch_array($select_key);
        if(mysqli_num_rows($select_key)==1){
            $temp=array("kid"=>$kid,"ulike"=>$row["ulike"],"key"=>$row_key["video_key"],"des"=>$row_key["key_des"],"sumlike"=>$row_key["sum_like"],"other_uid"=>$row_key["uid"]);
            array_push($result, $temp);
        } 
    }
    if(sizeof($result)!=0){
        return $result;
    }else{
        return "";
    }
}
function edit_key_name($conn,$kid,$name){
    $update=mysqli_query($conn,"UPDATE vt_video_key SET video_key='$name' WHERE id='$kid'");
}
?>