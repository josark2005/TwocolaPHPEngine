<?php
/*
** TCPHPEngine模板引擎驱动
** DevStudio:Twocola
** Authorize:Twocola.com
*/
if(file_exists(APP_PATH."/Controller/Displayer/".PI_BEHAVIOR."Displayer.class.php")&&file_exists(APP_PATH."/Controller/Behavior/".PI_BEHAVIOR."Behavior.class.php")){
  //行为存在
  require_once(APP_PATH."/Controller/Behavior/".PI_BEHAVIOR."Behavior.class.php");
  require_once(APP_PATH."/Controller/Displayer/".PI_BEHAVIOR."Displayer.class.php");
  $ClassName = "Controller\\".PI_BEHAVIOR."Displayer";
  $method = PI_METHOD;
  $template = new $ClassName();
  if(method_exists($template,$method)){
    $template->$method();
  }else{
    $template->show("public/html/404");
  }
}else{
  //行为非法
  $template = new TCE\Template();
  $template->show("public/html/404");
}
?>
