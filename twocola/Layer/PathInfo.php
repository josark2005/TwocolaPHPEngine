<?php
$_PathInfo = new PathInfo();
define("PATH",$_PathInfo->getPath());
define("APP_SUBDOMAIN",$_PathInfo->getSubdomain());
define("APP_DOMAIN",$_PathInfo->getDomain());
/* 检查是否设置子域名绑定 */
$sdb = C("SUBDOMAIN_BINDING");
if( is_array($sdb) && !empty($sdb) ){
  foreach ($sdb as $key => $value) {
    if($key==APP_SUBDOMAIN && file_exists(APP_PATH."/".$value) ){
      $module = $value;
    }else if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule()) ){
      $module = C("SYSTEM_DEFAULT_MODULE");
    }else{
      $module = $_PathInfo->getModule();
    }
  }
}else{
  if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule())){
    $module = C("SYSTEM_DEFAULT_MODULE");
  }else{
    $module = $_PathInfo->getModule();
  }
}
/* 检查是否设置域名绑定 */
$sdb = C("DOMAIN_BINDING");
if( is_array($sdb) && !empty($sdb) ){
  foreach ($sdb as $key => $value) {
    if($key==APP_DOMAIN && file_exists(APP_PATH."/".$value) ){
      $module = $value;
      break;
    }else if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule()) ){
      $module = C("SYSTEM_DEFAULT_MODULE"); //默认Module
    }else{
      $module = $_PathInfo->getModule();
    }
  }
}else{
  if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule())){
    $module = C("SYSTEM_DEFAULT_MODULE");
  }else{
    $module = $_PathInfo->getModule();
  }
}
/* 定义基础常量 */
define("PI_MODULE",$module);
define("PI_CONTROLLER",$_PathInfo->getController());
define("PI_METHOD",$_PathInfo->getMethod());
// echo PI_MODULE."<br />".PI_CONTROLLER."<br />".PI_METHOD."<br />".APP_SUBDOMAIN;
$conf = TCE\IncReader::IO();
if($conf->ConfigExists("APP_API_PARA")){
  $getName = C("APP_API_PARA");
}else{
  $getName = "app_type";
}
if(APP_SUBDOMAIN=="api" || @$_GET[$getName]=="api"){
  define("APP_TYPE","api"); //api模式
}else{
  define("APP_TYPE","ui");  //ui模式
}
?>
