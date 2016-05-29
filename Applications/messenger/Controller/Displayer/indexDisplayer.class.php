<?php
namespace Controller;
use Controller\indexBehavior;
class indexDisplayer extends indexBehavior{
  public function index(){
    $this->show_t();
  }
  public function index_old(){
    if(@$_GET['token']=="old"){
      $this->show_t();
    }else{
      $this->show404();
    }
  }
  public function about(){
    $this->show_t("关于");
  }
  public function join(){
    $this->show_t("加入");
  }
  public function open(){
    $this->show_t("开放");
  }
  public function siteauthorize(){
    $this->showerror(U("user/index?jumpfrom=".U("index/siteauthorize")),"暂未开放","许可站点功能暂未开放，尽请期待。");
  }
}
?>
