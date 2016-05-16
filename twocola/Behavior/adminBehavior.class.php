<?php
class adminBehavior extends BehaviorCommon{
  protected function B_get_user_managelevel(){
    $uid = $_COOKIE['uid'];
    $exp = M("manager_account");
    $admin_level = $exp->where("uid='{$uid}'")->find();
    $admin_level = $admin_level['level'];
    //获取exp制度
    $s_exp = M("system_admin_level");
    $s_exp = $s_exp->select();
    for($i=0;$i<count($s_exp);$i++){
      if($s_exp[$i]['level']<$admin_level && $s_exp[$i+1]['level']>$admin_level || $s_exp[$i]['level']==$admin_level){
        $this->assign("level","Lv.".$s_exp[$i]['level']." {$s_exp[$i]['name']}");
        break;
      }
    }
  }

  protected function B_admin_index_authorize(){
    //初始化内容
    $content = $this->getContent();
    //获取用户权限
    $uid = $_COOKIE['uid'];
    $exp = M("manager_account");
    $admin_level = $exp->where("uid='{$uid}'")->find();
    $admin_level = $admin_level['level'];
    //判断权限
    $authorize = M("system_admin_authorize");
    $authorize = $authorize->where("status='100000'")->select();
    for ($i=0; $i < count($authorize); $i++) {
      $pattern = "/(<button(?:.*)id=['|\"]{$authorize[$i]['name']}['|\"](?:.*))>(?:.*)<\/button>/";
      $preg = preg_match_all($pattern,$this->getContent(),$matches);
      if($preg!=0){
        for ($i=0; $i < count($matches[0]); $i++) {
          $origin = $matches[1][$i];
          if($admin_level<$authorize[$i]['level']){
            $content = str_replace($origin,$origin."disabled",$content);
          }
        }
      }
    }
    $this->putContent($content);
  }

  protected function B_admin_shop_check_authorize(){
    //获取用户权限
    $uid = $_COOKIE['uid'];
    $exp = M("manager_account");
    $admin_level = $exp->where("uid='{$uid}'")->find();
    $admin_level = $admin_level['level'];
    //获取操作权限
    $authorize = M("system_admin_authorize");
    $authorize = $authorize->where("name='shop_check'")->find();
    if($authorize['status']=="100000"){
      $level = $authorize['level'];
      if($admin_level<$level){
        $this->showerror(U("admin/index?jumpfrom=".U("admin/shop_check")),"权限不足","您的管理权限暂时无法访问此页面。");
      }
    }
  }

  protected function B_admin_shop_check_getShops($name){
    $status = false;
    $shops = M("shop_list");
    $shops = $shops->where("status='0'")->order("shop_id")->select();
    if(!$shops){
      $this->assign("v_status",$status);
      $this->assign($name,$shops);
    }else{
      $this->assign("v_status","true");
      $this->assign($name,$shops);
    }
  }

}
?>
