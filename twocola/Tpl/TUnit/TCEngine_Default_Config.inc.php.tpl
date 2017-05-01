<?php
/*
** TCE引擎全局设置
** Version: 1.3.5.0103
** Notice: APP_GENERATE可使用 APP_DEFAULT 代替 (默认APP不存在时会自动创建)
*/
$config = array (
  /* 系统设置 */
  // "APP_GENERATE"    => "APP",  // 用于创建APP
  "APP_SUFFIX"      => ".html",   // URL静态后缀（静态后缀名前必须加点以避免出现错误）
  "APP_SUFFIX_SAFE" => true,      // 自动适应其他后缀
  "APP_DEFAULT"     => "APP",     // 系统默认APP

  /* OAM系统设置 */
  "OAM"             => array(
    // 域名绑定应用
    "BDA"           => array(
      // domain=>app
    ),
    // 域名绑定应用API
    "DBAPI"         => array(
      // domain=>api
    ),
  ),

  /* 全局模板设置 */
  "TPL"             => array(
    "Error"         => false,     // 非调试状态错误提示页
    "NoResponse"    => false,
    "AppNotFound"   => false,
    "PageNotFound"  => false,
  ),

);
