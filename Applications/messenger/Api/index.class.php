<?php
namespace Api;
use TCE\Api;
class indexAPI extends Api{
  public function index(){
    $this->json_e("1","Welcome! You can use our api in this way!","1","0","0");
  }
}
?>
