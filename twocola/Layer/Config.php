<?php
/* 配置文件驱动 */
if(!defined("APP_CONFIG_MODE")){
  define("APP_CONFIG_MODE","default");  //设置默认配置方式为default
}
/* include配置方式 */
if(APP_CONFIG_MODE == "include"){
  if(!file_exists("./config.inc.php")){
    //配置文件不存在
    E("配置文件不存在，请检查根目录下的config.inc.php文件是否存在！");
  }else{
    //配置文件存在
    $reader = new IncReader();
    $reader->GetConfig();
  }
}
/* 常规常量量检查（APP_开头的常量） */
if(defined("SYSTEM_CONSTANT") && SYSTEM_CONSTANT===true){
  /* APP_前缀常量检查 */
  $content = "DEBUG|TPL|TPL_FIX|NAME|DB_TYPE|DB_HOST|DB_PORT|DB_NAME|DB_USERNAME|DB_PASSWORD";
  $array = explode("|",$content);
  foreach($array as $name){
    $name = "APP_".$name;
    if(!defined($name)){
      //常量不存在
      E("常量 {$name}不存在，请检查配置文件，或手动定义！");
    }
  }
  /* 无前缀常量检查 */
  $content = "EMAIL_HOST|EMAIL_CHARSET|EMAIL_ADDRESS|EMAIL_PASSWORD";
  $array = explode("|",$content);
  foreach($array as $name){
    if(!defined($name)){
      //常量不存在
      E("常量 {$name}不存在，请检查配置文件，或手动定义！");
    }
  }
}
?>
