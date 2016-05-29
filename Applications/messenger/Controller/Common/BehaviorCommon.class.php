<?php
namespace Controller;
use TCE\Template;
class BehaviorCommon extends Template{
  /* 获取用户头像 */
  protected function B_get_user_headimg($name="head_img"){
    $uid = $_COOKIE['uid'];
    //__STATIC:404.png__
    $db = M("user_headimg");
    $db = $db->where("uid='{$uid}'")->find();
    if($name===false){
      //返回值模式
      if(!$db){
        return $this->magicTag("__STATIC:headimg.png__");
      }else{
        //显示头像
        return $this->magicTag("__STATIC:headimg.png__");
      }
    }else{
      //输出模式
      if(!$db){
        $this->assign($name,$this->magicTag("__STATIC:headimg.png__"));
      }else{
        //显示头像
        $this->assign($name,$this->magicTag("__STATIC:headimg.png__"));
      }
    }
  }
  //获取用户等级信息（返回的数组：level|name|exp[基准exp]）
  protected function B_get_user_level($name="level"){
    $uid = $_COOKIE['uid'];
    $exp = M("user_exp");
    $user_exp = $exp->where("uid='{$uid}'")->find();
    if(!$user_exp){
      $data['uid'] = $uid;
      $data['exp'] = 0;
      $exp->add($data);
      $user_exp = 0;
    }else{
      $user_exp = $user_exp['exp'];
    }
    //获取exp制度
    $s_exp = M("system_user_level");
    $s_exp = $s_exp->select();
    for($i=0;$i<count($s_exp);$i++){
      if($s_exp[$i]['exp']<$user_exp && $s_exp[$i+1]['exp']>$user_exp || $s_exp[$i]['exp']==$user_exp){
        if($name===false){
          //返回值
          return $s_exp[$i];
        }else{
          //输出值
          $this->assign($name,"Lv.".$s_exp[$i]['level']." {$s_exp[$i]['name']}");
        }
        break;
      }
    }
  }
  //获取用户店铺信息（数组：shop_id|level|uid|name|description|status）
  protected function B_get_user_shop($name="shop"){
    $uid = @$_COOKIE['uid'];
    $shop = M("shop_list");
    $shop = $shop->where("uid='{$uid}'")->find();
    if($name===false){
      //返回值
      return $shop;
    }else{
      //输出值
      if($shop){
        $this->assign($name,$shop);
      }
    }
  }
  //获取用户管理权限(uid|level|status)
  protected function B_get_admin_authorize($name="admin"){
    $uid = @$_COOKIE['uid'];
    $admin = M("manager_account");
    $admin = $admin->where("uid='{$uid}' AND status='100000'")->find();
    if($name===false){
      //返回值模式
      return $admin;
    }else{
      //输出模式
      $this->assign($name,$admin);
    }
  }
  //获取用户站内信息(mid[站内信编号]|to_uid|from_uid|title|leader|article|folder_id|post_time|status[100101未读，100100已读,100102标星])
  protected function B_get_user_message($name="messages"){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("to_uid='{$uid}'")->order("post_time desc,status desc")->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_limit($name="messages",$page=1,$count=15){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("to_uid='{$uid}'")->order("post_time desc,status desc")->limit(($page-1)*$count,$count)->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  //获取用户站内未读信息(mid[站内信编号]|to_uid|from_uid|title|leader|article|folder_id|post_time|status[100101未读，100100已读,100102标星])
  protected function B_get_user_message_unread($name="message_unread"){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("to_uid='{$uid}' AND status='100101'")->order("post_time desc")->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_unread_limit($name="message_unread",$page=1,$count=15){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("to_uid='{$uid}' AND status='100101'")->order("post_time desc")->limit(($page-1)*$count,$count)->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  //获取用户站内信数量
  protected function B_get_user_message_count($name="message_count"){
    $count = (is_array($this->B_get_user_message(false))) ? count($this->B_get_user_message(false)) : 0 ;
    if($name===false){
      //返回值
      return $count;
    }else{
      //输出值
      $this->assign($name,$count);
    }
  }
  protected function B_get_user_message_count_unread($name="message_count_unread"){
    $count = (is_array($this->B_get_user_message_unread(false))) ? count($this->B_get_user_message_unread(false)) : 0 ;
    if($name===false){
      //返回值
      return $count;
    }else{
      //输出值
      $this->assign($name,$count);
    }
  }

  //获取用户好友邀请消息
  protected function B_get_user_message_invite($name="message_invite"){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("type='2' AND to_uid='{$uid}'")->order("post_time desc")->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_invite_limit($name="message_invite",$page=1,$count=15){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("type='2' AND to_uid='{$uid}'")->order("post_time desc")->limit(($page-1)*$count,$count)->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_invite_unread($name="message_invite_unread"){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("type='2' AND to_uid='{$uid}' AND status='100101'")->order("post_time desc")->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_invite_unread_limit($name="message_invite_unread",$page=1,$count=15){
    $uid = @$_COOKIE['uid'];
    $message = M("user_message");
    $message = $message->where("type='2' AND to_uid='{$uid}' AND status='100101'")->order("post_time desc")->limit(($page-1)*$count,$count)->select();
    if($name===false){
      //返回值
      return $message;
    }else{
      //输出值
      $this->assign($name,$message);
    }
  }
  protected function B_get_user_message_invite_count($name="message_count_unread"){
    $count = (is_array($this->B_get_user_message_invite(false))) ? count($this->B_get_user_message_invite(false)) : 0 ;
    if($name===false){
      //返回值
      return $count;
    }else{
      //输出值
      $this->assign($name,$count);
    }
  }
  protected function B_get_user_message_invite_count_unread($name="message_invite_count"){
    $count = (is_array($this->B_get_user_message_invite_unread(false))) ? count($this->B_get_user_message_invite_unread(false)) : 0 ;
    if($name===false){
      //返回值
      return $count;
    }else{
      //输出值
      $this->assign($name,$count);
    }
  }
  //获取用户信息(uid|username|email|status|exp)
  protected function B_get_user_info($name="user"){
    $uid = @$_COOKIE['uid'];
    //多表查询内建函数兼容不够，故此处使用手动连接数据库
    $info = new \Database(APP_DB_HOST,APP_DB_PORT,APP_DB_NAME,APP_DB_USERNAME,APP_DB_PASSWORD);
    $info->Prefix = APP_DB_PREFIX;
    $info = $info->table("user_account as a|user_exp as b",true)->where("a.uid=b.uid='{$uid}'")->find("a.uid,a.username,a.email,a.status,b.exp");
    if($name===false){
      //返回值
      return $info;
    }else{
      //输出值
      $this->assign($name,$info);
    }
  }

  //获取用户邮箱
  protected function B_get_user_email($name="user"){
    $uid = @$_COOKIE['uid'];
    $email = M("user_account");
    $email = $email->where("uid='{$uid}'")->find();
    if($name===false){
      //返回值
      return $email['email'];
    }else{
      //输出值
      $this->assign($name,$email['email']);
    }
  }

  /* 获取用户UID */
  public function B_get_user_uid($username){
    $user = M("user_account");
    //uid
    $uid = $user->where("uid='{$username}'")->find();
    if($uid){
      $uid = $uid['uid'];
      // $type = "uid";
    }else{
      //username
      $uid = $user->where("username='{$username}'")->find();
      if($uid){
        $uid = $uid['uid'];
        // $type = "username";
      }else{
        //email
        $uid = $user->where("email='{$username}'")->find();
        if($uid){
          $uid = $uid['uid'];
          // $type = "email";
        }else{
          return false; //无此用户不比录入
        }
      }
    }
    return $uid;
  }

  //发送站内信
  public function sendMessage($to_uid,$from_uid="0",$title="一封来自系统的通知",$leader="系统邮件",$article,$type=1,$post_time=""){
    if(!$to_uid){
      return false;
    }
    $data['type'] = $type;
    $data['to_uid'] = $to_uid;
    $data['from_uid'] = $from_uid;
    $data['title'] = $title;
    $data['leader'] = $leader;
    $data['article'] = $article;
    $data['post_time'] = ($post_time=="") ? date("Y-m-d H:i:s") : $post_time ;
    $db = M("user_message");
    $dbr = $db->add($data);
    if(!$dbr){
      return false;
    }else{
      return true;
    }
  }
  /* 权限部分 */
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
