<?php
  $api = TCE_PATH."/API/".PI_BEHAVIOR.".class.php";
  if(file_exists($api)){
    require($api);  //载入api模块
    $api_name = PI_BEHAVIOR."API";
    $api = new $api_name();
    if(!method_exists($api,PI_METHOD)){
      $json = new Json();
      $json->json_e("0","The interface ".PI_METHOD." is not exist.","0","S_0x02","Failed to run interface.");
    }else{
      $method = PI_METHOD;
      $api->$method();
    }
  }else{
    $json = new Json();
    $json->json_e("0","The api ".PI_BEHAVIOR." is not exist.","0","S_0x01","Failed to load.");
  }
?>
