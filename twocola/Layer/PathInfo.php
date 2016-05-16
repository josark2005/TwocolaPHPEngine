<?php
$_PathInfo = new PathInfo();
if(APP_SUBDOMAIN=="api" || @$_GET['app_type']=="api"){
  define("APP_TYPE","api"); //api模式
}else{
  define("APP_TYPE","ui");  //ui模式
}
?>
