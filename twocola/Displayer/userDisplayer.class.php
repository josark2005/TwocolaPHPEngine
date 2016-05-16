<?php
class userDisplayer extends userBehavior{
  public function index(){
    $this->systemStatus();  //系统状态
    $this->user_authorize();
    $this->B_get_user_headimg("head_img");  //获取头像
    $this->B_get_user_level("level");  //获取等级
    $this->B_user_index_shop_id("shop"); //获取店铺
    $this->B_user_index_admin_authorize("admin"); //获取管理员权限
    $this->B_get_user_message_count_unread("message");  //获取用户未读短信数量
    $this->B_get_user_info();
    $this->show("用户中心");
  }
  public function message(){
    $this->systemStatus();  //系统状态
    $this->user_authorize();
    // $this->manager_authorize();
    $this->B_user_message_get_message();
    $this->show("消息中心");
  }
  public function signin(){
    // $this->systemStatus();  //系统状态
    if($this->u_a()){
      header("location:".U('user/index')); //直接跳转
      exit();
    }
    $this->assign("url_signin",U("user/index",PATH),true);
    $this->show("登录");
  }
  public function signup(){
    $this->systemStatus();  //系统状态
    if($this->u_a()){
      header("location:".U('user/index')); //直接跳转
      exit();
    }
    $this->show("注册");
  }
  public function signup_email(){
    $this->systemStatus();  //系统状态
    $this->B_get_user_email("email");
    $this->user_authorize("verifyEmail");
    $this->show("验证账户");
  }
}
?>
