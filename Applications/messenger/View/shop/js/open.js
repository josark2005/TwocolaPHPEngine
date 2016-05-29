function verfiy_email(){
  var btn_text = $("#btn_email").text();
  var $btn = $("#btn_email");
  var email = $("#email").val();
  var $interval;
  match = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
  if(!match.test(email)){
    _alert("您的邮箱格式有误，请检查您的邮箱是否输入错误。（暂不支持64位以上的邮箱帐号）");
    return false;
  }
  $("#loading").modal('open');
  $btn.attr("disabled","disabled"); //禁用按钮
  var $btn_time = 60; //按钮禁用时间（秒）
  $interval = setInterval(function(){
    $btn_time = parseInt($btn_time)-1;
    $btn.text("("+$btn_time+") 秒后重新发送");
    if($btn_time<=0){
      _btnReset($btn,btn_text,$interval);
    }
  },1000);
  $.ajax({
    url: url_verify_email,
    type: "post",
    dataType: "json",
    data: {"email":email},
    timeout: 10000,
    complete: function(XMLHttpRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _btnReset($btn,btn_text,$interval);
        _alert("连接服务器超时,请稍候再试。");
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
        _btnReset($btn,btn_text,$interval);
        _alert("系统暂停访问："+system_message);
        return false;
      }else if(app_status==0){
        $("#loading").modal('close');
        if(app_errno=="A_0x00"){
          _btnReset($btn,btn_text,$interval);
          _alert("请重新登录后再试");
          return false;
        }
        if(app_errno=="A_2x00"){
          _btnReset($btn,btn_text,$interval);
          _alert("未知错误");
          return false;
        }
        if(app_errno=="A_2x01"){
          _btnReset($btn,btn_text,$interval);
          _alert("邮箱不正确。");
          return false;
        }
        if(app_errno=="A_2x02"){
          _btnReset($btn,btn_text,$interval);
          _alert("未知错误");
          return false;
        }
        if(app_errno=="A_2x03"){
          _btnReset($btn,btn_text,$interval);
          _alert("邮件发送失败。");
          return false;
        }
        if(app_errno=="A_2x04"){
          _btnReset($btn,btn_text,$interval);
          $btn.attr("disabled","disabled"); //禁用按钮
          _alert("你现在暂时不能发送邮件。");
          var $btn_time = app_error; //按钮禁用时间（秒）
          $interval = setInterval(function(){
            $btn_time = parseInt($btn_time)-1;
            $btn.text("("+$btn_time+") 秒后重新发送");
            if($btn_time<=0){
              _btnReset($btn,btn_text,$interval);
            }
          },1000);
          return false;
        }
      }else if(app_status==1){
        $("#btn_apply").removeClass("am-hide");
        $("#loading").modal('close');
        _alert("发送成功！请前往邮箱查收邮件，邮件可能在垃圾箱箱里。");
        return true;
      }
    }
  });
}
function apply(){
  var username,email,shopname,shopintro,verify_email;
  username = $("#username").val();
  email = $("#email").val();
  shopname = $("#shopname").val();
  shopintro = $("#shopintro").val();
  verify_email = $("#verify_email").val();
  if(username.length<5){
    _alert("用户名不合法，请重新登录！");
    return false;
  }
  if(email.length<5){
    _alert("邮箱不合法，请输入正确的邮箱，稍候我们会对您的邮箱进行验证！");
    return false;
  }
  if(shopname.length<2){
    _alert("店铺名称必须大于等于2个中文！");
    return false;
  }
  if(shopintro.length<10){
    _alert("店铺简介必须10个字以上！");
    return false;
  }
  if(verify_email.length!=6){
    _alert("验证码不正确");
    return false;
  }
  $("#loading").modal('open');
  $.ajax({
    url: url_shop_open,
    type: "post",
    dataType: "json",
    data: {"shopname":shopname,"shopintro":shopintro,"verify_email":verify_email},
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
          _btnReset($btn,btn_text,$interval);
          _alert("请重新登录后再试");
          return false;
        }
        if(app_errno=="A_2x00"){
          _alert("未知错误");
          return false;
        }
        if(app_errno=="A_2x02"){
          _alert("未知错误");
          return false;
        }
        if(app_errno=="A_2x05"){
          $("#shopname").val("");
          $("#verify_email").val("");
          _alert("该店铺名称已经被注册了，请重新填写店铺名称");
          return false;
        }
        if(app_errno=="A_2x06"){
          $("#verify_email").val("");
          _alert("验证码错误");
          return false;
        }
        if(app_errno=="A_2x07"){
          _alert("您已经拥有一个店铺了！如出现问题请联系我们。");
          return false;
        }
      }else if(app_status==1){
        $("#loading").modal('close');
        $("#table").addClass("am-hide");
        $("#success").removeClass("am-hide");
        _alert("申请成功！请等待审核！");
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
