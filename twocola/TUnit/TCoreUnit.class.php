<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ More Teamwork ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola STudio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** TCE引擎核心引导类
** Ver 1.0.3.2201
*/
namespace TUnit;
class TCoreUnit {
  /* 初始引导 */
  static public function start(){
    // 载入TCE核心Funciotn文件
    include_once(TCE_PATH."/TUnit/Functions/TFunction".EXT);
    // 注册autoload方法
    spl_autoload_register("TUnit\TCoreUnit::autoload");
    // 设定错误和异常处理
    register_shutdown_function("TUnit\TCoreUnit::fatalError");
    set_error_handler("TUnit\TCoreUnit::appError");
    set_exception_handler("TUnit\TCoreUnit::appException");
    //设置时区
    date_default_timezone_set(C("DEFAULT_TIMEZONE"));
    // 运行
    session_start();
    ob_start();
    TLaungher::Run();
  }

  /* autoload */
  static public function autoload($class){
    $class = DIRECTORY_SEPARATOR.$class;
    $class = str_replace("\\",DIRECTORY_SEPARATOR,$class);
    $path = TCE_PATH.$class.CLASS_EXT;
    // 引擎内搜索
    if(is_file($path)){
      include_once($path);
      return ;
    }
    // 应用内搜索
    $path = APP_PATH.$class.CLASS_EXT;
    if(is_file($path)){
      include_once($path);
      return ;
    }
  }

  /**
   * 异常处理
   * @access public
   * @param mixed $e 异常对象
   */
  //==================================
  static public function appException($e) {
      $error = array();
      $error['message']   =   $e->getMessage();
      $trace              =   $e->getTrace();
      if('E'==$trace[0]['function']) {
          $error['file']  =   $trace[0]['file'];
          $error['line']  =   $trace[0]['line'];
      }else{
          $error['file']  =   $e->getFile();
          $error['line']  =   $e->getLine();
      }
      $error['trace']     =   $e->getTraceAsString();
      // Log::record($error['message'],Log::ERR);
      // 发送404信息
      header('HTTP/1.1 404 Not Found');
      header('Status:404 Not Found');
      self::halt($error);
  }


  /**
   * 错误处理
   * @param int $errno 错误类型
   * @param string $errstr 错误信息
   * @param string $errfile 错误文件
   * @param int $errline 错误行数
   * @return void
   */
  static public function appError($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
        case E_ERROR:
        case E_PARSE:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
          $error = array(
            "message"      =>  $errstr,
            "file"         =>  $errfile,
            "line"         =>  $errline
          );
          self::halt($error);
          break;
        default:
          $error = array(
            "message"      =>  $errstr,
            "file"         =>  $errfile,
            "line"         =>  $errline
          );
          self::halt($error);
          break;
    }
  }

  // 致命错误捕获
  static public function fatalError() {
    if ($e = error_get_last()) {
      switch($e['type']){
        case E_ERROR:
        case E_PARSE:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        self::halt($e);
        break;
      }
    }
  }


  /**
  * 错误输出
  * @param mixed $error 错误
  * @return void
  */
  static public function halt($error) {
    ob_end_clean(); // 清除已经提交缓存的页面
    // 修复工作目录
    chdir(PATH);
    $error['file'] = str_replace(PATH,"",$error['file']);
    if(APP_DEBUG){
      // 调试模式下输出错误信息
      $trace = array_reverse(debug_backtrace(false,true));
      $file = "";
      $line = "";
      for ($i=0; $i < count($trace); $i++) {
        if(isset($trace[$i]['file'])){
          $file = $trace[$i]['file'];
        }else if(is_object($trace[$i]['args'])&&property_exists($trace[$i]['args'][0],"file") ){
          $file = $trace[$i]['args'][0]->file;
        }else if(!empty($trace[$i]['args'])&&isset($trace[$i]['args'][0]['file']) ){
          $file = $trace[$i]['args']['file'];
        }
        $trace[$i]['file'] = str_replace(PATH,"",$file);
      }
      for ($i=0; $i < count($trace); $i++) {
        if(isset($trace[$i]['line'])){
          $line = $trace[$i]['line'];
        }else if(is_object($trace[$i]['args'])&&property_exists($trace[$i]['args'][0],"line") ){
          $line = $trace[$i]['args'][0]->line;
        }else if(!empty($trace[$i]['args'])&&isset($trace[$i]['args'][0]['line']) ){
          $line = $trace[$i]['args']['line'];
        }
        $trace[$i]['line'] = str_replace(PATH,"",$line);
      }
      $tpl = getPresetTpl("TUnit/Error/ErrorException");
      Template\Template::assign("trace" ,$trace);
      Template\Template::assign("error" ,$error);
      Template\Template::ProcessTpl($tpl);
      $path = Template\Template::GeneralCache(false,"_Error");
      include ( $path );
    }else{
      // 否则定向到错误页面
      // ==更新==
      $tpl = getPresetTpl("TUnit/Error/ErrorException_Secure");
      Template\Template::ProcessTpl($tpl);
      include ( Template\Template::GeneralCache(false,"_Error") );
    }
    exit;
  }

}
?>
