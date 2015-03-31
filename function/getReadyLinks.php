<?php
function __get_readylinks__($conn,$uid,$searchType){
	$result=array();
	$result_title=array();
	$result_pagelink=array();
	$min=10000;
	$select_readylink=mysqli_query($conn,"SELECT min(id),link,pagelink, thisTitle ,thisKey,type FROM vt_readylinks WHERE uid='$uid' && searchType='$searchType'");
	while($row_readylink=mysqli_fetch_array($select_readylink)){
		$min=$row_readylink['id'];
		//echo $id."</br>";
		$result_title[$min]=$row_readylink['thisTitle'];
		$result_pagelink[$min]=$row_readylink['pagelink'];
		$result_key[$min]=$row_readylink['thisKey'];
		$result_otheruser[$min]=$row_readylink['link'];
		$result_type[$min]=$row_readylink['type'];
		//echo $result_title[$id]."</br>";
		//echo $result_pagelink[$id]."</br>";
	}
	if($result_title[$min]!=null&&$result_pagelink[$min]!=null){
		$result[0]=$result_title[$min];
		$result[1]=$result_pagelink[$min];
		$result[2]=$result_key[$min];
		$result[3]=$result_otheruser[$min];
		$result[4]=$result_type[$min];
		return $result;
	}
}
function get_readylinks($conn,$uid){
    $select_readylink=mysqli_query($conn,"SELECT id,link,thisTitle,thisKey,searchType,offset FROM vt_readylinks WHERE uid='$uid'");
    $result=array();
    while($row=mysqli_fetch_array($select_readylink)){
    	$temp=array();
        $temp=array("id"=>$row["id"],"link"=>$row["link"],"title"=>$row["thisTitle"],"key"=>$row["thisKey"],"from"=>$row["searchType"],"offset"=>$row["offset"]);
        array_push($result,$temp);
    }
    return $result;
}

function get_numreadylinks($conn,$uid){
	$select_numreadylink=mysqli_query($conn,"SELECT readylinks FROM vt_counter WHERE uid='$uid'");
	while($row_numreadylink=mysqli_fetch_array($select_numreadylink)){
		$num_readylinks=$row_numreadylink['readylinks'];
		return $num_readylinks;
	}
	return "0";
}
?>