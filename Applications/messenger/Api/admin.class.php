<?php
namespace Api;
use TCE\Api;
class adminAPI extends Api{
  public function index(){
    $this->json_e("1","Welcome! You can use our api in this way!","1","0","0");
  }
//$se = sendEmail($email,APP_NAME."：感谢您的使用！","您的账户验证码，进入查看详情。","尊敬的用户：".$_COOKIE['username']."<br />您好！<br />感谢您使用".APP_NAME."<br />您的验证码为：<font color='red'>".$_SESSION['verify_email']."</font><br /><small style='color:#666666'>请认准邮件发件人：noreply@twocola.com</small>");
  public function shop_check(){
    $this->systemStatus();  //系统状态
    $this->adminLevelAuthorize("shop_check");  //管理员权限
    if(isset($_POST['type'],$_POST['shopid'],$_POST['reason'])){
      $shop_id = $_POST['shopid'];
      $uid = M("shop_list");
      $uid = $uid->where("shop_id='{$shop_id}'")->find("uid");
      $uid = $uid['uid'];
      $email = M("user_account");
      $email = $email->where("uid='{$uid}'")->find("email");
      if(!$email){
        $this->json_e("1","Normal","0","M_1x03","这个店铺的申请人可能是非法的，请等待刷新后重试。");
        exit();
      }else{
        $email = $email['email'];
      }
      $type = $_POST['type'];
      $reason = $_POST['reason'];
      if($type=="ratify"){
        $data['status'] = "100001";
      }
      $db = M("shop_list");
      $shop = $db->where("shop_id='{$shop_id}'")->find();
      if(!$shop || $shop['status']!="0"){
        $this->json_e("1","Normal","0","M_1x01","这个店铺不存在或者已经被审核了，请刷新页面后继续操作。");
        exit();
      }else{
        if($type=="ratify"){
          $shop = $db->where("shop_id='{$shop_id}'")->save($data);
          if($shop){
            sendEmail($email,APP_NAME."：感谢您的使用！","您的申请已经通过。","<p>尊敬的用户：".$_COOKIE['username']."<br />&nbsp;&nbsp;您好！<br />&nbsp;&nbsp;感谢您使用".APP_NAME."！<br />&nbsp;&nbsp;您的店铺申请已经通过！<br /><small style='color:#666666'>请认准邮件发件人：noreply@twocola.com</small></p>");
            $this->sendMessage($uid,"0","店铺审核通过通知","您的店铺通过了审核，请及时进行调整。","<p style='text-align:left'>亲爱的用户：<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可乐君特别恭喜您！您的店铺审核通过了！<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您可以通过【用户中心】侧边栏中的【管理店铺】对您的店铺进行自由管理。可乐君希望您的店铺能够开业大吉！同时，也请您能够遵守当地法律法规。</p><p style='text-align:right'><span>此致！</span><br /><span>商祺！</span></p>");
            $this->json_e("1","Normal","1","0","成功更新该店铺状态！");
          }else{
            $this->json_e("1","Normal","1","M_1x02","更新店铺状态失败，请刷新后再试。");
          }
        }else if($type=="refuse"){
          $shop = $db->where("shop_id='{$shop_id}'")->delete();
          if($shop){
            $this->sendMessage($uid,"0","店铺审核通过通知","您的店铺申请被驳回了","亲爱的用户：<br />&nbsp;&nbsp;您好！<br />&nbsp;&nbsp;可乐君非常抱歉的通知您！您的店铺审核被驳回了！<br />&nbsp;&nbsp;但是，我们依旧给予您再次申请的权利！您可以通过【用户中心】侧边栏中的【开通店铺】再次申请开通店铺。可乐君希望早日看到您的店铺生意兴隆！可乐君非常期盼您的到来！<br />&nbsp;&nbsp;此次驳回理由：{$reason}<br />此致<br />商祺！");
            sendEmail($email,APP_NAME."：感谢您的使用！","您的店铺申请被驳回。","尊敬的用户：".$_COOKIE['username']."<br />&nbsp;&nbsp;您好！<br />&nbsp;&nbsp;感谢您使用".APP_NAME."<br />&nbsp;&nbsp;您的店铺申请被驳回了，驳回理由：<font color='red'>".$reason."</font><br /><small style='color:#666666'>请认准邮件发件人：noreply@twocola.com</small>");
            $this->json_e("1","Normal","1","0","成功更新该店铺状态！");
          }else{
            $this->json_e("1","Normal","1","M_1x02","更新店铺状态失败，请刷新后再试。");
          }
        }
      }
    }else{
      $this->json_e("1","Normal","0","M_0x00","信息出现错误，请刷新后再试。");
      exit();
    }
  }

}
?>
