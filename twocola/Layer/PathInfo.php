<?php
$_PathInfo = new PathInfo();
if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule())){
  define("PI_MODULE",C("SYSTEM_DEFAULT_MODULE"));
}else{
  define("PI_MODULE",$_PathInfo->getModule());
}
define("PI_CONTROLLER",$_PathInfo->getController());
define("PI_METHOD",$_PathInfo->getMethod());
define("PATH",$_PathInfo->getPath());
define("APP_SUBDOMAIN",$_PathInfo->getSubdomain());
// echo PI_MODULE."<br />".PI_CONTROLLER."<br />".PI_METHOD."<br />".APP_SUBDOMAIN;
$conf = new TCE\IncReader;
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
