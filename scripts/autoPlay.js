function next_autoplay(lid){
    if(lid==null){
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
            document.getElementById("autoPlay").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","autoPlay_main.php?p=" + lid,true);
    xmlhttp.send();
}
function prompt_login(){
    var loginBox = "#login_box";
    $(loginBox).fadeIn(300);
    var popMargTop = ($(loginBox).height() + 24) / 2; 
    var popMargLeft = ($(loginBox).width() + 24) / 2; 
    $(loginBox).css({ 
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });
    $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(300);
    return false;
}
function like_link(uid,kid,lid,up_uid){
    if(document.getElementById("like_link_"+uid+"_"+lid).className=="remove_like_link"){
        document.getElementById("like_link_"+uid+"_"+lid).className="like_link";
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("link_sumlikes").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","like/likeLink.php?uid="+uid+"&kid="+kid+"&lid="+lid+"&other_uid="+up_uid+"&likeornot=0",true);
        xmlhttp.send();      
    }else if(document.getElementById("like_link_"+uid+"_"+lid).className=="like_link"){
        document.getElementById("like_link_"+uid+"_"+lid).className="remove_like_link";
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("link_sumlikes").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","like/likeLink.php?uid="+uid+"&kid="+kid+"&lid="+lid+"&other_uid="+up_uid+"&likeornot=1",true);
        xmlhttp.send();
    }else{
        return;
    } 
}