<?php
class tplbuilderBehavior extends BehaviorCommon{
  public function B_C_tplbuilder_test(){
    cookie("testCookie","<span style='color:green'>Cookie函数正常</span>");
    define("TESTCONSTANT","<span style='color:green'>常量函数正常</span>");
    $volist1 = array(
      "t1" => "1",
      "t2" => "2",
      "t3" => "3",
      "t4" => "4",
      "t5" => "5",
      "t6" => "6",
      "t7" => "7",
    );
    $this->assign("volist1",$volist1);
    $this->assign("notempty","<span style='color:green;'>NotEmpty函数正常</span>");
  }
}
?>
