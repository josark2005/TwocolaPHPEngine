$(function(){
  var $height = ($("body").height()<$(window).height()) ? 30 : ($("div.container").height()-$("div.am-container.am-g").height()-20)/2;
  $("div.container").css("padding-top",$height);
  //回车登录
  $("#username").keydown(function(e){
    if(e.which==13 && $("#password").val()!=""){
      signin();
    }else if(e.which==13){
      $("#password").focus();
      _alert("请输入密码后再登录");
    }
  });
  $("#password").keydown(function(e){
    if(e.which==13 && $("#password").val()!=""){
      signin();
    }else if(e.which==13){
      $("#password").focus();
      _alert("请输入密码后再登录");
    }
  });
});
function signin(){
  var username ,password;
  username = $("#username").val();
  password = $("#password").val();
  //初步验证
  if(!username.length>=1){
    _alert("您的用户名不正确");
    return false;
  }
  if(password.length<6){
    _alert("您的用户名或密码不正确");
    return false;
  }
  $("#loading").modal('open');
  var ajax = $.ajax({
    url : url_api_signin,
    dataType : "json",
    type : "post",
    data : {"username":username,"password":password},
    timeout : 10000,
    complete : function(XMLHTTPRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _alert("连接服务器超时,请稍候再试。");
        return false;
      }
    },
    success : function(data){
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
        if(app_errno="A_1x07"){
          _alert("用户名与密码不匹配。");
          return false;
        }else{
          _alert("未知错误："+app_errno);
          return false;
        }
      }else if(app_status==1){
        _alert("登录成功，正在为您跳转！");
        setTimeout(function(){location.href=url_signin},2000);
        return true;
      }
    }
  });
}
function _alert(content){
  $("#alert-content").text(content);
  $("#alert").modal("open");
}
