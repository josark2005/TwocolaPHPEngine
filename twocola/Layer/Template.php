<?php
/*模板引擎驱动*/
if(file_exists(EZ_PATH."/Displayer/".PI_BEHAVIOR."Displayer.class.php")&&file_exists(EZ_PATH."/Behavior/".PI_BEHAVIOR."Behavior.class.php")){
  //行为存在
  require_once(EZ_PATH."/Behavior/".PI_BEHAVIOR."Behavior.class.php");
  require_once(EZ_PATH."/Displayer/".PI_BEHAVIOR."Displayer.class.php");
  $ClassName = PI_BEHAVIOR."Displayer";
  $method = PI_METHOD;
  $template = new $ClassName();
  if(method_exists($template,$method)){
    $template->$method();
  }else{
    $template->show404();
  }
}else{
  //行为非法
  $template = new Template(); //404
}
?>
