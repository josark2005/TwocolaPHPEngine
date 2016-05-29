function signup_email(){
  var btn_text = $("#btn_send").text();
  var email = $("#email").val();
  //验证邮箱
  match = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
  if(!match.test(email)){
    _alert("您的邮箱格式有误，请检查您的邮箱是否输入错误。（暂不支持64位以上的邮箱帐号）");
    return false;
  }
  $("#loading").modal('open');
  var $btn = $("#btn_send");
  $btn.attr("disabled","disabled"); //禁用按钮
  var $btn_time = 60; //按钮禁用时间（秒）
  var $interval = setInterval(function(){
    $btn_time = parseInt($btn_time)-1;
    $btn.text("("+$btn_time+") 秒后重新发送");
    if($btn_time<=0){
      _btnReset($btn,btn_text,$interval);
    }
  },1000);
  $.ajax({
    url : url_api_signup_email,
    type : "post",
    dataType : "json",
    data :{"email":email},
    timeout :　10000,
    complete : function(XMLHttpRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _alert("连接服务器超时,请稍候再试。");
        return false;
      }
    },
    success : function(data){
      var system_status = data.System.status;
      var system_message = data.System.message;
      var app_status = data.App.status;
      var app_errno = data.App.errno;
      var app_error = data.App.error;
      if(system_status==0){
        $("#loading").modal('close');
        _btnReset($btn,btn_text,$interval);
        _alert("系统暂停访问："+system_message);
        return false;
      }else if(app_status==0){
        $("#loading").modal('close');
        if(app_errno=="A_0x00"){
          _btnReset($btn,btn_text,$interval);
          _alert("用户信息错误");
          return false;
        }
        if(app_errno=="A_1x08"){
          _btnReset($btn,btn_text,$interval);
          _alert("您输入的邮箱可能是错误的，请更正");
        }else if(app_errno=="A_1x11"){
          _btnReset($btn,btn_text,$interval);
          $btn.attr("disabled","disabled"); //禁用按钮
          _alert("您需要稍等片刻才能重新发送");
          var $btn_time = app_error; //按钮禁用时间（秒）
          $interval = setInterval(function(){
            $btn_time = parseInt($btn_time)-1;
            $btn.text("("+$btn_time+") 秒后重新发送");
            if($btn_time<=0){
              _btnReset($btn,btn_text,$interval);
            }
          },1000);
          return false;
        }else if(app_errno=="A_1x13"){
          _btnReset($btn,btn_text,$interval);
          _alert("邮件发送失败，请稍候再试");
        }else if(app_errno=="A_1x14"){
          _btnReset($btn,btn_text,$interval);
          _alert("发生未知错误："+app_errno);
        }else if(app_errno=="A_1x15"){
          _btnReset($btn,btn_text,$interval);
          _alert("发生未知错误："+app_errno);
        }
        return false;
      }else if(app_status==1){
        $("#btn_verify").removeClass("am-hide");
        $("#loading").modal('close');
        _alert("发送成功！请前往邮箱查收邮件，邮件可能在垃圾箱箱里。");
        return true;
      }
    }
  });
}

function signup_apply(){
  var verify_email = $("#verify_email").val();
  if(verify_email.length!=6){
    _alert("验证码不正确");
    return false;
  }
  $("#loading").modal('open');
  $.ajax({
    url: url_api_signup_email_apply,
    type: "post",
    dataType: "json",
    data: {"verify_email":verify_email},
    timeout: 10000,
    complete: function(XMLHttpRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _alert("连接服务器超时,请稍候再试。");
        _btnReset($btn,btn_text,$interval);
        return false;
      }
    },
    success: function(data){
      var system_status = data.System.status;
      var system_message = data.System.message;
      var app_status = data.App.status;
      var app_errno = data.App.errno;
      var app_error = data.App.error;
      if(system_status==0){
        $("#loading").modal('close');
        _alert("系统暂停访问："+system_message);
        return false;
      }else if(app_status==0){
        $("#loading").modal('close');
        if(app_errno=="A_0x00"){
          _alert("用户信息错误");
          return false;
        }
        if(app_errno=="A_1x16"){
          _alert("您输入的验证码是错误的，请核对");
        }else{
          _alert("发生未知错误："+app_errno);
        }
        return false;
      }else if(app_status==1){
        location.href=url_jump;
        return true;
      }
    }
  });
}

function _btnReset($btn,btn_text,$interval){
  $btn.removeAttr("disabled");
  $btn.text(btn_text);
  clearInterval($interval); //清除interval
}
function _alert(content){
  $("#alert-content").text(content);
  $("#alert").modal("open");
}
