<?php
class userAPI extends Api{
  public function index(){
    $this->json_e("1","Welcome! You can use our api in this way!","0","0","0");
  }
  public function signup(){
    $this->systemStatus();  //系统状态
    if(isset($_POST['username'],$_POST['password'],$_POST['repassword'])){  //$_POST['email']
      $username = $_POST['username'];
      $password = $_POST['password'];
      $repassword = $_POST['repassword'];
      $email = $_POST['email'];
      //验证信息正确性
      if($password!=$repassword){
        $this->json_e("1","Normal","0","A_1x01","两次密码不一致");
        return false;
      }
      $pattern = "/^[a-z][a-zA-Z0-9_]{5,15}$/";
      if(!preg_match($pattern,$username)){
        $this->json_e("1","Normal","0","A_1x02","此用户名不可用，请更换一个");
        return false;
      }
      $pattern = "/^.{6,16}$/";
      if(!preg_match($pattern,$password)){
        $this->json_e("1","Normal","0","A_1x03","此密码不可用，请更换一个");
        return false;
      }
      $pattern = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
      if(!preg_match($pattern,$email)){
        $this->json_e("1","Normal","0","A_1x04","邮箱不正确");
        return false;
      }
      //判断邮箱是否已经存在
      $db = M("user_account");
      $dbr = $db->where("email='{$email}'")->find();
      if($dbr){
        $this->json_e("1","Normal","0","A_1x12","此邮箱已经存在");
        return false;
      }
      //判断用户名是否已经被使用
      $db = $db->where("username='{$username}'")->find();
      if($db){
        $this->json_e("1","Normal","0","A_1x05","此用户名已经被注册了");
        return false;
      }else{
        //可以使用的账户
        $password = MD5(md5($password));
        $data['username'] = $username;
        $data['password'] = $password;
        $data['email'] = $email;
        $data['status'] = "100010"; //未验证邮箱
        $db = M("user_account");
        $dbr = $db->add($data);
        if(!$dbr){
          $this->json_e("1","Normal","0","A_1x06","未知错误（DB）：A_1x06");
          return false;
        }else{
          cookie("uid",$dbr);
          cookie("username",$username);
          cookie("user_token",md5($dbr.$username.$password."Jokin2005"));
          $this->json_e("1","Normal","1","0","0");  //正常注册
          return true;
        }
      }
    }else{
      $this->json_e("1","Welcome! You can use our api in this way!","0","0","0");
    }
  }

