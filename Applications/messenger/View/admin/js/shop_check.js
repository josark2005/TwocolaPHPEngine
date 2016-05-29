function refuse_reason(id){
  $("#refuse_shop").modal('open');
  $("#shop_id").attr("id",id);
}
function refuse(id){
  $("#loading").modal("open");
  _shop_auth(id,"refuse");
}
function ratify(id){
  $("#loading").modal("open");
  _shop_auth(id,"ratify");
}

function _shop_auth(id,type){
  $.ajax({
    url: url_check,
    type:"post",
    dataType:"json",
    data:{"type":type,"shopid":id,"reason":$("input#refuse_reason").val()},
    timeout:10000,
    complete : function(XMLHTTPRequest,status){
      if(status=="timeout"){
        $("#loading").modal("close");
        _alert("连接服务器超时,请稍候再试。");
      }
    },
    success : function(data){
      $("#loading").modal("close");
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
        _alert("操作成功！请等待刷新后再操作。");
        setTimeout(function(){location.href=""},2000);
        return true;
      }
    }
  });
}

function _alert(content){
  $("#alert-content").text(content);
  $("#alert").modal("open");
}
