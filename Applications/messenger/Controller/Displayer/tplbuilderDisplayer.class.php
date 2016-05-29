<?php
namespace Controller;
use Controller\tplbuilderBehavior;
class tplbuilderDisplayer extends tplbuilderBehavior{
  public function index(){
    $this->B_C_tplbuilder_test();
    $this->show_t();
  }
}
?>
