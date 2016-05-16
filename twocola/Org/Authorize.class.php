<?php
class Authorize extends Template{
  //判断登录状态，不跳转
  public function u_a(){
    if(!isset($_COOKIE['uid'],$_COOKIE['username'],$_COOKIE['user_token'])){
      return false;
    }else{
      $db = M("user_account");
      $dbr = $db->where("uid='{$_COOKIE['uid']}'")->find();
      if($dbr){
        $token = md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005");
        if($token!=$_COOKIE['user_token']){
          $this->clearCookie();
          return false;
        }else{
          return true;
        }
      }else{
        $this->clearCookie();
        return false;
      }
    }
  }
  //判断用户权限
  public function user_authorize($type="normal"){
    if(!isset($_COOKIE['uid'],$_COOKIE['username'],$_COOKIE['user_token'])){
      header("location:".U("user/signin?jumpfrom=http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"));
      return false;
    }else{
      $db = M("user_account");
      $dbr = $db->where("uid='{$_COOKIE['uid']}'")->find();
      if($dbr){
        $token = md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005");
        if($token!=$_COOKIE['user_token']){
          //登录身份失效
          $this->clearCookie();
          header("location:".U("user/signin?jumpfrom=http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"));
          return false;
        }else{
          if($type!="verifyEmail" && $dbr['status']=="100010"){
            //判断用户权限码是否为100010（邮箱未验证）
            header("location:".U("user/signup_email?jumpfrom=http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}&tips=您需要进行邮箱验证才能正常使用账户。"));
            return false;
          }
        }
      }else{
        //登录身份失效
        $this->clearCookie();
        header("location:".U("user/signin?jumpfrom=http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"));
        return false;
      }
    }
  }
  //管理权限判断
  public function manager_authorize(){
    $this->user_authorize();  //验证用户正常权限
    $db = M("manager_account");
    $db = $db->where("uid='{$_COOKIE['uid']}'")->find();
    if(!$db){
      header("location:".U("user/index"));
      return false;
    }else if($db['level']<1 || $db['status']!="100000"){
      $this->showerror(U("help/manager#{$db['status']}"),"状态码错误：{$db['status']}","您的状态码（{$db['status']}）有误，点击“返回”按钮可以查看原因。");
      return false;
    }
  }

  public function m_a(){
    $this->u_a();
    $db = M("manager_account");
    $db = $db->where("uid='{$_COOKIE['uid']}'")->find();
    if(!$db){
      return false; //不存在
    }else if($db['level']<1 || $db['status']!="100000"){
      return false;
    }else{
      return $db['level'];
    }
  }

  public function systemStatus(){
    //判断系统状态
    $db = M("system_status");
    $open = $db->where("name='open'")->find();
    if($open['value']=="n"){
      //系统访问被关闭
      $reason = $db->where("name='close_reason'")->find();
      $reason = $reason['value'];
      $template = new Template();
      $template->showerror("","暂停访问啦",$reason,"stopview");
      exit();
    }
  }
  public function clearCookie(){
    cookie("uid");
    cookie("username");
    cookie("email");
    cookie("user_token");
  }
}
?>
