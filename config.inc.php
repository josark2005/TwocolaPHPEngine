<?php
$config = array (
  "APP_MODULE" => "default",  //用于创建MODULE
  "APP_TPL_FIX" => ".tpl",
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
  /* 子域名绑定应用（MODULE） */
  // 由于子域名绑定会出现许多使用问题，故从3.0版本起屏蔽且不会随版本进行修复优化。
  // "SUBDOMAIN_BINDING" => array(),
  /* 域名绑定应用（MODULE） */
  "DOMAIN_BINDING" => array(
    //域名 => MODULE
  ),
);
?>
