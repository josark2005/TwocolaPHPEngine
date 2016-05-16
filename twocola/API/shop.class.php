<?php
class shopAPI extends Api{
  public function send_verify_email(){
    $this->systemStatus();  //系统状态
    $this->userAuthorize(); //用户状态
    if(isset($_POST['email'],$_COOKIE['uid'])){
      $email = @$_POST['email'];
      $uid = @$_COOKIE['uid'];
      $pattern = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
      if(!preg_match($pattern,$email)){
        $this->json_e("1","Normal","0","A_2x01","电子邮箱地址不正确");
        return false;
      }
      //判断邮箱是否已被占用

      //获取用户最近的同类型email发送记录
      $db = M("secure_shop_email");
      $time = $db->where("uid='{$uid}'")->find();
      if(!$time){
        //没有记录
        $_SESSION['verify_email'] = rand(100000,999999);
        $data['vid'] = MD5(MD5(md5($_SESSION['verify_email'])));
        $data['uid'] = $uid;
        $data['email'] = $email;
        $data['time'] = time();
        $dbr = $db->add($data);
        if($dbr){
          $se = sendEmail($email,APP_NAME."：感谢您的使用！","您的店铺申请验证码，进入查看详情。","尊敬的用户：".$_COOKIE['username']."\n您好！\n感谢您使用".APP_NAME."\n您的邮箱验证码为：<font color='red'>".$_SESSION['verify_email']."</font>\n<small style='color:#666666'>请认准邮件发件人：noreply@twocola.com</small>");
          if($se){
            $this->json_e("1","Normal","1","0","0");  //发送成功
            return false;
          }else{
            $this->json_e("1","Normal","0","A_2x03","发送邮件失败");
            return false;
          }
        }else{
          $this->json_e("1","Normal","0","A_2x02","未知错误：A_2x02");
          return false;
        }
      //有记录
      }else if((time()-$time['time'])>60){
        $_SESSION['verify_email'] = rand(100000,999999);
        $data['vid'] = MD5(MD5(md5($_SESSION['verify_email'])));
        $data['uid'] = $uid;
        $data['email'] = $email;
        $data['time'] = time();
        if($db->where("uid='{$uid}'")->save($data)){
          $se = sendEmail($email,APP_NAME."验证邮件（系统邮件，请勿回复。）","两杯可乐网旗下".APP_NAME."（twocola.com）","<strong>尊敬的".APP_NAME."用户：".$_COOKIE['username']."</strong><br /><h3>您的邮箱验证码为：<font color='red'>".$_SESSION['verify_email']."</font></h3><br /><small style='color:#666666'>若不是您本人申请，请忽略此邮件。</small>");
          if($se){
            $this->json_e("1","Normal","1","0","0");  //发送成功
            return true;
          }else{
            $this->json_e("1","Normal","0","A_2x03","发送邮件失败，请稍候再试。");
            return false;
          }
        }else{
          $this->json_e("1","Normal","0","A_2x02","未知错误：A_2x02");
          return false;
        }
      }else{
        //60秒间隔时间未到
        $this->json_e("1","Normal","0","A_2x04",60-time()+$time['time']);
        return false;
      }
    }else{
      //没有传递post_email
      $this->json_e("1","Normal","0","A_2x00","未知错误：A_2x00");
      return false;
    }
  }

  public function open_apply(){
    $this->systemStatus();  //系统状态
    $this->userAuthorize(); //用户状态
    if(isset($_POST['shopname'],$_POST['shopintro'],$_POST['verify_email'])){
      $shopname = @$_POST['shopname'];
      $shopintro = @$_POST['shopintro'];
      $verify_email = MD5(MD5(md5(@$_POST['verify_email'])));
      //判断邮箱验证
      $db = M("secure_shop_email");
      $dbr = $db->where("vid='{$verify_email}'")->find();
      if(!$dbr){
        //验证码错误
        $this->json_e("1","Normal","0","A_2x06","验证码错误");
        return false;
      }else{
        $email = $dbr['email'];
        $uid = $dbr['uid'];
        $db->where("vid='{$verify_email}'")->delete();  //删除记录
        //将email写入用户信息表内
        $db = M("user_account");
        $data['email'] = $email;
        $db->where("uid='{$uid}'")->save($data);
        unset($data);
      }
      $db = M("shop_list");
      $user = $db->where("uid='{$uid}'")->find();
      if($user){
        $this->json_e("1","Normal","0","A_2x07","您已经有一个店铺了");
        return false;
      }
      $name = $db->where("name='{$shopname}'")->find();
      if(!$name){
        $data['level'] = 0;
        $data['uid'] = $uid;
        $data['name'] = $shopname;
        $data['description'] = $shopintro;
        $data['status'] = 0;
        $dbr = $db->add($data);
        if(!$dbr){
          $this->json_e("1","Normal","0","A_2x02","未知错误：A_2x02");
          return false;
        }else{
          //注册成功！
          sendEmail(ADMIN_EMAIL,APP_NAME."系统通知（系统邮件，请勿回复。）","两杯可乐网旗下".APP_NAME."（twocola.com）","<strong>尊敬的管理员：</strong><br /><h3>有新的店铺<font color='red'> {$shopname} </font>正在申请审核，请及时进行审核！</h3><br /><small style='color:#666666'>两杯可乐网通知邮件。</small>");
          $this->json_e("1","Normal","1","0","0");
          return true;
        }
      }else{
        //名称重复
        $this->json_e("1","Normal","0","A_2x05","这个店铺名称已经存在了");
        return false;
      }
    }else{
      $this->json_e("1","Normal","0","A_2x00","未知错误：A_2x00");
    }
  }

}
?>
