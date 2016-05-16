<?php
class indexDisplayer extends indexBehavior{
  public function index(){
    $this->show();
  }
  public function index_old(){
    if(@$_GET['token']=="old"){
      $this->show();
    }else{
      $this->show404();
    }
  }
  public function about(){
    $this->show("关于");
  }
  public function join(){
    $this->show("加入");
  }
  public function open(){
    $this->show("开放");
  }
  public function siteauthorize(){
    $this->showerror(U("user/index?jumpfrom=".U("index/siteauthorize")),"暂未开放","许可站点功能暂未开放，尽请期待。");
  }
}
?>
