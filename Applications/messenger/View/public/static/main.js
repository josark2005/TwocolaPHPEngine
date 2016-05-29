$(function(){
  bodyAdjustment();
});

function logout(url_out){
  $.ajax({
    url:url_out,
    complete:function(){
      location.href="";
    }
  });
}

function bodyAdjustment(){
  if($("body").height()<$(window).height()){
    $("div.container").height($(window).height()-$("header#topbar").height()-$("div.footer-container").height());
  }
}
