<?php
namespace Controller\Displayer;
use Controller\Behavior\indexBehavior;
class indexDisplayer extends indexBehavior{
  /*Behavior与BehaviorCommon函数可以在这里直接调用*/
  public function index(){
    getUserTpl("index/about?panel=tce");
    $this->show();
  }
  public function about(){
    $this->show();
  }
  public function tce_information(){
    // 已支持的数据库
    $db_support = \TUnit\Database\DatabaseLaungher::$support;
    // 测试中的数据库
    $db_support_beta = \TUnit\Database\DatabaseLaungher::$support_beta;
    // 即将可能支持的数据库
    $db_support_future = \TUnit\Database\DatabaseLaungher::$will_support;
    $this->assign("db_support" ,$db_support);
    $this->assign("db_support_beta" ,$db_support_beta);
    $this->assign("db_support_future" ,$db_support_future);
    $this->show();
  }
  public function tce_settings(){
    $this->assign("APP_SUFFIX_SAFE" ,C("APP_SUFFIX_SAFE"));
    $this->show();
  }

  // 参与开发
  public function dev_tce(){
    $this->show();
  }
  public function dev_panel(){
    $this->show();
  }

  // 404页面
  public function pnf(){
    $this->show();
  }
  // 拒绝访问页面
  public function nr(){
    $this->show();
  }
}
?>
