<?php
/* 调用以下常量需添加前缀 APP_ */
$config = array (
  "MODULE" => "default",  //用于创建MODULE
  "TPL_FIX" => ".tpl",
  "SYSTEM_CONSTANT" => true,  //系统常量自检
  "SYSTEM_SUFFIX" => ".html",
  "SYSTEM_DEFAULT_MODULE" => "default", //系统默认模块
  "APP_API_PARA" => "app_type", //模式切换get量
  /* 邮件系统设置 */
  "EMAIL_CHARSET" => "UTF-8",
  "EMAIL_HOST" => "smtp.yourdomain.com",
  "EMAIL_PORT" => 25,
  "EMAIL_ADDRESS" => "noreply@yourdomain.com",
  "EMAIL_PASSWORD" => "password",
);
?>
