function deleter_app(){
  var app = $("#APP").val();
  var result = delete_app(app);
  if( result == true ){
    $("#APP").val("");
    setTimeout(function(){location.href="";},1000);
  }
}
function selected(app){
  $("#APP").val(app);
  alert("您可以点击上方红色删除按钮删除应用"+"【 "+app+" 】。注意：此操作【不可逆】！")
}
function appName(app){
  $("#NAME_"+app).text(get_app_name(app));
}

state = null;

function get_app_name(app){
  var state = null;
  $.ajax({
    url : url_get_app_name,
    type : "post",
    dataType : "json",
    data : {"app":app},
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
        state = data.App.error;
      }
    }
  });
  return state;
}
