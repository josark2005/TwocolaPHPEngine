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
/*
** Panel驱动类
** Version 1.0.7.2901
*/
namespace TUnit\Drivers;
class Panel {
  /**
   * Panel Path
   * @param  string
  **/
  static public $PATH;

  /**
   * Panel驱动
   * @param  void
   * @return void
  **/
  static public function driver(){
    $D = DIRECTORY_SEPARATOR;
    // 修正设置
    if( C("PANEL_PATH") == false ){
      self::$PATH = C("TCE_PATH").$D."Panel";
    }else{
      self::$PATH = C("PANEL_PATH");
    }
    // 判断是否正确连接Panel
    if( !is_dir(self::$PATH.$D.C("PANEL_NAME"))  ){
      // 修正应用目录进行报错
      C("APP_PATH" ,\TUnit\TLaungher::GetRealPath(C("APP_PATH")) );
      \TUnit\Template\Template::showError("E_P01_NFP","无法找到Panel");
      exit();
    }

    // 判断进入Panel条件
    if( C("PANEL") == true ){
      // 判断进入方式
      if( C("PANEL_PORTAL") == 1 ){
        // GET进入
        if( isset($_GET[C("PANEL_PORTAL_KEY")]) && $_GET[C("PANEL_PORTAL_KEY")] == C("PANEL_PORTAL_VALUE") ){
          self::enter();
        }
      }else if( C("PANEL_PORTAL") == 2){
        // 默认进入
        self::enter();
      }
      return ;
    }
  }

  /**
   * 跳转至Panel
   * @param  void
   * @return void
  **/
  static private function enter(){
    // 进入Panel
    C("IS_PANEL" ,true);                // 标记Panel模式
    C("APP" ,C("PANEL_NAME"));          // 修改为Panel名称
    C("APP_PATH" ,\TUnit\TLaungher::GetRealPath(self::$PATH) );
    C("APP_DEFAULT" ,C("PANEL_NAME"));  // 错误阻止机制
  }

}
?>
