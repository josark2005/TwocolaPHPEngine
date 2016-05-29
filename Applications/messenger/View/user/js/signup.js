$(function(){
  //回车注册
  $("#username").keydown(function(e){
    if(e.which==13){
      signup();
    }
  });
  $("#password").keydown(function(e){
    if(e.which==13){
      signup();
    }
  });
  $("#repassword").keydown(function(e){
    if(e.which==13){
      signup();
    }
  });
  $("#email").keydown(function(e){
    if(e.which==13){
      signup();
    }
  });
});

function f_username(){
  _tips("用户名由字母开头，6-16位英文或数字或下划线组成（不可包含中文），设置后修改需要一定积分。");
}
function f_password(){
  _tips("为了您能正常登录，请勿随意设置密码。");
}
function f_email(){
  _tips("为保证您能及时收到通知，我们要求您填写您常用的电子邮箱地址。");
}
function _tips(content,color){
  if(!color){
    color="#333";
  }
  $("#tips").text(content).attr("color",color);
}
function signup(){
  var username,password,repassword,email;
  username = $("#username").val();
  password = $("#password").val();
  repassword = $("#repassword").val();
  email = $("#email").val();
  var match = new RegExp("^[a-z][a-zA-Z0-9_]{5,15}$");
  if(!match.test(username)){
    _alert("用户名必须由字母开头，6-16位，不可包含中文以及除下划线以外的特殊字符。");
    $("#username").focus();
    return false;
  }
  match = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
  if(!match.test(email)){
    _alert("您的邮箱格式有误，请检查您的邮箱是否输入错误。请慎重填写邮箱，我们将对您的邮箱进行邮件验证。（暂不支持64位以上的邮箱帐号）");
    $("#email").focus();
    return false;
  }
  match = new RegExp("^.{6,16}$");
  if(!match.test(password)){
    _alert("密码必须是6到16位的。");
    $("#password").focus();
    return false;
  }
  if(password!=repassword){
    _alert("您两次输入的密码不一致。");
    $("#repassword").focus();
    return false;
  }
  $("#loading").modal('open');
  $.ajax({
    url:url_signup,
    type:"post",
    dataType:"json",
    data:{"username":username,"email":email,"password":password,"repassword":repassword}, //Email传递被删除
    timeout:10000,
    complete:function(XMLHTTPRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _alert("连接服务器超时,请稍候再试。");
        return false;
      }
    },
    success:function(data){
      $("#loading").modal('close');
      var system_status = data.System.status;
      var system_message = data.System.message;
      var app_status = data.App.status;
      var app_errno = data.App.errno;
      if(system_status==0){
        _alert("系统暂停访问："+system_message);
        return false;
      }else if(app_status==0){
        if(app_errno=="A_0x00"){
          _alert("用户信息错误");
          return false;
        }
        if(app_errno=="A_1x01"){
          _alert("两次密码不一致");
          return false;
        }else if(app_errno=="A_1x02"){
          _alert("用户名不合法");
          return false;
        }else if(app_errno=="A_1x03"){
          _alert("密码不合法");
          return false;
        }else if(app_errno=="A_1x04"){
          _alert("邮箱不合法");
          return false;
        }else if(app_errno=="A_1x05"){
          _alert("用户名已经存在");
          return false;
        }else if(app_errno=="A_1x06"){
          _alert("发生未知错误：A_1x06");
          return false;
        }else if(app_errno=="A_1x12"){
          _alert("邮箱已经存在，请您更换一个邮箱");
          return false;
        }else{
          _alert("发生未知错误："+app_errno);
          return false;
        }
      }else if(app_status==1){
        _alert("注册成功，正在为您跳转！");
        setTimeout(function(){location.href=url_signup_email},3000);
        return false;
      }
    }
  });
}
function _alert(content){
  $("#alert-content").text(content);
  $("#alert").modal("open");
}
