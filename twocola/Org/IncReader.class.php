<?php
// $config = $config->ReadConfig();  //读取全部配置
// $config = $config->ReadPointedConfig("DB_HOST"); //读取单个配置
namespace TCE;
class IncReader {
  protected $cn = "tce_config"; //子数组名
  /* 读取并返回配置 */
  public function ReadConfig($file="./config.inc.php"){
    include($file);
    return $config;
  }
  //定义配置常量
  public function GetConfig($file="./config.inc.php"){
    if(file_exists($file)){
      require($file);
    }else{
      return false;
    }
    foreach($config as $k=>$c){
      $GLOBALS[$this->cn][$k] = $c;  //写入全局变量
    }
  }
  /* 读取指定配置 */
  public function ReadPointedConfig($c="none"){
    $config = $GLOBALS[$this->cn];
    if(isset($config[$c])){
      return $config[$c];
    }else{
      return false; //未定义返回False
    }
  }
  /* 修改单个变量 */
  public function EditConfig($var="none",$content=""){
    $config = $GLOBALS[$this->cn];
    if(isset($config[$var])){
      $GLOBALS[$this->cn] = $content;
    }else{
      return false;
    }
  }
  /* 增加单个配置 */
  public function AddConfig($var="none",$content=""){
    if(isset($GLOBALS[$this->cn])){
      return false; //配置存在
    }else{
      $GLOBALS[$this->cn][$var] = $content;
    }
  }
  /* 配置是否存在 */
  public function ConfigExists($var="none"){
    if(isset($GLOBALS[$this->cn][$var])){
      return true;
    }else{
      return false;
    }
  }
  /*
  ** 优化空间：
  ** 1、单个Config读取不区分大小写
  ** 2、可自定义Globals子数组名
  */
}
?>
