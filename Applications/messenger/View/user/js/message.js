function _alert(content){
  $("#alert-content").text(content);
  $("#alert").modal("open");
}
function message(id){
  $("#loading").modal('open');
  var ajax = $.ajax({
    url: url_message,
    dataType: "json",
    type: "post",
    data: {"mid":id},
    timeout: 10000,
    complete : function(XMLHTTPRequest,status){
      if(status=="timeout"){
        $("#loading").modal('close');
        _alert("连接服务器超时,请稍候再试。");
      }
    },
    success : function(data){
      $("#loading").modal('close');
      var system_status = data.System.status;
      var system_message = data.System.message;
      var app_status = data.App.status;
      var app_errno = data.App.errno;
      var app_error = data.App.error;
      if(system_status==0){
        _alert("系统暂停访问："+system_message);
        return false;
      }else if(app_status==0){
        _alert(app_error);
        return false;
      }else if(app_status==1){
        showMessage(id,app_error.title,app_error.article);
        return true;
      }
    }
  });
}
function showMessage(id,title,article){
  $("span.am-badge-danger").remove("#"+id);
  $("a.message-unread#"+id).removeClass("message-unread");
  $("#m-title").text(title);
  $("#m-article").html(article);
  $("#alert-message").modal("open");
}
