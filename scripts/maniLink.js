function like_link(uid,key,link,other_uid,num){
    if(uid==""){
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
    if(document.getElementById("like_link_"+uid+"_"+num).className=="remove_like_link"){
        document.getElementById("like_link_"+uid+"_"+num).className="like_link";
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("#").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","likeLink.php?uid="+uid+"&kid="+key+"&lid="+link+"&other_uid="+other_uid+"&likeornot=0",true);
        xmlhttp.send();      
    }else if(document.getElementById("like_link_"+uid+"_"+num).className=="like_link"){
        document.getElementById("like_link_"+uid+"_"+num).className="remove_like_link";
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("#").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","likeLink.php?uid="+uid+"&kid="+key+"&lid="+link+"&other_uid="+other_uid+"&likeornot=1",true);
        xmlhttp.send();
    }else{
        return;
    } 
}
function like_readylink(uid,kid,link,ifexist,num,method){
    if(document.getElementById("like_readylink_"+uid+"_"+num).className=="remove_like_link"){
        document.getElementById("like_readylink_"+uid+"_"+num).className="like_link";
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
        xmlhttp.open("GET","likeit.php?uid="+uid+"&kid="+kid+"&link="+link+"&ifexist="+ifexist+"&likeornot=0"+"&method="+method,true);
        xmlhttp.send();      
    }else if(document.getElementById("like_readylink_"+uid+"_"+num).className=="like_link"){
        document.getElementById("like_readylink_"+uid+"_"+num).className="remove_like_link";
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
        xmlhttp.open("GET","likeit.php?uid="+uid+"&kid="+kid+"&link="+link+"&ifexist="+ifexist+"&likeornot=1"+"&method="+method,true);
        xmlhttp.send();
    }else{
        return;
    } 

}
function delete_readylink(rid,lid,kid){
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
    xmlhttp.open("GET","deleteReadyLink.php?rid="+rid+"&lid="+lid+"&kid="+kid,true);
    xmlhttp.send(); 
}
function like_key(uid,kid) {
    if(uid==""){
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
    }else{
        if(document.getElementById("like_key").className=="remove_likeit"){
            document.getElementById("like_key").className="likeit";
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("key_sumlike").innerHTML=xmlhttp.responseText;
                }
            }
            //var data="uid="+uid+"&kid="+kid;
            //alert(kid);
            //xmlhttp.open("POST","likeKey.php",true);
            //xmlhttp.send(data);
            xmlhttp.open("GET","likeKey.php?uid="+uid+"&kid="+kid+"&likeornot=0",true);
            xmlhttp.send();
            
        }else if(document.getElementById("like_key").className=="likeit"){
            document.getElementById("like_key").className="remove_likeit";
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("key_sumlike").innerHTML=xmlhttp.responseText;
                }
            }
            //var data="uid="+uid+"&kid="+kid;
            //alert(kid);
            //xmlhttp.open("POST","likeKey.php",true);
            //xmlhttp.send(data);
            xmlhttp.open("GET","likeKey.php?uid="+uid+"&kid="+kid+"&likeornot=1",true);
            xmlhttp.send();
        }else{
            return;
        } 
    }

}