<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ DO IT　EASY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola Studio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------

//----------------------------------
// Twocola PHP Engine(TCE)   OAM系统
// Version:                  1.0.6.1001
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
      self::BDAPI();  // 检查是否进入API模式
      // 如果未配置BDAPI，则不载入DBA模块
      if( C("RMODE") == 1 ){
        self::BDA();
      }
      return true;    // 窝群启动成功
    }else{
      return false;   // 窝群启动失败
    }
  }

  /*
  ** 支持域名绑定指定应用Api
  ** Binding Domain and Api of App
  ** @param  void
  ** @return boolean
  */
  static public function BDAPI(){
    if( isset(self::$OAM['BDAPI']) && !empty(self::$OAM['BDAPI']) && is_array(self::$OAM['BDAPI']) ){
      $Domain = $_SERVER['SERVER_NAME'];
      // 判断是否配置当前域名到指定APP的Api
      if( isset(self::$OAM['BDAPI'][$Domain]) && !empty(self::$OAM['BDAPI'][$Domain]) ){
        C("APP"  ,self::$OAM['BDAPI'][$Domain]);
        C("RMODE",2);
      }else{
        C("RMODE",1); // 尝试切换到DBA模式
      }
    }
    return ;
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
      return ;
    }
  }


}
?>
