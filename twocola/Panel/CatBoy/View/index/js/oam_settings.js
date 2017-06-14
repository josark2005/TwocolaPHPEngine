$(function(){
  // alert
  if( storger("tce_settings_warning_top") != "0" ){
    $("#tce_settings_warning_top").removeClass("am-hide");
  }
  if( storger("tce_settings_warning_top2") != "0" ){
    $("#tce_settings_warning_top2").removeClass("am-hide");
  }
});
function del_bda(domain,app) {
  var result = change_oam_settings("delete","BDA",domain,app);
  if( result == true){
    $("#OAM_BDA_C_"+app).remove();
  }
}
function del_bdapi(domain,api) {
  var result = change_oam_settings("delete","BDAPI",domain,api);
  if( result == true){
    $("#OAM_BDAPI_C_"+api).remove();
  }
}
function change_bda(domain,app) {
  var new_app = $("#OAM_BDA_app_"+app).val();
  var result = change_oam_settings("modify","BDA",domain,new_app);
  if( result == true){
    $("#OAM_BDA_C_"+app).attr("id","OAM_BDA_C_"+new_app);   // 容器
    $("#OAM_BDA_domain_"+app).attr("id","OAM_BDA_domain_"+new_app);
    $("#OAM_BDA_app_"+app).attr("onchange","javascript:change_bda('"+domain+"','"+new_app+"');");
    $("#OAM_BDA_app_"+app).attr("id","OAM_BDA_app_"+new_app);
    $("#bdabtn_"+app).attr("onclick","javascript:del_bda('"+domain+"','"+new_app+"');");
    $("#bdabtn_"+app).attr("id","bdabtn_"+new_app);
  }else{
    $("#OAM_BDA_app_"+app).val(app);  //恢复设置
    return ;
  }
}
function change_bdapi(domain,api) {
  console.log(domain);
  console.log(api);
  var new_api = $("#OAM_BDAPI_api_"+api).val();
  var result = change_oam_settings("modify","BDAPI",domain,new_api);
  if( result == true){
    $("#OAM_BDAPI_C_"+api).attr("id","OAM_BDAPI_C_"+new_api);   // 容器
    $("#OAM_BDAPI_domain_"+api).attr("id","OAM_BDAPI_domain_"+new_api);
    $("#OAM_BDAPI_api_"+api).attr("onchange","javascript:change_bdapi('"+domain+"','"+new_api+"');");
    $("#OAM_BDAPI_api_"+api).attr("id","OAM_BDAPI_api_"+new_api);
    $("#bdapibtn_"+api).attr("onclick","javascript:del_bdapi('"+domain+"','"+new_api+"');");
    $("#bdapibtn_"+api).attr("id","bdapibtn_"+new_api);
  }else{
    $("#OAM_BDA_app_"+api).val(api);  //恢复设置
    return ;
  }
}
function new_bda(){
  var domain = $("#newbda_domain").val();
  var app = $("#newbda_app").val();
  if( typeof(domain) == "undefined" || domain == "" ){
    alert("请完整填写信息！");
    return ;
  }
  if( typeof(app) == "undefined" || app =="" ){
    alert("请完整填写信息！");
    return ;
  }
  var result = change_oam_settings("add","BDA",domain,app);
  if( result == true){
    location.href = "";
  }
}
function new_bdapi(){
  var domain = $("#newbdapi_domain").val();
  var api = $("#newbdapi_api").val();
  if( typeof(domain) == "undefined" || domain == "" ){
    alert("请完整填写信息！");
    return ;
  }
  if( typeof(api) == "undefined" || api =="" ){
    alert("请完整填写信息！");
    return ;
  }
  var result = change_oam_settings("add","BDAPI",domain,api);
  if( result == true){
    location.href = "";
  }
}
