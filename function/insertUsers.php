<?php
function insert_users($conn,$name,$passwd,$email){
    $passwd=MD5($passwd);
    if($insert_users=mysqli_query($conn,"INSERT INTO vt_users (user_login,user_pass,email) VALUES ('$name','$passwd','$email')")){
    	$user_id=$conn->insert_id;
        $create_counter=mysqli_query($conn,"INSERT INTO vt_counter (uid,readylinks) VALUES('$user_id',0)");
    	mkdir("../users/".$user_id."/portrait",0755,true);
    	copy("../users/0/portrait/myface.jpg","../users/".$user_id."/portrait/myface.jpg");
    	return true;
    }else{
    	echo "Can't insert into users.";
    	return false;
    }
}
function check_username($conn,$name){
    if($check=mysqli_query($conn,"select id from vt_users where user_login='$name'")){
   	    $username_exist = mysqli_num_rows($check);
        //echo $username_exist;
        return $username_exist;
    }else{
    	echo "Database select invalid";
    }
   
}
?>