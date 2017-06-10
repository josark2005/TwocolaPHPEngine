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
** Panel驱动
** Version 1.0.6.0901
*/
namespace TUnit\Drivers;
class Panel {
  /**
   * Panel驱动
   * @param  void
   * @return void
  **/
  static public function driver(){
    $D = DIRECTORY_SEPARATOR;
    // 判断是否正确连接Panel
    if( !is_dir(C("PANEL_PATH").$D.C("PANEL_NAME"))  ){
      // 获取真实APP路径
      $preg = preg_match("/^\.(.+)(?:[\/|\\\])*$/U" ,C("APP_PATH") ,$match);
      if($preg != 0){
        C("APP_PATH" ,$match[1]);
      }
      \TUnit\Template\Template::showError("E_P01_NFP","无法找到Panel");
      exit();
    }

    // 判断进入Panel条件
    if( C("PANEL") == true ){
      // 判断进入方式
      if( C("PANEL_PORTAL") == 1 ){
        // GET进入
        if( isset($_GET[C("PANEL_PORTAL_KEY")]) && $_GET[C("PANEL_PORTAL_KEY")] == C("PANEL_PORTAL_VALUE") ){
          C("APP_PATH" ,C("PANEL_PATH"));
          C("IS_PANEL" ,true);  // 标记Panel模式
        }
      }else if( C("PANEL_PORTAL") == 2){
        // 默认进入
        C("APP_PATH" ,C("PANEL_PATH"));
        C("IS_PANEL" ,true);  // 标记Panel模式
      }
      C("APP" ,C("PANEL_NAME"));
      C("APP_DEFAULT" ,C("PANEL_NAME"));
      return ;
    }
  }
}
?>
