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
** APP核心类
** Version: 1.0.5.2801
*/
namespace TUnit;
class App {
  /**
   * 运行应用
   * @param  void
   * @return void
  **/
  static public function run(){
    $APP        =  C("APP");
    $CONTROLLER =  C("CONTROLLER");
    $METHOD     =  C("METHOD");
    // 判断配置是否正确
    $D  = DIRECTORY_SEPARATOR;
    $CP = ".".C("APP_PATH").$D.$APP."{$D}Controller{$D}";
    if(file_exists($CP."Displayer{$D}".C("CONTROLLER")."Displayer" .C("CLASS_EXT") )&&
      file_exists( $CP."Behavior{$D}" .C("CONTROLLER")."Behavior"  .C("CLASS_EXT") )&&
      file_exists( $CP."Common{$D}BehaviorCommon"                  .C("CLASS_EXT") )){
      // 载入应用
      require_once($CP."Common{$D}BehaviorCommon"                  .C("CLASS_EXT") );
      require_once($CP."Behavior{$D}" .C("CONTROLLER")."Behavior"  .C("CLASS_EXT") );
      require_once($CP."Displayer{$D}".C("CONTROLLER")."Displayer" .C("CLASS_EXT") );
      $ClassName = "\\Controller\\Displayer\\".$CONTROLLER."Displayer";
      $template = new $ClassName();
      if(method_exists($template,C("METHOD"))){
        $template->$METHOD();
      }else{
        Template\Template::show404();
        exit();
      }
    }else{
      Template\Template::show404();
      exit();
    }
  }

}
?>
