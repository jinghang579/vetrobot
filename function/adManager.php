<?php
function get_ad_by_lid($conn,$lid){
	$select=mysqli_query($conn,"SELECT aid FROM vt_lid_aid WHERE lid='$lid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)==1){
		$aid=$row["aid"];
	}
	if(isset($aid)){
		return $aid;
	}
	return "NULL";
}
function get_ad_by_aid($conn,$aid){
	$result=array();
	$select=mysqli_query($conn,"SELECT * FROM vt_advert WHERE aid='$aid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)==1){
		$result=array("ad_name"=>$row["ad_name"],"ad_pic"=>$row["ad_pic"],"ad_url"=>$row["ad_url"],"ad_price"=>$row["ad_price"]);
	}
	if(sizeof($result)!=0){
		return $result;
	}
	return "NULL";
}
function get_all_ad($conn){
	$result=array();
	$select=mysqli_query($conn,"SELECT * From vt_advert");
    while($row=mysqli_fetch_array($select)){
    	$temp=array();
    	$temp["aid"]=$row["aid"];
    	$temp["ad_name"]=$row["ad_name"];
    	$temp["pic"]=$row["ad_pic"];
    	$temp["url"]=$row["ad_url"];
    	$temp["price"]=$row["ad_price"];
    	array_push($result, $temp);
    }
    return $result;
}
function insert_ad($conn,$name,$pic,$url,$price){
	$select=mysqli_query($conn,"SELECT aid FROM vt_advert WHERE ad_name='$name'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)>=1){
		return;
	}else{
		$insert=mysqli_query($conn,"INSERT INTO vt_advert (ad_name,ad_pic,ad_url,ad_price) VALUES ('$name','$pic','$url','$price')");
	}   
}
function insert_link_ad($conn,$lid,$aid){
	$select=mysqli_query($conn,"SELECT * FROM vt_lid_aid WHERE lid='$lid'");
	$row=mysqli_fetch_array($select);
	if(mysqli_num_rows($select)>=1){
		return;
	}else{
		$insert=mysqli_query($conn,"INSERT INTO vt_lid_aid (lid,aid) VALUES('$lid','$aid')");
	}
}
?>