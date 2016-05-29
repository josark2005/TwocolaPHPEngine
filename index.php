<?php
/*
 * TCE框架引擎
 * Author: Jokin
 * Library: Twocola Studio
 * ISSUE: 目前仅支持REWRITE+PATHINFO模式
*/
define("APP_DEBUG",true); //调试模式
//管理员设置
define("ADMIN_EMAIL","xxx@yourdomain.com"); //设置管理员Email，建议设置成自动转发的邮箱，审批信息接收者
//发件系统设置
define("EMAIL_CHARSET","UTF-8");
define("EMAIL_HOST","smtp.yourdomain.com");
define("EMAIL_ADDRESS","noreply@yourdomain.com");
define("EMAIL_PASSWORD","password");
//应用配置
define("APP_CONFIG_MODE","include");  //应用配置模式，默认default（读取根目录下config.inc.php）
define("APP_VERSION","1.0beta");  //定义站点程序版本
define("APP_PATH","./Applications");  //定义站点程序目录
// define("APP_API_PARA","app_type");  //定义站点api模式进入参数默认app_type
define("SYSTEM_CONSTANT",true); //常规常量检查，如果环境允许建议开启以保证应用质量
define("SYSTEM_DEFAULT_MODULE","messenger"); //定义默认模块
require("./twocola/TCPHPEngine.php"); //引入框架引擎
?>
