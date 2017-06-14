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
      $this->json_e("1","Normal","0","settings_modify_failed","错误的修改信息");
      return ;
    }
    $D = DIRECTORY_SEPARATOR;
    $file = ".{$D}config".C("CONFIG_EXT");
    if( !is_file($file) ){
      $this->json_e("1","Normal","0","settings_modify_failed","全局配置文件不存在");
      return ;
    }
    // 载入源设置
    include $file;
    $options = explode("-",$_POST['name']);
    $name = end($options);
    $value = $_POST['value'];
    $int_array = array("1","2","3","4","5","6","7","8","9","0");
    if( in_array($value,$int_array) ){
      $typechanger = "int";
    }else if( $value == "true" || $value == "false" ){
      $typechanger = "boolean";
    }else{
      $typechanger = "string";
    }

    if($typechanger == "int"){
      $value = (int)$value;
    }else if($typechanger == "boolean"){
      $value = ($value == "true") ? true : false;
    }else{
      $value = (string)$value;
    }

    if( reset($options) == "TPL" ){
      $config['TPL'][$name] = $value;
    }else{
      $config[$name] = $value;
    }

    $linefeed = PHP_EOL;
    $content = "<?php{$linefeed}\$config=".var_export($config,true).";";
    if(!\TUnit\Storage\StorageCore::Put($file ,$content)){
      $this->json_e("1","Normal","0","settings_modify_failed","输出修改过的配置失败");
      return ;
    }else{
      $this->json_e("1","Normal","1","0","修改成功");
      return ;
    }
  }
  /**
   * 修改OAM设置
   * @param  void
   * @return void
  **/
  public function oam_change(){
    if( !isset($_POST['action']) || !isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['value']) ){
      $this->json_e("1","Normal","0","settings_modify_failed","错误的修改信息");
      return ;
    }
    $D = DIRECTORY_SEPARATOR;
    $file = ".{$D}config".C("CONFIG_EXT");
    if( !is_file($file) ){
      $this->json_e("1","Normal","0","settings_modify_failed","全局配置文件不存在");
      return ;
    }
    // 载入源设置
    include $file;
    $type = $_POST['type'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    // 动作判断
    if( $_POST['action'] == "delete" ){
      if( isset($config['OAM'][$type][$name]) ){
        unset($config['OAM'][$type][$name]);
      }else{
        $this->json_e("1","Normal","0","settings_delete_failed","全局配置文件中不存在需要删除的信息");
        return ;
      }
    }else if( $_POST['action'] == "modify" ){
      if( isset($config['OAM'][$type][$name]) ){
        $config['OAM'][$type][$name] = $value;
      }else{
        $this->json_e("1","Normal","0","settings_modify_failed","全局配置文件中不存在需要删除的信息");
        return ;
      }
    }else if( $_POST['action'] == "add" ){
      $config['OAM'][$type][$name] = $value;
    }else{
      $this->json_e("1","Normal","0","settings_wrong_action","您的请求无法执行：{$_POST['action']}");
      return ;
    }
    $linefeed = PHP_EOL;
    $content = "<?php{$linefeed}\$config=".var_export($config,true).";";
    if(!\TUnit\Storage\StorageCore::Put($file ,$content)){
      $this->json_e("1","Normal","0","settings_modify_failed","输出修改过的配置失败");
      return ;
    }else{
      $this->json_e("1","Normal","1","0","修改成功");
      return ;
    }
  }

}
?>
