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
    include "./config".C("CONFIG_EXT");
    $this->assign("config" ,$config);
    $this->show();
  }
  public function oam_settings(){
    include "./config".C("CONFIG_EXT");
    $this->assign("OAM" ,$config['OAM']);
    $this->show();
  }
  public function app_generate(){
    $this->show();
  }
  public function app_delete(){
    $app_list = \TUnit\App::AppList();
    $this->assign("app_list",$app_list);
    $this->show();
  }
  public function app_settings(){
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
