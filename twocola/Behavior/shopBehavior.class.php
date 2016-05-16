<?php
class shopBehavior extends BehaviorCommon{
  protected function B_get_shop_list(){
    $page = $this->B_get_page();
    $db = M("shop_list");
    $dbr = $db->where("status='100000'")->order("level desc")->limit(($page-1)*10,10)->select();
    if(!$dbr){
      $this->showerror(U("user/index"),"没有找到店铺","抱歉...没有找到店铺呢，稍候再来看看吧！");
    }
    return $dbr;
  }

  protected function B_get_shop_count(){
    $db = M("shop_list");
    $db = $db->where("status='100000'")->select("count(*)");
    return $db[0]["count(*)"];
  }

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
  protected function B_index_pagination(){
    org("Pagination/pagination.class.php");
    $page = new Pagination($this->B_get_page(),ceil($this->B_get_shop_count()/10)); //每页10个
    $page->n_index("&laquo;");
    $page->n_end("&raquo;");
    $page = $page->pagination();
    unset($page['prev']);
    unset($page['next']);
    $this->assign("pagination",$page);
  }
  protected function B_open_user_ishad(){
    $shop = $this->B_get_user_shop(false);
    if($shop){
      $this->showerror(U("user/index"),"您已经拥有店铺了","您已经拥有店铺了，暂无法访问此页面。");
    }
  }

  protected function B_manage_auth_user_shop(){
    $uid = @$_COOKIE['uid'];
    $db = M("shop_list");
    $db = $db->where("uid='{$uid}'")->find();
    if(!$db){
      $this->showerror(U("user/index"),"您还未开通店铺","您还未开通店铺，暂无法访问此页面。");
    }else if($db['status']!=0){
      $this->assign("shop_name",$db['name']);
      $this->assign("shop_id",$db['shop_id']);
      $this->assign("shop_description",$db['description']);
      $this->assign("shop_status",$db['status']);
    }else{
      $this->showerror(U("user/index"),"店铺正在审核","您的店铺正在审核中，请稍候再访问，我们将尽快为您审核。");
    }
  }

  protected function B_open_get_user_email(){
    $uid = @$_COOKIE['uid'];
    $email = M("user_account");
    $email = $email->where("uid='{$uid}'")->find();
    if($email){
      return $email['email'];
    }
  }

}
?>
