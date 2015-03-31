function postcreateKey(link){
    var xmlhttp;
    var ul = link;
    var ut = document.getElementById("url_title").value;
    var ik = document.getElementById("input_key").value;
    var im = document.getElementById("select_type").value;
    var sk = document.getElementById("select_key").value;
    var ld = document.getElementById("link_des").value;
    var ui = document.getElementById("key_cover");
    var fd = document.getElementById("select_folder").value;
    var cont=document.getElementById("input_content").value;
    if(ul==""){
        alert("请输入URL地址");
        return;
    }
    if(im=="1"){
        im="video";
    }else if(im=="2"){
        im="photo";
    }
    var data=new FormData();
    data.append("input_key",ik);
    data.append("url_title",ut);
    data.append("linkdes",ld);
    data.append("url_link",ul);
    data.append("select_key",sk);
    data.append("type",im);
    data.append("folder",fd);
    data.append("content",cont);
    data.append("key_cover",ui.files[0]);
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("ctrlScreen").innerHTML=xmlhttp.responseText;
    }
  }
    xmlhttp.open("POST","getUrl.php",true);
    //xmlhttp.setRequestHeader("Content-type","multipart/form-data");
    xmlhttp.send(data);
}
function post_edit_link(lid){
    var title=document.getElementsByName("title_"+lid)[0].value;
    var des=document.getElementsByName("des_"+lid)[0].value;
    var m=document.getElementsByName("m_"+lid)[0].value;
    var data="title="+title+"&des="+des+"&m="+m+"&lid="+lid;
    var xmlhttp;  
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("article_"+lid).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","editLink.php",true);
    //alert(data);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
}
function delete_link(lid,kid){
    var data="lid="+lid+"&kid="+kid+"&m=del";
    var msg=confirm("确定要删除这个链接？");
    if(msg==false){
        return false;
    }
    var xmlhttp;  
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("article_"+lid).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","editLink.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
}
function post_des(des){
  var data_string='edit_des='+des;
    $.ajax({
        type:"POST",
        url:"userSetupPost.php",
        data: data_string,
        success:function(){
          $('.des_sucess').fadeIn(100).show();
        }
    });
    return false;
}
function post_edit_key(kid,id,perc){
    var key=document.getElementById("key_name").value;
    var data="kid="+kid+"&key_name="+key+"&id="+id+"&perc="+perc;
    var xmlhttp;  
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("my_key_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","editKey.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);

}
function delete_key(kid,id){
    var data="del="+kid;
    var msg=confirm("确定要删除这个夹子？");
    if(msg==false){
        return false;
    }
    var xmlhttp;  
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    document.getElementById("my_key_"+id).style.display="none";
    xmlhttp.open("POST","deleteKey.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
}

function post_input_link(){
    document.getElementById("loader").style.display="";
    var link=document.getElementById("input_link").value;
    if(link==""){
        return false;
    }
    var data="link="+link;
    var xmlhttp;  
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("ctrlScreen").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","createKey.php",true);
    //alert(data);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
}
function post_search(){
    var q=document.getElementById("search_input").value;
    var data="q="+q;
    //alert(data);
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementsByClassName("wrap")[0].innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","listAllKey.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(data);
}