<?php
$_PathInfo = new PathInfo();
define("PI_BEHAVIOR",$_PathInfo->getBehavior());
define("PI_METHOD",$_PathInfo->getMethod());
define("PATH",$_PathInfo->getPath());
define("APP_SUBDOMAIN",$_PathInfo->getSubdomain());
if(APP_SUBDOMAIN=="api" || @$_GET['app_type']=="api"){
  define("APP_TYPE","api"); //api模式
}else{
  define("APP_TYPE","ui");  //ui模式
}
?>