  public function signin(){
    if(isset($_POST['username'],$_POST['password'])){
      $username = $_POST['username'];
      $password = MD5(md5($_POST['password']));
      $db = M("user_account");
      //uid
      $dbr = $db->where("uid='{$username}'")->find();
      if($dbr){
        if($dbr['uid']==$username && $dbr['password']==$password){
          //验证成功
          cookie("uid",$dbr['uid']);
          cookie("username",$dbr['username']);
          // cookie("email",$dbr['email']);
          cookie("user_token",md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005"));
          $this->signinRecord($username,"uid","Y");  //记录登录情况
          $this->json_e("1","Normal","1","0","0");  //UID登录成功
          return true;
        }else{
          $this->signinRecord($username,"uid","N");  //记录登录情况
          $this->json_e("1","Normal","0","A_1x07","用户名和密码不匹配");
          return false;
        }
      }else{
        //username
        $dbr = $db->where("username='{$username}'")->find();
        if($dbr){
          if($dbr['username']==$username && $dbr['password']==$password){
            //验证成功
            cookie("uid",$dbr['uid']);
            cookie("username",$dbr['username']);
            // cookie("email",$dbr['email']);
            cookie("user_token",md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005"));
            $this->signinRecord($username,"uid","Y");  //记录登录情况
            $this->json_e("1","Normal","1","0","0");  //Username登录成功
            return true;
          }else{
            $this->signinRecord($username,"uid","N");  //记录登录情况
            $this->json_e("1","Normal","0","A_1x07","用户名和密码不匹配");
            return false;
          }
        }else{
          //email
          $dbr = $db->where("email='{$username}'")->find();
          if($dbr){
            if($dbr['email']==$username && $dbr['password']==$password){
              //验证成功
              cookie("uid",$dbr['uid']);
              cookie("username",$dbr['username']);
              // cookie("email",$dbr['email']);
              cookie("user_token",md5($dbr['uid'].$dbr['username'].$dbr['password']."Jokin2005"));
              $this->signinRecord($username,"uid","Y");  //记录登录情况
              $this->json_e("1","Normal","1","0","0");  //Username登录成功
              return true;
            }else{
              $this->signinRecord($username,"uid","N");  //记录登录情况
              $this->json_e("1","Normal","0","A_1x07","用户名和密码不匹配");
              return false;
            }
          }else{
            $this->signinRecord($username,"uid","N");  //记录登录情况
            $this->json_e("1","Normal","0","A_1x07","用户名和密码不匹配");
            return false;
          }
        }
      }
    }else{
      $this->json_e("1","Welcome! You can use our api in this way!","0","0","0");
    }
  }
  public function signout(){
    cookie("uid");
    cookie("username");
    cookie("email");
    cookie("user_token");
  }

  public function signup_email(){
    $this->systemStatus();  //系统状态
    $this->userAuthorize(); //用户状态
    if(isset($_POST['email'],$_COOKIE['uid'])){
      $email = @$_POST['email'];
      $uid = @$_COOKIE['uid'];
      $pattern = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
      if(!preg_match($pattern,$email)){
        $this->json_e("1","Normal","0","A_1x08","电子邮箱不正确");
        return false;
      }
      //判断邮箱是否已被占用

      //获取用户最近的同类型email发送记录
      $db = M("secure_user_email");
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
          $se = sendEmail($email,APP_NAME."：感谢您的使用！","您的账户验证码，进入查看详情。","尊敬的用户：".$_COOKIE['username']."\n您好！\n感谢您使用".APP_NAME."\n您的验证码为：<font color='red'>".$_SESSION['verify_email']."</font>\n<small style='color:#666666'>请认准邮件发件人：noreply@twocola.com</small>");
          if($se){
            $this->json_e("1","Normal","1","0","0");  //发送成功
            return false;
          }else{
            $this->json_e("1","Normal","0","A_1x13","发送邮件错误");
            return false;
          }
        }else{
          $this->json_e("1","Normal","0","A_1x14","发生了未知错误：A_1x14");
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
            $this->json_e("1","Normal","0","A_1x13","发送邮件错误");
            return false;
          }
        }else{
          $this->json_e("1","Normal","0","A_1x14","发生了未知错误：A_1x14");
          return false;
        }
      }else{
        //60秒间隔时间未到
        $this->json_e("1","Normal","0","A_1x11",60-time()+$time['time']);
        return false;
      }
    }else{
      //没有传递post_email
      $this->json_e("1","Normal","0","A_1x15","发生了未知错误：A_1x15");
      return false;
    }
  }

  public function signup_email_apply(){
    $this->systemStatus();  //系统状态
    $this->userAuthorize(); //用户状态
    if(isset($_POST['verify_email'])){
      $verify_email = MD5(MD5(md5(@$_POST['verify_email'])));
      //判断邮箱验证
      $db = M("secure_user_email");
      $dbr = $db->where("vid='{$verify_email}'")->find();
      if(!$dbr){
        //验证码错误
        $this->json_e("1","Normal","0","A_1x16","验证码不正确");
        return false;
      }else{
        $email = $dbr['email'];
        $uid = $dbr['uid'];
        $db->where("vid='{$verify_email}'")->delete();  //删除记录
        unset($dbr);//清空数据
        //将email写入用户信息表内
        $db = M("user_account");
        $data['email'] = $email;
        $data['status'] = "100000";
        $dbr = $db->where("uid='{$uid}'")->save($data);
        if($dbr){
          $this->json_e("1","Normal","1","0","0");
          return true;
        }else{
          $this->json_e("1","Normal","0","A_1x17","未知错误：A_1x17");
          return false;
        }
      }
    }else{
      $this->json_e("1","Normal","0","A_2x00","未知错误：A_2x00");
    }
  }
  //获取站内信
  public function getmessage(){
    $this->systemStatus();  //系统状态
    $this->userAuthorize(); //用户状态
    if(isset($_POST['mid'])){
      $uid = @$_COOKIE['uid'];
      $mid = $_POST['mid'];
      $messages = M("user_message");
      $message = $messages->where("to_uid='{$uid}' AND mid='{$mid}'")->find();
      if(!$message){
        $this->json_e("1","Normal","0","A_3x01","获取当前站内信失败，请刷新后再试。");
      }else{
        if($message['status']=="100101"){
          $data['status']="100100";
          $messages->where("to_uid='{$uid}' AND mid='{$mid}'")->save($data);
        }
        $infomation = array(
          "title" => $message['title'],
          "article" => $message['article']
        );
        $this->json_e("1","Normal","1","0",$infomation);  //获取成功
      }
    }else{
      $this->json_e("1","Welcome! You can use our api in this way!","0","0","0");
    }
  }

}
?>
