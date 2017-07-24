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

// +----------------------------------
// |        Api  Json操作类
// +----------------------------------
namespace TUnit;
class TJson{
  static public function json_c($system_status,$system_message,$app_status,$app_errno,$app_error="no error."){
    $array = array(
      "System"  => array(
            "status"       => $system_status,
            "message"      => $system_message,
      ),
      "App"     => array(
            "status"       => $app_status,
            "app"          => C("APP"),
            "controller"   => C("CONTROLLER"),
            "method"       => C("METHOD"),
            "errno"        => $app_errno,
            "error"        => $app_error,
      ),
      "Records" => array(
            "time"         => date("Y-m-d H:i:s"),
      ),
    );
    return json_encode($array);
  }
  static public function json_e($system_status,$system_message,$app_status,$app_errno,$app_error="no error."){
    self::json_h();
    echo self::json_c($system_status,$system_message,$app_status,$app_errno,$app_error);
  }
  static public function json_h(){
    if(C("APP_DEBUG") == false){
      header('Content-Type:text/json;charset=utf-8');
    }
  }

}
?>
