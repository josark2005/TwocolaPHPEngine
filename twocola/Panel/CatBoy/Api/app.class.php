<?php
namespace Api;
use TUnit\TJson;
class app extends TJson{
  /**
   * 获取应用名称
   * @param  void
   * @return void
  **/
  public function get_name(){
    if( !isset($_POST['app'])){
      $this->json_e("1","Normal","0","wrong_order_infomation","错误的获取信息");
      return ;
    }
    $app = $_POST['app'];
    // 判断应用是否存在
    $appExist = \TUnit\App::AppExist($app);
    if(!$appExist){
      $this->json_e("1","Normal","0","app_existed","该应用不存在");
      return ;
    }
    // 调用应用创建函数
    $path = ".".\TUnit\TLaungher::GetRealPath(APP_PATH).DIRECTORY_SEPARATOR.$app.DIRECTORY_SEPARATOR."config".C("CONFIG_EXT");
    if(!is_file($path)){
      $this->json_e("1","Normal","1","app_name","[unknown_config]");
      return ;
    }
    include $path;
    if( !isset($config['APP_NAME']) ){
      $this->json_e("1","Normal","1","app_name","[bad_config]");
    }
    $this->json_e("1","Normal","1","app_name",$config['APP_NAME']);
    return ;
  }
  
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
    $path = ".".\TUnit\TLaungher::GetRealPath(APP_PATH);
    \TUnit\TLaungher::CreateApp($app ,$path);
    $appExist = \TUnit\App::AppExist($app);
    if(!$appExist){
      $this->json_e("1","Normal","0","app_generate_failed","应用创建失败");
      return ;
    }
    $this->json_e("1","Normal","1","order_got","请求已经提交");
    return ;
  }

  /**
   * 删除应用
   * @param  void
   * @return void
  **/
  public function delete(){
    if( !isset($_POST['app'])){
      $this->json_e("1","Normal","0","wrong_order_infomation","错误的删除信息");
      return ;
    }
    $app = $_POST['app'];
    // 判断应用是否存在
    $appExist = \TUnit\App::AppExist($app);
    if(!$appExist){
      $this->json_e("1","Normal","0","app_existed","该应用不存在");
      return ;
    }
    // 使用用户设置的应用目录
    $path = ".".\TUnit\TLaungher::GetRealPath(APP_PATH);
    // 删除应用
    \TUnit\Storage\StorageCore::DelDir($path.DIRECTORY_SEPARATOR.$app);
    $appExist = \TUnit\App::AppExist($app);
    if($appExist){
      $this->json_e("1","Normal","0","app_delete_failed","应用删除失败");
      return ;
    }
    $this->json_e("1","Normal","1","order_got","请求已经提交");
    return ;
  }


}
?>
