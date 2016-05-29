<?php
namespace TCE;
use TCE\Json;
class Api extends Json{
  public function systemStatus(){
    //判断系统状态
    $db = M("system_status");
    $open = $db->where("name='open'")->find();
    if($open['value']=="n"){
      //系统访问被关闭
      $reason = $db->where("name='close_reason'")->find();
      $reason = $reason['value'];
      $this->json_e("0",$reason,"0","0","0");
      exit();
    }
  }
  public function userAuthorize($type="normal"){
    if(!isset($_COOKIE['uid'],$_COOKIE['username'],$_COOKIE['user_token'])){
      $this->json_e("1","Normal","0","A_0x00","用户信息错误");
      exit();
    }else{
      $db = M("user_account");
      $dbr = $db->where("uid='{$_COOKIE['uid']}'")->find();
      if($dbr){
        $token = md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005");
        if($token!=$_COOKIE['user_token']){
          //登录身份失效
          $this->clearCookie();
          $this->json_e("1","Normal","0","A_0x00","用户信息错误");
          exit();
        }
      }else{
        //登录身份失效
        $this->clearCookie();
        $this->json_e("1","Normal","0","A_0x00","用户信息错误");
        exit();
      }
    }
  }

  public function adminAuthorize(){
    $this->userAuthorize();
    $db = M("manager_account");
    $db = $db->where("uid='{$_COOKIE['uid']}'")->find();
    if(!$db || $db['level']<1 || $db['status']!="100000"){
      $this->json_e("1","Normal","0","A_0x10","您无法进行此操作：操作权限不足。");
      exit();
    }else{
      return $db['level'];
    }
  }

  public function needAdminLevel($name){
    $authorize = M("system_admin_authorize");
    $authorize = $authorize->where("name='{$name}'")->find();
    if(!$authorize){
      return false;
    }else{
      return $authorize['level']; //返回等级限制
    }
  }

  public function adminLevelAuthorize($name){
    $alevel = $this->adminAuthorize();  //获取用户等级
    if(!$alevel || $alevel<1){
      $this->json_e("1","Normal","0","A_0x10","您无法进行此操作：操作权限不足。");
      exit();
    }else{
      $needLevel = $this->needAdminLevel($name);
      if($alevel<$needLevel){
        $this->json_e("1","Normal","0","A_0x10","您无法进行此操作：操作权限不足。");
        exit();
      }else{
        return true;
      }
    }
  }

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

  public function signinRecord($username,$type,$status="Y",$message=true,$referer=""){
    $referer = ($referer=="") ? $_SERVER['HTTP_REFERER'] : $referer ;
    $uid = $this->getUID($username);
    if(!$uid){
      return false;
    }else{
      $data['uid'] = $uid;
      $data['type'] = $type;
      $data['referer'] = $referer;
      $data['time'] = date("Y:m:d H:i:s");
      $data['status'] = $status;
      $record = M("user_records_signin");
      $result = $record->add($data);
      //查询今日是否有通知记录，有则不通知。
      $todays = M("user_records_signin");
      $today = $todays->where("uid='{$uid}' AND date_format(time,'%y-%m-%d')=date_format(now(),'%y-%m-%d')")->find("count(*)");
      if($today['count(*)']!="1"){
        $message=false; //取消发送站内信计划
      }
      if($message===true&&$status==="N"){
        $article = "<p style='text-align:left'>尊敬的用户：<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您的账户于<span style='color:red'> {$data['time']} </span>使用 <span> {$data['type']} </span>形式进行了登录，但是由于密码错误被拒绝登录。<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果不是您本人操作，建议您更换账户密码。<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;为了避免骚扰情况，登录失败的通知仅每日提示1次，请您注意好您帐号的安全。</p><p style='text-align:right'><span style='color:#999999'>".APP_NAME."安全中心</span><br /><span style='color:#999999'>".date("Y:m:d H:i:s")."</span></p>";
        $this->sendMessage($uid,"0","失败的登录通知","关于您当前账户的失败登录通知",$article); //发送站内信，提示登录情况
      }
      return $result; //返回记录情况
    }
  }
  /* 获取用户UID */
  public function getUID($username){
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
}
?>
