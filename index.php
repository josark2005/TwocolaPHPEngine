<?php
/*
 * TCE框架引擎
 * Author: Jokin惟易
 * Library: Twocola Studio
 * ISSUE: 目前仅支持REWRITE+PATHINFO模式
*/
// !Notice! --配置请写在./config.inc.php与应用模块目录下的config.inc.php
define("APP_DEBUG",true); //调试模式
define("APP_PATH","./Applications");
require("./twocola/TCPHPEngine.php"); //引入框架引擎
/* WARNING */
//以下配置请慎重！
//这个配置设置了一个“秘密”入口
// $GLOBALS["sconfig"]['upgrade_enterence'] = "default_upgrade_enterence"; //设置为null为关闭
//秘密入口的密码
// $GLOBALS["sconfig"]['upgrade_enterence_pw'] = "default_pw";
//当GET中出现[default_upgrade_enterence]=[default_pw]时可查看框架自动升级的相关信息
/* ./WARNING */
?>
