$(document).ready(function() {
    $("#user_regname").keyup(function (e) {
        var username = $(this).val();
        if(username.length>=1){
            $.post('checkUsername.php', {'username':username}, function(data) {
            $("#user_result").html(data);
            });
        }  
    }); 
});
function InputCheck(regForm)
{
  if (regForm.user_name.value == "")
  {
    alert("用户名不可为空!");
    regForm.user_name.focus();
    return (false);
  }
  var reg = new RegExp("[\u4e00-\u9fa5_a-zA-Z0-9_]{1,10}");
  if(!reg.test(regForm.user_name.value)){
    alert("抱歉用户名应为1-10字符的汉字、数字、英文及_");
    regForm.user_name.focus();
    return (false);
  }
  if (regForm.user_passwd.value == "")
  {
    alert("必须设定登录密码!");
    regForm.user_passwd.focus();
    return (false);
  }
  if (regForm.user_passwd.value.length<6)
  {
    alert("抱歉密码需要大于6位");
    regForm.user_passwd.focus();
    return (false);
  }
  if (regForm.user_repasswd.value != regForm.user_passwd.value)
  {
    alert("两次密码不一致!");
    regForm.user_repasswd.focus();
    return (false);
  }
  if (regForm.user_email.value == "")
  {
    alert("电子邮箱不可为空!");
    regForm.user_email.focus();
    return (false);
  }
  var atpos=regForm.user_email.value.indexOf("@");
  var dotpos=regForm.user_email.value.indexOf(".");
  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=regForm.user_email.value.length)
  {
    alert("电子邮箱格式不可用");
    regForm.user_email.focus();
    return (false);
  }
  return true;
}