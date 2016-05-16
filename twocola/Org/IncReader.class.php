<?php
// $config = $config->ReadConfig();  //读取全部配置
// $config = $config->ReadPointedConfig("DB_HOST"); //读取单个配置
class IncReader {
  //读取配置
  public function ReadConfig($file="./config.inc.php"){
    include($file);
    return $config;
  }
  //定义配置常量
  public function GetConfig($file="./config.inc.php"){
    require($file);
    foreach($config as $c=>$k){
      if(defined("APP_".$c)){
        //配置已存在
        if(APP_DEBUG === true){
          exit("<!DOCTYPE html><html lang='zh-cn'><head><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><meta charset='utf-8'><title>系统发生错误</title></head><body><h1>配置文件发生错误</h1><p>重复配置 <span>{$c}</span> 变量，请检查根目录下的config.inc.php文件是否正确！</p><small>TCE框架-Beta</small></body></html>");
        }else{
          exit("<!DOCTYPE html><html lang='zh-cn'><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><title>系统发生错误</title></head><body><h1>系统错误</h1><p>您正在访问的页面出现了系统级问题，请稍候再试。</p><small>TCE框架-Beta</small></body></html>");
        }
      }else{
        //配置不存在
        define("APP_".$c,$k);
      }
    }
  }
  public function ReadPointedConfig($c,$file="./config.inc.php"){
    include($file);
    if(isset($config[$c])){
      return $config[$c];
    }else{
      return false;
    }
  }
  public function EditConfig($c1,$c2,$file="./config.inc.php"){
    include($file);
    if(!isset($config)){
      return false; //读取文件失败
    }else{
      //查询配置是否存在
      if(isset($config[$c1])){
        $config[$c1] = $c2;
        $f = "$";
        $content = "<?php\n {$f}config = ".var_export($config,true)."; \n?>";
        file_put_contents($file,$content);
        return true;
      }else{
        return false; //不存在此配置
      }
    }
  }
}
?>
