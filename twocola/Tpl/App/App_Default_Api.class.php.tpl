<?php
namespace Api;
use TUnit\TJson;
class index extends TJson{
  /*
  ** 默认首个Api方法
  ** @param  void
  ** @return void
  */
  public function index(){
    $this->json_e("1","Welcome! You can use our api in this way!","1","0","0");
  }
}
?>
