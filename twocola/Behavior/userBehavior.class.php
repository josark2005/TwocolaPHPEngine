<?php
class userBehavior extends BehaviorCommon{
  /* 公共函数 */
  protected function B_get_page(){
    if(!isset($_GET['page'])){
      $page = "1";
    }else{
      if($_GET['page']<=0){
        $_GET['page'] = 1;
      }
      $page = $_GET['page'];
    }
    return $page;
  }
  /* ./公共函数 */
  protected function B_user_index_shop_id($name="shop"){
    $this->assign($name,$this->B_get_user_shop(false)['shop_id']);
  }
  protected function B_user_index_admin_authorize($name="admin"){
    $this->assign($name,$this->B_get_admin_authorize(false));
  }
  protected function B_user_signup_user_email($name="email"){
    $email = $this->B_get_user_info(false)['email'];
    if($email){
      $this->assign($name,$email);
    }
  }
  protected function B_user_message_get_message(){
    /* 信息填补 */
    if(!isset($_GET['type'])){
      $_GET['type'] = "3";
    }
    if(!isset($_GET['status'])){
      $_GET['status'] = "all";
    }
    /* ./信息填补 */
    $this->B_get_user_message_count_unread("message_count_unread"); //获取未读消息数量
    $this->B_get_user_message_invite_count_unread("message_invite_count"); //获取未读消息数量
    if($_GET['type']=="3" && $_GET['status']=='100101'){
      $count = $this->B_get_user_message_count_unread(false);
      $this->B_get_user_message_unread_limit("messages",$this->B_get_page(),20);
    }else if($_GET['type']=="3" && $_GET['status']=="all"){
      $count = $this->B_get_user_message_count(false);
      $this->B_get_user_message_limit("messages",$this->B_get_page(),20);
    }else if($_GET['type']=='2' && $_GET['status']=="all"){
      $count = $this->B_get_user_message_invite_count(false);
      $this->B_get_user_message_invite_limit("messages",$this->B_get_page(),20);
    }
    $this->assign("message_count",$count);
    /* 分页 */
    org("Pagination/pagination.class.php");
    $pagination = new Pagination($this->B_get_page(),ceil($count/20));
    $pagination->n_index("&laquo;");
    $pagination->n_end("&raquo;");
    $pagination = $pagination->pagination();
    unset($pagination['prev']);
    unset($pagination['next']);
    $this->assign("pagination",$pagination);
  }

}
?>
