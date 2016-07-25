<?php
$_PathInfo = new PathInfo();
define("PATH",$_PathInfo->getPath());
define("APP_SUBDOMAIN",$_PathInfo->getSubdomain());
$sdb = C("SUBDOMAIN_BINDING");
if(is_array($sdb)){
  foreach ($sdb as $key => $value) {
    if($key==APP_SUBDOMAIN && file_exists(APP_PATH."/".$key) ){
      define("PI_MODULE",$key);
    }else if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule()) ){
      define("PI_MODULE",C("SYSTEM_DEFAULT_MODULE"));
    }else{
      define("PI_MODULE",$_PathInfo->getModule());
    }
  }
}else{
  if($_PathInfo->getModule()=="" || !file_exists(APP_PATH."/".$_PathInfo->getModule())){
    define("PI_MODULE",C("SYSTEM_DEFAULT_MODULE"));
  }else{
    define("PI_MODULE",$_PathInfo->getModule());
  }
}
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
