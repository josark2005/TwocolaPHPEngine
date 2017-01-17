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
namespace TUnit;
class Api {
  /*
  ** 运行应用
  ** @param  void
  ** @return void
  */
  static public function run(){
    $APP        =  C("APP");
    $CONTROLLER =  C("CONTROLLER");
    $METHOD     =  C("METHOD");
    // 判断配置是否正确
    $D  = DIRECTORY_SEPARATOR;
    $Apath =  APP_PATH.$D.$APP.$D."Api".$D.$CONTROLLER.C("CLASS_EXT");
    if( file_exists($Apath) ){
      // 载入应用
      require_once($Apath);
      $ClassName = "\\Api\\".$CONTROLLER;
      $api = new $ClassName();
      if(method_exists($api,C("METHOD"))){
        $api->$METHOD();
      }else{
        Template\Template::showError("E_S02_C2","指定Api通道不存在");
        exit();
      }
    }else{
      Template\Template::showError("E_S02_C1","Api类库不存在");
      exit();
    }
  }

}
?>
