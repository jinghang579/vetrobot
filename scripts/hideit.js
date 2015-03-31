function hideit(){
    document.getElementById("ctrlScreen").style.display="none";
    //location.reload();
}
function show_create_new_key(){
    document.getElementById("create_new_key").style.display="";
    document.getElementById("cancle_create").style.display="";
}
function hide_create_new_key(){
    document.getElementById("create_new_key").style.display="none";
    document.getElementById("cancle_create").style.display="none";
}
function show_edit_link(lid){
    document.getElementById(lid).style.display="none";
    document.getElementById(lid+"_form").style.display="";
}
function showachieve(str){
	var sec; 
    if(str=="1"){
        sec=document.getElementById("achieve_hide1");
    }else if(str=="2"){
    	sec=document.getElementById("achieve_hide2");
    }else if(str=="3"){
    	sec=document.getElementById("achieve_hide3");
    }
    sec.style.display='';
}
function hideachieve(str){
	var sec; 
    if(str=="1"){
        sec=document.getElementById("achieve_hide1");
    }else if(str=="2"){
    	sec=document.getElementById("achieve_hide2");
    }else if(str=="3"){
    	sec=document.getElementById("achieve_hide3");
    }
    sec.style.display='none';
}
//登陆弹出
$(document).ready(function() {
$('a.login-window').click(function() {
    
            //Getting the variable's value from a link 
    var loginBox = $(this).attr('href');

    //Fade in the Popup
    $(loginBox).fadeIn(300);
    
    //Set the center alignment padding + border see css style
    var popMargTop = ($(loginBox).height() + 24) / 2; 
    var popMargLeft = ($(loginBox).width() + 24) / 2; 
    
    $(loginBox).css({ 
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });
    
    // Add the mask to body
    $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(300);
    
    return false;
});
$('a.close, #mask').live('click', function() { 
  $('#mask ,#login_box').fadeOut(300 , function() {
    $('#mask').remove();  
}); 
return false;
});
});
//注册弹出
$(document).ready(function() {
$('a.reg-window').click(function() {
    $('#login_box').fadeOut(100 , function() {
    }); 
    var loginBox = $(this).attr('href');
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
});
$('a.close, #mask').live('click', function() { 
  $('#mask , #reg_box').fadeOut(300 , function() {
    $('#mask').remove();  
}); 
return false;
});
});
//未登录按键
$(document).ready(function() {
$('button[data-action]').click(function() {
if($(this).data('action')=="button_add_info"){
    var loginBox = $(this).attr('href');
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
});
});

function load_folder(){
    document.getElementById("folder").style.display="";
}
function load_type(){
    document.getElementById("sub_type").style.display="";
}
$('body').live('click', function() { 
  $('#search_auto li').fadeOut(100 , function() {
    $('#search_auto li').remove();  
}); 
});