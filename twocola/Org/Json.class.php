<?php
namespace TCE;
class Json{
  public function json_c($system_status,$system_message,$app_status,$app_errno,$app_error="no error."){
    $array = array(
      "System" => array(
        "status" => $system_status,
        "message" => $system_message,
      ),
      "App" => array(
        "status" => $app_status,
        "module" => PI_MODULE,
        "controller" => PI_CONTROLLER,
        "method" => PI_METHOD,
        "errno" => $app_errno,
        "error" => $app_error,
      ),
      "Records" => array(
        "time" => date("Y-m-d H:i:s"),
      ),
    );
    return json_encode($array);
  }
  public function json_e($system_status,$system_message,$app_status,$app_errno,$app_error="no error."){
    $this->json_h();
    echo $this->json_c($system_status,$system_message,$app_status,$app_errno,$app_error);
  }
  public function json_h(){
    if(APP_DEBUG===false){
      header('Content-Type:text/json;charset=utf-8');
    }
  }

}
?>
