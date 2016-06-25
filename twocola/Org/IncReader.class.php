<?php
// $config = $config->ReadConfig();  //读取全部配置
// $config = $config->ReadPointedConfig("DB_HOST"); //读取单个配置
namespace TCE;
class IncReader {
  /* 单态类 */
  private static $status = null;
  private function __construct(){
    return false;
  }
  public static function IO(){
    if(self::$status===null){
      return self::$status = new self();
    }else{
      return self::$status;
    }
  }

  private $config = null;

  /* 读取并返回配置 */
  public function ReadConfig($file="./config.inc.php"){
    include_once($file);
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
      $this->config[strtoupper($k)] = $c;  //写入全局变量
    }
  }
  /* 读取指定配置 */
  public function ReadPointedConfig($c="noneconfig"){
    $c = strtoupper($c);
    $config = $this->config;
    if(isset($config[$c])){
      return $config[$c];
    }else{
      return false; //未定义返回False
    }
  }
  /* 修改单个变量 */
  public function EditConfig($var="noneconfig",$content=""){
    $var = strtoupper($var);
    $config = $this->config;
    if(isset($config[$var])){
      $this->config = $content;
    }else{
      return false;
    }
  }
  /* 增加单个配置 */
  public function AddConfig($var="noneconfig",$content=""){
    $var = strtoupper($var);
    if(isset($this->config)){
      return false; //配置存在
    }else{
      $this->config[$var] = $content;
    }
  }
  /* 配置是否存在 */
  public function ConfigExists($var="noneconfig"){
    $var = strtoupper($var);
    if(isset($this->config[$var])){
      return true;
    }else{
      return false;
    }
  }
  /* 清除配置 */
  public function ClearConfig($var="noneconfig"){
    $var = strtoupper($var);
    if(empty($var)){
      self::$config = null;
    }else{
      if(isset(self::$config[$var])){
        unset(self::$config[$var]);
        return true;
      }else{
        return false;
      }
    }
  }

}
?>
