<?php
namespace Controller;
use Controller\BehaviorCommon;
class indexBehavior extends BehaviorCommon{
  /*BehaviorCommon函数可以在这里直接调用*/
  public function _index_index(){
    $this->showContent(getPresetTpl("tce"));
  }
}
?>
