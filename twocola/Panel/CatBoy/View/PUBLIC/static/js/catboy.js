$(function(){
  // 导航显示
  $("li#"+_controller+"-"+_method).addClass("am-active");
  $("li#"+_controller+"-"+_method+">a").attr("href","javascript:;");
  $("button#"+_controller+"-"+_method).text("» "+$("button#"+_controller+"-"+_method).text());
  $("button#"+_controller+"-"+_method).attr("onclick","javascript:;");
  $("button#"+_controller+"-"+_method).removeClass("am-btn-primary");
  $("button#"+_controller+"-"+_method).addClass("am-btn-success");
});

function storger(name,value=null){
  if( value == null){
    return $.AMUI.store.get(name);
  }else{
    $.AMUI.store.set(name,value);
  }
}

state = null;
function change_tce_settings(name,value){
  var state = null;
  $.ajax({
    url : url_change_tce_settings,
    type : "post",
    dataType : "json",
    data : {"name":name,"value":value},
    timeout : 20000,
    async : false,
    complete : function(XMLHTTPRequest,status){
      if(status=="timeout"){
        alert("连接超时,请稍候再试。");
        state = false;
      }
    },
    success : function(data){
      var system_status = data.System.status;
      var system_message = data.System.message;
      var app_status = data.App.status;
      var app_errno = data.App.errno;
      var app_error = data.App.error;
      if(system_status==0){
        alert("系统暂停访问："+system_message);
        state = false;
      }else if(app_status==0){
        alert("("+data.App.errno+")发生错误："+data.App.error);
        state = false;
      }else{
        state = true;
      }
    }
  });
  return state;
}
