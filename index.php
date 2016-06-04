<?php
/*
 * TCE框架引擎
 * Author: Jokin
 * Library: Twocola Studio
 * ISSUE: 目前仅支持REWRITE+PATHINFO模式
*/
// !Notice! --配置请写在./config.inc.php与应用模块目录下的config.inc.php
define("APP_DEBUG",true); //调试模式
define("APP_PATH","./Applications");
require("./twocola/TCPHPEngine.php"); //引入框架引擎
?>
