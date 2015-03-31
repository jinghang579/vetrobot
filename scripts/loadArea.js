function getReadybyuser(uid){
    if(uid==null){
        return false;
    }
    document.getElementById("ctrlScreen").style.display="";
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
    xmlhttp.open("GET","crawlerByUser.php?u=" + uid,true);
    xmlhttp.send();
}
function loadUserSetup(uid){
    if(uid==null){
        return false;
    }else{
        document.getElementById("ctrlScreen").style.display="";
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
    xmlhttp.open("GET","userSetup.php?t=" + Math.random(),true);
    xmlhttp.send();
    $("#ctrlScreen").show();

    }
 
}
function loadXMLuploadImg(){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("uploadImgScreen").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","uploadImg.php?t=" + Math.random(),true);
    xmlhttp.send();
}
function loadInputURL(uid){
    if(uid==null){
        return false;
    }
    var xmlhttp;
    document.getElementById("ctrlScreen").style.display="";
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
    xmlhttp.open("GET","createKey.php?t=" + Math.random(),true);
    xmlhttp.send();
}
function loadkeyManager(){
    var xmlhttp;
    document.getElementById("ctrlScreen").style.display="";
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
    xmlhttp.open("GET","keyManager.php?t=" + Math.random(),true);
    xmlhttp.send();
}
function loadlikeKey(uid){
    var xmlhttp;
    document.getElementById("ctrlScreen").style.display="";
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
    xmlhttp.open("GET","listlikeKey.php?u=" + uid,true);
    xmlhttp.send();
}
function getReadybyweb(uid){
    if(uid==null){
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
            document.getElementById("num_Ready").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","crawlerByWeb.php?t=" + Math.random(),true);
    xmlhttp.send();
}
function getReadybySE(uid){
    if(uid==null){
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
            document.getElementById("num_Ready").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","crawlerBySE.php?t=" + Math.random(),true);
    xmlhttp.send();
}
function load_more_key(p,f){
    document.getElementById("page="+p).style.display="none";
    p=parseInt(p)+1;
    $.get("listAllKeys.php?p="+p+"&f="+f,function(data,status){
        $(".wrap").append(data);
    });
    
}
function edit_my_key(kid,id,key,perc){
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
    xmlhttp.open("GET","editKey.php?k=" +kid+"&key="+key+"&num="+id+"&perc="+perc,true);
    xmlhttp.send();
}
function load_selector(uid){
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    document.getElementById("sub_select").style.display="";
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("sub_select").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","subSelector.php?uid=" +uid,true);
    xmlhttp.send();
}
function pass_col(kid,key){
    document.getElementById("select_key").value=kid;
    document.getElementById("select_key").innerHTML=key;
    document.getElementById("sub_select").style.display="none";

}
function pass_folder(fid,folder){
    document.getElementById("select_folder").value=fid;
    document.getElementById("select_folder").innerHTML=folder;
    document.getElementById("folder").style.display="none";

}
function pass_type(type,show){
    document.getElementById("select_type").value=type;
    document.getElementById("select_type").innerHTML=show;
    document.getElementById("sub_type").style.display="none";
    if(type==1){
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("input_content_div").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","createKey/linkVideo.php",true);
        xmlhttp.send();
    }else if(type==2){
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("input_content_div").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","createKey/linkPhoto.php",true);
        xmlhttp.send();
    }
}
function choose_folder(fid){
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
    xmlhttp.open("GET","listAllKeys.php?p=0&f=" +fid,true);
    xmlhttp.send();    
}
$(document).ready(function() { 
    $('#search_input').keyup(function(){
        var q=document.getElementById("search_input").value;
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("search_auto").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","search/searchAuto.php?q=" +q,true);
        xmlhttp.send(); 
    });
}); 
