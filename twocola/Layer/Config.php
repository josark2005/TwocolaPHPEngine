<?php
/* 配置文件驱动 */
if(!defined("APP_CONFIG_MODE")){
  define("APP_CONFIG_MODE","include");  //设置默认配置方式为default
}
/* include配置方式 */
if(APP_CONFIG_MODE == "include"){
  if(!file_exists("./config.inc.php")){
    //配置文件不存在
    E("配置文件不存在，请检查根目录下的config.inc.php文件是否存在！");
  }else{
    //配置文件存在
    $conf = TCE\IncReader::IO();
    $conf->GetConfig();
  }
}
/* 常规常量量检查 */
if($conf->ReadPointedConfig("SYSTEM_CONSTANT")==true){
  $content = "TPL_FIX";
  $array = explode("|",$content);
  foreach($array as $name){
    if(!$conf->ConfigExists($name)){
      //常量不存在
      E("配置 {$name}不存在，请检查配置文件，或手动定义！");
    }
  }
}
?>
