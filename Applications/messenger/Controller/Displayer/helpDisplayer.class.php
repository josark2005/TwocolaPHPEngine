<?php
namespace Controller;
use Controller\helpBehavior;
class helpDisplayer extends helpBehavior{
  public function index(){
    $this->show_t("帮助中心");
  }
  public function manager(){
    $this->show_t("帮助中心");
  }
}
?>
