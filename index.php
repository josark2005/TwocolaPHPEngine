<?php
/*
 * TCE框架引擎 V3
 * Author : Jokin惟易
 * Library: Twocola Studio
 * ISSUE  : 目前仅支持REWRITE+PATHINFO模式
*/
define("APP_DEBUG" ,true);                 //调试模式
// define("APP_DEBUG" ,false);               //调试模式
define("APP_PATH"  ,"./Applications");    //定义App目录
define("UpgradeOn" ,false);               //不启动升级模块（推荐保持原样）
define("URL_MODE"  ,1);                   //不启动升级模块（推荐保持原样）
require("./twocola/tce.php");     //引入框架引擎
?>
