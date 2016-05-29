<?php
namespace Controller;
use Controller\shopBehavior;
class shopDisplayer extends shopBehavior{
  public function index(){
    $this->assign("cshop",$this->B_get_shop_count());
    $this->assign("shops",$this->B_get_shop_list());
    $this->B_index_pagination();
    $this->show_t("店铺");
  }
  public function open(){
    $this->systemStatus();  //系统状态
    $this->user_authorize();
    $this->B_open_user_ishad();
    $this->assign("email",$this->B_open_get_user_email());
    $this->show_t("开通店铺");
  }
  public function manage(){
    $this->systemStatus();  //系统状态
    $this->user_authorize();
    $this->B_manage_auth_user_shop();  //是否拥有店铺
    $this->show_t("管理店铺");
  }
}
?>
