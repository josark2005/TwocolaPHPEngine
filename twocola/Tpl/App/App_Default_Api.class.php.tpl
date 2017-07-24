<?php
namespace Api;
use TUnit\TJson;
class index extends TJson{
  /**
   * 首个Api方法
   * @param  void
   * @return void
  **/
  public function index(){
    // 参数顺序：系统状态|系统信息|应用状态|应用错误编码|应用错误信息
    $this->json_e("1","Welcome! You can use our api in this way!","1","0","0");
  }
}
?>
