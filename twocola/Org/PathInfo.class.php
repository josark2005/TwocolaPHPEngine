<?php
/*
** PATHINFO 支持模块
** 默认使用Rewrite模式，以index.php为入口
** 需定义常量
** 0、PATH
** 1、PI_BEHAVIOR
** 2、PI_METHOD
** 3、APP_SUBDOMAIN
** *4、SYSTEM_SUFFIX
*/
class PathInfo {
  /* 定义模式 */
  public $Type = "REWRITE";
  /* 初始构建 */
  public function __construct(){
    //获取运行地址
    $this->GetRunPath();
    //获取域名前缀
    $this->GetSubDomain();
    //Rewrite模式
    if($this->Type=="REWRITE"){
      $this->Rewrite();
    }
  }
  /* Rewrite模式 */
  protected function Rewrite(){
    // echo "REQ:".$_SERVER['REQUEST_URI']."<br />";
    $path = str_replace("/","\/",PATH);
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
    // echo $path_info; //提取的path_info
    $path_info = explode("/",$path_info);
    // var_dump($path_info);
    //设置PI_BEHAVIOR
    if(!empty($path_info[0])){
      define("PI_BEHAVIOR",$path_info[0]);
    }else{
      define("PI_BEHAVIOR","index");
    }
    //设置PI_METHOD
    if(!empty($path_info[1])){
      define("PI_METHOD",$path_info[1]);
    }else{
      define("PI_METHOD","index");
    }
  }

  /* 获取运行根地址 */
  protected function GetRunPath(){
    $runPath = $_SERVER['PHP_SELF'];
    $pattern = "/\/index.php.*$/U";
    $preg = preg_match($pattern,$runPath,$match);
    $runPath = str_replace(@$match[0],"/",$_SERVER['PHP_SELF']);
    define("PATH",$runPath);
    // echo "PATH:".PATH."<br />";
  }

  /* 获取域名前缀（第一个单词） */
  protected function GetSubDomain(){
    $domain = $_SERVER['SERVER_NAME'];
    $pattern = "/^(.+)\..+\..+$/U";
    if(preg_match($pattern,$domain,$match)!=0){
      define("APP_SUBDOMAIN",$match[1]);
    }else{
      //没有使用相对子域名
      define("APP_SUBDOMAIN",false);
    }
  }

}
?>
