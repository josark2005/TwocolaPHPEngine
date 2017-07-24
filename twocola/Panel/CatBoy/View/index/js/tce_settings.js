$(function(){
  // 设置初始值
  var _app_suffix = $("#APP_SUFFIX").val();
  var _app_default = $("#APP_DEFAULT").val();
  var _api_protal_key = $("#API_PORTAL_KEY").val();
  var _api_protal_value = $("#API_PORTAL_VALUE").val();
  var _panel_path = $("#PANEL_PATH").val();
  var _panel_name = $("#PANEL_NAME").val();
  var _panel_portal_key = $("#PANEL_PORTAL_KEY").val();
  var _panel_portal_value = $("#PANEL_PORTAL_VALUE").val();
  var _tpl_error = $("#TPL-Error").val();
  var _tpl_noresponse = $("#TPL-NoResponse").val();
  var _tpl_appnotfound = $("#TPL-AppNotFound").val();
  var _tpl_pagenotfound = $("#TPL-PageNotFound").val();
  // alert
  if( storger("tce_settings_warning_top") != "0" ){
    $("#tce_settings_warning_top").removeClass("am-hide");
  }
  if( storger("tce_settings_warning_top2") != "0" ){
    $("#tce_settings_warning_top2").removeClass("am-hide");
  }
  if( storger("tce_settings_warning") != "0" ){
    $("#tce_settings_warning").removeClass("am-hide");
  }
  if( storger("tce_settings_warning2") != "0" ){
    $("#tce_settings_warning2").removeClass("am-hide");
  }
  if( storger("tce_settings_warning3") != "0" ){
    $("#tce_settings_warning3").removeClass("am-hide");
  }
  // 监听
  $("#APP_SUFFIX").on('keyup' ,function(e){
    var value = $("#APP_SUFFIX").val();
    var result = change_tce_settings("APP_SUFFIX",value);
    if( result == false){
      $("#APP_SUFFIX").val(_app_suffix);
    }else{
      _app_suffix = value;
    }
  });

  $('#APP_SUFFIX_SAFE').on('switchChange.bootstrapSwitch', function(event, state) {
    var result = change_tce_settings("APP_SUFFIX_SAFE",state);
    if(result != true){
      $('#APP_SUFFIX_SAFE').bootstrapSwitch('toggleState', true);
    }
    return ;
  });

  $("#APP_DEFAULT").on('keyup' ,function(e){
    var value = $("#APP_DEFAULT").val();
    var result = change_tce_settings("APP_DEFAULT",value);
    if( result == false){
      $("#APP_DEFAULT").val(_app_deafult);
    }else{
      _app_deafult = value;
    }
  });

  $('#API_PORTAL').on('switchChange.bootstrapSwitch', function(event, state) {
    if( state == true ){
      state = 1;
    }else{
      state = 0;
    }
    var result = change_tce_settings("API_PORTAL",state);
    if(result != true){
      $('#API_PORTAL').bootstrapSwitch('toggleState', true);
    }
    return ;
  });

  $("#API_PORTAL_KEY").on('change' ,function(e){
    var value = $("#API_PORTAL_KEY").val();
    var result = change_tce_settings("API_PORTAL_KEY",value);
    if( result == false){
      $("#API_PORTAL_KEY").val(_api_protal_key);
    }else{
      _api_protal_key = value;
      location.href="";   // 刷新页面
    }
  });

  $("#API_PORTAL_VALUE").on('change' ,function(e){
    var value = $("#API_PORTAL_VALUE").val();
    var result = change_tce_settings("API_PORTAL_VALUE",value);
    if( result == false){
      $("#API_PORTAL_VALUE").val(_api_protal_value);
    }else{
      _api_protal_value = value;
      location.href="";   // 刷新页面
    }
  });

  $('#PANEL').on('switchChange.bootstrapSwitch', function(event, state) {
    var result = change_tce_settings("PANEL",state);
    if(result != true){
      $('#PANEL').bootstrapSwitch('toggleState', true);
    }
    return ;
  });

  $("#PANEL_PATH").on('change' ,function(e){
    var value = $("#PANEL_PATH").val();
    if( value == "" ){
      value = "false";
    }
    var result = change_tce_settings("PANEL_PATH",value);
    if( result == false){
      $("#PANEL_PATH").val(_panel_path);
    }else{
      _panel_path = value;
    }
  });

  $("#PANEL_NAME").on('change' ,function(e){
    var value = $("#PANEL_NAME").val();
    var result = change_tce_settings("PANEL_NAME",value);
    if( result == false){
      $("#PANEL_NAME").val(_panel_name);
    }else{
      _panel_name = value;
    }
  });

  $('#PANEL_PORTAL').on('switchChange.bootstrapSwitch', function(event, state) {
    if( state == true){
      state = 1;
    }else{
      state = 2;
    }
    var result = change_tce_settings("PANEL_PORTAL",state);
    if(result != true){
      $('#PANEL_PORTAL').bootstrapSwitch('toggleState', true);
    }else if(state == 1){
      location.href = "?"+$("#PANEL_PORTAL_KEY").val()+"="+$("#PANEL_PORTAL_VALUE").val();
    }else{
      location.href = url_this;
    }
    return ;
  });

  $("#PANEL_PORTAL_KEY").on('change' ,function(e){
    var value = $("#PANEL_PORTAL_KEY").val();
    var result = change_tce_settings("PANEL_PORTAL_KEY",value);
    if( result == false){
      $("#PANEL_PORTAL_KEY").val(_panel_portal_key);
    }else{
      _panel_portal_key = value;
    }
  });

  $("#PANEL_PORTAL_VALUE").on('change' ,function(e){
    var value = $("#PANEL_PORTAL_VALUE").val();
    var result = change_tce_settings("PANEL_PORTAL_VALUE",value);
    if( result == false){
      $("#PANEL_PORTAL_VALUE").val(_panel_portal_value);
    }else{
      _panel_portal_value = value;
    }
  });

  $("#TPL-Error").on('change' ,function(e){
    var value = $("#TPL-Error").val();
    var result = change_tce_settings("TPL-Error",value);
    if( result == false){
      $("#TPL-Error").val(_tpl_error);
    }else{
      _tpl_error = value;
    }
  });

  $("#TPL-NoResponse").on('change' ,function(e){
    var value = $("#TPL-NoResponse").val();
    var result = change_tce_settings("TPL-NoResponse",value);
    if( result == false){
      $("#TPL-NoResponse").val(_tpl_noresponse);
    }else{
      _tpl_noresponse = value;
    }
  });

  $("#TPL-AppNotFound").on('change' ,function(e){
    var value = $("#TPL-AppNotFound").val();
    var result = change_tce_settings("TPL-AppNotFound",value);
    if( result == false){
      $("#TPL-AppNotFound").val(_tpl_appnotfound);
    }else{
      _tpl_appnotfound = value;
    }
  });

  $("#TPL-PageNotFound").on('change' ,function(e){
    var value = $("#TPL-PageNotFound").val();
    var result = change_tce_settings("TPL-PageNotFound",value);
    if( result == false){
      $("#TPL-PageNotFound").val(_tpl_pagenotfound);
    }else{
      _tpl_pagenotfound = value;
    }
  });

});
