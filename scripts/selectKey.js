function choose_likekey(t){
	//alert(t.className);
	var tc=t.className;
	if(tc=="a_tag"){
		t.className="a_tag_del";
	}else if(tc=="a_tag_del"){
		t.className="a_tag";
	}
}
function del_select_likekey(){
	var del=document.getElementsByName("likekey");
	var i;
	var del_kid=[];
	for(i=0;i<del.length;i++){
		if(del[i].className=="a_tag_del"){
			del_kid.push(del[i].id);
		}
	}
	var msg="确定要删除选中的夹子？";
	if(confirm(msg)==true){
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("after_del").innerHTML=xmlhttp.responseText;
            }
        }
        var data="del_kid[]="+del_kid[0];
        for(i=1;i<del_kid.length;i++){
        	data+="&"+"del_kid[]="+del_kid[i];
        }
        //alert(data);
        xmlhttp.open("POST","deleteLikeKey.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(data);
	}else{
		return false;
	}
}
