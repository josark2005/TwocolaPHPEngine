$(function(){
  // 导航显示
  $("li#"+_controller+"-"+_method).addClass("am-active");
  $("li#"+_controller+"-"+_method+">a").attr("href","javascript:;");
  $("button#"+_controller+"-"+_method).text("» "+$("button#"+_controller+"-"+_method).text());
  $("button#"+_controller+"-"+_method).attr("onclick","javascript:;");
  $("button#"+_controller+"-"+_method).removeClass("am-btn-primary");
  $("button#"+_controller+"-"+_method).addClass("am-btn-success");
});
