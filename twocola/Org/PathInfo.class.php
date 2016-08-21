<?php
/*
** PATHINFO 支持模块
** 默认使用Rewrite模式，以index.php为入口
** 需定义常量
** 1、PI_BEHAVIOR
** 2、PI_METHOD
** *3、SYSTEM_SUFFIX
*/
class PathInfo {
  /* 定义模式 */
  Public $Type = "REWRITE";
  Public $Path = "./";  //运行根地址
  Public $Subdoamin = "";
  Public $Module = "";
  Public $Controller = "index";
  Public $Method = "index";
  Public $Domain = "";
  /* 初始构建 */
  public function __construct(){
    //获取运行地址
    $this->SetPath();
    //获取域名前缀
    $this->SetSubdomain();
    $this->SetDomain();
    //Rewrite模式
    if($this->Type=="REWRITE"){
      $this->Rewrite();
    }
  }

  public function getDomain(){
    return $this->Domain;
  }
  public function getModule(){
    return $this->Module;
  }
  public function getController(){
    return $this->Controller;
  }
  public function getMethod(){
    return $this->Method;
  }
  public function getPath(){
    return $this->Path;
  }
  public function getSubdomain(){
    return $this->Subdoamin;
  }
  /* Rewrite模式 */
  protected function Rewrite(){
    // echo "REQ:".$_SERVER['REQUEST_URI']."<br />";
    $path = str_replace("/","\/",$this->Path);
    /* 去除path前的.号 */
    $pattern = "/\.(.)+/U";
    $preg = preg_match($pattern,$path,$match);
    $path = ($preg==0) ? $path : str_replace(".","",$path);
    //取出Modual\Controller\Method
    $pattern = "/".$path."(.*)$/U";
    preg_match($pattern,$_SERVER['REQUEST_URI'],$match);
    // var_dump($match);
    $path_info = (isset($match[1])) ? $match[1] : null ;
    //去除get部分
    $pattern = "/\?.*$/U";
    $preg = preg_match($pattern,$path_info,$match);
    if($preg!=0){
      $path_info = str_replace($match[0],"",$path_info);
    }
    //取出ext部分
    $ext = pathinfo($path_info,PATHINFO_EXTENSION);  //extension
    //删除ext部分
    if($ext!=""){
      $length = strlen($ext)+1;
      $path_info = substr($path_info,0,strlen($path_info)-$length);
    }
    unset($match);  //避免问题释放资源
    if(mb_substr($path_info,0,1,"UTF-8")=="/"){
      $path_info = mb_substr($path_info,1,mb_strlen($path_info,"UTF-8")-1,"UTF-8");
    }
    // print_r($path_info);
    $path_info = explode("/",$path_info);
    // var_dump($path_info);
    //设置PI_MODULE
    if(!empty($path_info[0])){
      $this->Module = $path_info[0];
    }else{
      $this->Module = "";
    }
    //设置PI_CONTROLLER
    if(!empty($path_info[1])){
      $this->Controller = $path_info[1];
    }else{
      $this->Controller = "index";
    }
    //设置PI_METHOD
    if(!empty($path_info[2])){
      $this->Method = $path_info[2];
    }else{
      $this->Method = "index";
    }
  }

  /* 获取运行根地址 */
  private function SetPath(){
    $runPath = $_SERVER['PHP_SELF'];
    $pattern = "/\/index.php.*$/U";
    $preg = preg_match($pattern,$runPath,$match);
    if($preg!=0){
      $runPath = str_replace($match[0],"",$_SERVER['PHP_SELF']);
    }
    $runPath = ($runPath=="") ? "/" : $runPath ;
    $this->Path = $runPath;
  }

  /* 获取域名前缀（第一个单词） */
  protected function SetSubdomain(){
    $domain = $_SERVER['SERVER_NAME'];
    $pattern = "/^(.+)\..+\..+$/U";
    if(preg_match($pattern,$domain,$match)!=0){
      $this->Subdoamin = $match[1];
    }else{
      //没有使用相对子域名
      $this->Subdoamin = false;
    }
  }

  /* 获取根域名：只支持单个后缀的域名 */
  protected function SetDomain(){
    $domain = $_SERVER['SERVER_NAME'];
    $pattern = "/(?:.+?)\.(.+\..+)$/U";
    if(preg_match($pattern,$domain,$match)!=0){
      $this->Domain = $match[1];
    }else{
      //没有使用相对子域名
      $this->Domain = false;
    }
  }
}
?>
