$(function(){
  // 设置初始值
  var _app_suffix = $("#APP_SUFFIX").val();
  // alert
  if( storger("tce_settings_warning_top") != "0" ){
    $("#tce_settings_warning_top").removeClass("am-hide");
  }
  // 初始化
  $('#APP_SUFFIX_SAFE').bootstrapSwitch();
  // 监听
  $("#APP_SUFFIX").on('keyup' ,function(e){
    var value = $("#APP_SUFFIX").val();
    var result = change_tce_settings("APP_SUFFIX",value);
    if( result == false){
      $("#APP_SUFFIX").val(_app_suffix);
    }
  });

  $('#APP_SUFFIX_SAFE').on('switchChange.bootstrapSwitch', function(event, state) {
    var result = change_tce_settings("APP_SUFFIX_SAFE",state);
    if(result != true){
      alert("1");
      $('#APP_SUFFIX_SAFE').bootstrapSwitch('toggleState', true);
    }
    return ;
  });

});
