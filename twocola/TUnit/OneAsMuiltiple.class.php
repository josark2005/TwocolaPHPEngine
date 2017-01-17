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

//----------------------------------
// Twocola PHP Engine(TCE)   OAM系统
// Version:                  v1.0
//----------------------------------
namespace TUnit;
class OneAsMuiltiple {


  /*
  ** OAM配置文件
  ** @access  public
  */
  static public $OAM ;


  /*
  ** 禁止实例化
  ** @param  void
  ** @return void
  */
  private function __construct(){
    return false;
  }


  /*
  ** OAM驱动
  ** @param  void
  ** @return boolean
  */
  static public function OAM(){
    if( is_array(C("OAM"))&&!empty("OAM") ){
      self::$OAM = C("OAM");
      self::RMODE();  // RunMode运行模式
      // 如果RMODE正常，则不载入DBA模块
      if( C("RMODE") == false ){
        self::BDA();
      }
      return true;    // 窝群启动成功
    }else{
      return false;   // 窝群启动失败
    }
  }

  /*
  ** 支持域名绑定指定Api
  ** Binding Domain and Api of App
  ** @param  void
  ** @return boolean
  */
  static public function RMODE(){
    // 判断是否正确配置OAM中的DAOA系统
    if( isset(self::$OAM['RMODE'])&&!empty(self::$OAM['RMODE'])&&is_array(self::$OAM['RMODE']) ){
      $Domain = $_SERVER['SERVER_NAME'];
      if(  isset(self::$OAM['RMODE'][$Domain]) && !empty(self::$OAM['RMODE'][$Domain])){
        C("APP"  ,self::$OAM['RMODE'][$Domain]);
        C("RMODE",true);
        return ;
      }else{
        C("RMODE",false);
        return ;
      }
    }else{
      C("RMODE",false);
      return ;

    }
  }

  /*
  ** 支持域名绑定应用
  ** Binding Domain and App
  ** @param  void
  ** @return void
  */
  static public function BDA(){
    // 判断是否正确配置OAM中的BDA系统
    if( isset(self::$OAM['BDA'])&&!empty(self::$OAM['BDA'])&&is_array(self::$OAM['BDA']) ){
      $Domain = $_SERVER['SERVER_NAME'];
      if( isset(self::$OAM['BDA'][$Domain]) && !empty(self::$OAM['BDA'][$Domain]) ){
        C("APP",self::$OAM['BDA'][$Domain]);
      }
    }
  }


}
?>
