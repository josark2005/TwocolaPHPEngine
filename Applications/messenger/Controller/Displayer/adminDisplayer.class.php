<?php
namespace Controller;
use Controller\adminBehavior;
class adminDisplayer extends adminBehavior{
  public function index(){
    $this->manager_authorize();
    $this->B_get_user_headimg();
    $this->B_get_user_managelevel();
    $this->B_admin_index_authorize(); //按钮权限判定
    $this->show_t("管理");
  }

  public function shop_check(){
    $this->manager_authorize();
    $this->B_admin_shop_check_authorize();  //进入权限判断
    $this->B_get_user_headimg();
    $this->B_get_user_managelevel();
    $this->B_admin_shop_check_getShops("shops");
    $this->show_t("店铺审批");
  }

}
?>
