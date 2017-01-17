<?php
namespace Controller\Displayer;
use Controller\Behavior\indexBehavior;
class indexDisplayer extends indexBehavior{
  /*Behavior与BehaviorCommon函数可以在这里直接调用*/
  public function index(){
    $this->_index_index();//这里调用Controller/Behavior/indexBehavior中的_index_index函数
  }
}
?>
