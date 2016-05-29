<?php
  $api = APP_PATH."/".PI_MODULE."/Api/".PI_CONTROLLER.".class.php";
  if(file_exists($api)){
    require($api);  //载入api模块
    $api_name = "Api\\".PI_CONTROLLER."API";
    $api = new $api_name();
    if(!method_exists($api,PI_METHOD)){
      $json = new TCE\Json();
      $json->json_e("0","The interface ".PI_METHOD." is not exist.","0","S_0x02","Failed to run interface.");
    }else{
      $method = PI_METHOD;
      $api->$method();
    }
  }else{
    $json = new TCE\Json();
    $json->json_e("0","The api ".PI_CONTROLLER." is not exist.","0","S_0x01","Failed to load.");
  }
?>
