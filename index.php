<?php
/*
 * TCE框架引擎 V3
 * Author : Jokin惟易
 * Library: Twocola Studio
 * ISSUE  : 目前仅支持REWRITE+PATHINFO模式
*/
define("APP_DEBUG" ,true);                 // 调试模式
define("APP_PATH"  ,"./Applications");    // 定义App目录
define("URL_MODE"  ,0);                   // URL模式：0兼容  1Pathinfo
require("./twocola/tce.php");             //引入框架引擎
?>
