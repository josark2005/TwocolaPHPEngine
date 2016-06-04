<?php
/*
** TCPHPEngine模板引擎驱动
** DevStudio:Twocola
** Authorize:Twocola.com
** Version:1.2 beta
*/
if(C("APP_RESPONSE")==false){
  $template = new TCE\Template();
  $template->showContent(getPresetTpl("error_noresponse"));
  exit();
}
if(file_exists(APP_PATH."/".PI_MODULE."/Controller/Displayer/".PI_CONTROLLER."Displayer.class.php")&&
  file_exists(APP_PATH."/".PI_MODULE."/Controller/Behavior/".PI_CONTROLLER."Behavior.class.php")&&
  file_exists(APP_PATH."/".PI_MODULE."/Controller/Common/BehaviorCommon.class.php")){
  //行为存在
  require_once(APP_PATH."/".PI_MODULE."/Controller/Common/BehaviorCommon.class.php"); //公共函数类
  require_once(APP_PATH."/".PI_MODULE."/Controller/Behavior/".PI_CONTROLLER."Behavior.class.php");
  require_once(APP_PATH."/".PI_MODULE."/Controller/Displayer/".PI_CONTROLLER."Displayer.class.php");
  $ClassName = "Controller\\".PI_CONTROLLER."Displayer";
  $method = PI_METHOD;
  $template = new $ClassName();
  if(method_exists($template,$method)){
    $template->$method();
  }else{
    $template->show_t("页面找不到了","public/html/404");
  }
}else{
  //行为非法
  $template = new TCE\Template();
  $template->show_t("页面找不到了","public/html/404");
}
?>
