<?php
/* 配置文件驱动 */
if(!defined("APP_CONFIG_MODE")){
  define("APP_CONFIG_MODE","include");  //设置默认配置方式为default
}
$conf = TCE\IncReader::IO();  //初始化配置操作类
/* include配置方式 */
if(APP_CONFIG_MODE == "include"){
  if(!file_exists("./config.inc.php")){
    //配置文件不存在
    if(defined("ENG_OUTSIDE_CONFIG") && constant("ENG_OUTSIDE_CONFIG")===TRUE){
      E("配置文件不存在，请检查入口文件目录下的config.inc.php文件是否存在！");
    }
  }else{
    //配置文件存在则读取配置
    $conf->GetConfig();
  }
}
/* 常规常量量检查 */
if($conf->ReadPointedConfig("SYSTEM_CONSTANT")==true){
  $content = "APP_TPL_FIX";
  $array = explode("|",$content);
  foreach($array as $name){
    if(!$conf->ConfigExists($name)){
      switch ($name) {
        case 'APP_TPL_FIX':
          C("APP_TPL_FIX",".tpl");
          break;
        default:
          //常量不存在
          E("配置 {$name}不存在，请检查配置文件，或手动定义！");
          break;
      }
    }
  }
}
?>
