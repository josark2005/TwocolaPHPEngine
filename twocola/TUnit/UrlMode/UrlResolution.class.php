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
** TCE引擎Pathinfo模式核心类
** Ver 1.2.4.0201
*/
namespace TUnit\UrlMode;
class UrlResolution {
  /*
  ** TCE引擎URL解析
  ** @param  int   URL_MODE  URL模式
  ** @return array p
  */
  static public function TCE($URL_MODE){
    $p = self::Resolution($URL_MODE);
    define( "APP"           ,self::safer($p["APP"])         );
    define( "CONTROLLER"    ,self::safer($p["CONTROLLER"])  );
    define( "METHOD"        ,self::safer($p["METHOD"])      );
    return ;
  }
  static public function Resolution($URL_MODE){
    //判断是否需要PATHINFO
    if( !isset($_SERVER['PATH_INFO']) ){
      //全部使用默认配置
      $p["APP"]        = C("APP_DEFAULT");
      $p["CONTROLLER"] = "index";
      $p["METHOD"]     = "index";
      return $p;
    }else{
      //对PATHINFO进行解析
      $suffix = str_replace(".","\.",C("APP_SUFFIX"));
      if(C("APP_SUFFIX_SAFE") == true){
        // 自动适配所有后缀
        $pattern = "/(.+)(?:\..*)*(?:[\?].+)*$/U";
      }else{
        $pattern = "/(.+)(?:".$suffix.")*(?:[\?].+)*$/U";
      }
      $preg = preg_match($pattern,$_SERVER['REQUEST_URI'],$match);
      if($preg != 0){
        $pathinfo = $match[1];
      }else{
        $pathinfo = $_SERVER['REQUEST_URI'];
      }
      $pathinfo = mb_substr( $pathinfo ,strlen(WEB_PATH) ,strlen($pathinfo)-strlen(WEB_PATH) ,"utf-8" );
      $pathinfo = explode("/",$pathinfo);
      $count = count($pathinfo);
      /*
      ** 当PATHINFO数量为1时，定义Module
      ** 当PATHINFO数量为2时，定义Controller、Method
      */
      // 设置 APP
      if( $count == 2 ){
        $Module = C("APP_DEFAULT");
      }else{
        $Module = $pathinfo[0];
      }
      // 设置 CONTROLLER
      if( $count == 1 ){
        $Controller = "index";
      }else if( $count == 2 ){
        $Controller = $pathinfo[0];
      }else{
        $Controller = $pathinfo[1];
      }
      // 设置 METHOD
      if( $count == 2 ){
        $Method = $pathinfo[1];
      }else if( $count == 3 ){
        $Method = $pathinfo[2];
      }else{
        $Method = "index";
      }
      $p["APP"]        = self::safer($Module);
      $p["CONTROLLER"] = self::safer($Controller);
      $p["METHOD"]     = self::safer($Method);
      return $p;
    }
  }
  static public function pathResolution($path){
    //对PATHINFO进行解析
    $pathinfo = $path;
    if( $pathinfo == false){
      //无效的pathinfo
      $p["APP"]        = C("APP_DEFAULT");
      $p["CONTROLLER"] = "index";
      $p["METHOD"]     = "index";
      return $p;
    }
    $pathinfo = explode("/",$pathinfo);
    $count = count($pathinfo);
    /*
    ** 当PATHINFO数量为1时，定义Module
    ** 当PATHINFO数量为2时，定义Controller、Method
    */
    // 设置 APP
    if( $count == 2 ){
      $Module = C("APP_DEFAULT");
    }else{
      $Module = $pathinfo[0];
    }
    // 设置 CONTROLLER
    if( $count == 1 ){
      $Controller = "index";
    }else if( $count == 2 ){
      $Controller = $pathinfo[0];
    }else{
      $Controller = $pathinfo[1];
    }
    // 设置 METHOD
    if( $count == 2 ){
      $Method = $pathinfo[1];
    }else if( $count == 3 ){
      $Method = $pathinfo[2];
    }else{
      $Method = "index";
    }
    $p["APP"]        = self::safer($Module);
    $p["CONTROLLER"] = self::safer($Controller);
    $p["METHOD"]     = self::safer($Method);
    return $p;
  }

  static public function safer($var){
    $var = str_replace("." ,"" ,$var);
    $var = str_replace("?" ,"" ,$var);
    $var = str_replace("/" ,"" ,$var);
    $var = str_replace("\\" ,"" ,$var);
    return $var;
  }

}
?>
