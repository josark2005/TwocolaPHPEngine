<?php
namespace Api;
use TUnit\TJson;
class settings extends TJson{
  /**
   * 修改单个设置
   * @param  void
   * @return void
  **/
  public function tce_change(){
    if( !isset($_POST['name']) || !isset($_POST['value']) ){
      $this->json_e("1","Normal","0","settings_change_failed","错误的修改信息");
      return ;
    }
    $D = DIRECTORY_SEPARATOR;
    $file = ".{$D}config".C("CONFIG_EXT");
    if( !is_file($file) ){
      $this->json_e("1","Normal","0","settings_change_failed","全局配置文件不存在");
      return ;
    }
    // 载入源设置
    include $file;
    $config[$_POST['name']] = $_POST['value'];
    $linefeed = PHP_EOL;
    $content = "<?php{$linefeed}\$config=".var_export($config,true).";";
    if(!\TUnit\Storage\StorageCore::Put($file ,$content)){
      $this->json_e("1","Normal","0","settings_change_failed","输出修改过的配置失败");
      return ;
    }else{
      $this->json_e("1","Normal","1","0","修改成功");
      return ;
    }
  }

}
?>
