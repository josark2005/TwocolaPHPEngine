<?php
namespace Api;
use TUnit\TJson;
class app extends TJson{
  /**
   * 创建应用
   * @param  void
   * @return void
  **/
  public function generate(){
    if( !isset($_POST['app'])){
      $this->json_e("1","Normal","0","wrong_order_infomation","错误的创建信息");
      return ;
    }
    $app = $_POST['app'];
    // 判断应用是否存在
    $appExist = \TUnit\App::AppExist($app);
    if($appExist){
      $this->json_e("1","Normal","0","app_existed","该应用已经存在");
      return ;
    }
    // 调用应用创建函数
    // 使用用户设置的应用目录
    $path = ".".\TUnit\TLaungher::getRealPath(APP_PATH);
    \TUnit\TLaungher::CreateApp($app ,$path);
    $appExist = \TUnit\App::AppExist($app);
    if(!$appExist){
      $this->json_e("1","Normal","0","app_generate_failed","应用创建失败");
      return ;
    }
    $this->json_e("1","Normal","1","order_got","请求已经提交");
    return ;
  }


}
?>
