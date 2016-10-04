<?php
if(APP_CONFIG_MODE == "include"){
  if(!file_exists(APP_PATH."/".PI_MODULE."/config.inc.php")){
    //配置文件不存在
    if(defined("ENG_OUTSIDE_CONFIG") && constant("ENG_OUTSIDE_CONFIG")===TRUE){
      E("配置文件不存在，请检查应用".PI_MODULE."根目录下的config.inc.php文件是否存在！");
    }
  }else{
    //配置文件存在
    $reader = TCE\IncReader::IO();
    $reader->GetConfig(APP_PATH."/".PI_MODULE."/config.inc.php");
  }
}
?>
