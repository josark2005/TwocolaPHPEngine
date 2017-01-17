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
class TException extends \Exception{
  static function __set_state($array) {
    return $array;
  }
  public function __get($property_name){
    if(isset($this->$property_name)){
        return $this->$property_name;
    }else{
        return null;
    }
  }

}
?>
