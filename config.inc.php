<?php
/*
** TCE引擎全局设置
** Version: 1.2.4.0402
** !Notice: APP_GENERATE可使用 APP_DEFAULT 代替 (默认APP不存在时会自动创建)
*/
$config = array (
  // "APP_GENERATE"    => "APP",  // 用于创建APP
  "APP_SUFFIX"      => ".html",   // URL静态后缀（静态后缀名前必须加点以避免出现错误）
  "APP_SUFFIX_SAFE" => true,      // 自动适应其他后缀
  "APP_DEFAULT"     => "APP",     // 系统默认APP
  /* 邮件系统设置 */
  "EMAIL_CHARSET"   => "UTF-8",
  "EMAIL_HOST"      => "smtp.yourdomain.com",
  "EMAIL_PORT"      => 25,
  "EMAIL_ADDRESS"   => "noreply@yourdomain.com",
  "EMAIL_PASSWORD"  => "password",
  "OAM" =>  array(
    "BDAPI" => array(
      "tce2.off"  =>  "APP"
    ),
  ),
);
