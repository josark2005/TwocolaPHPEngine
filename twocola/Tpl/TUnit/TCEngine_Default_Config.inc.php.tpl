<?php
/**
 * TCE引擎全局设置
 * Version: 1.4.6.1101
 * Notice: APP_GENERATE可使用 APP_DEFAULT 代替 (默认APP不存在时会自动创建)
**/
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
    "BDAPI"         => array(
      // domain=>api
    ),
  ),

  /* Api入口设置 */
  "API_PORTAL"         => 1,        // 入口模式
  "API_PORTAL_KEY"     => "apimode",  // GET方式
  "API_PORTAL_VALUE"   => "true",    // GET方式

  /* 全局模板设置 */
  // 此处设置请使用相对于入口文件的路径
  "TPL"             => array(
    "Error"         => false,     // 非调试状态错误提示页
    "NoResponse"    => false,
    "AppNotFound"   => false,
    "PageNotFound"  => false,
  ),

  /* Panel设置 */
  "PANEL"              => false,
  "PANEL_PATH"         => "./twocola/Panel",  // 官方Panel位置
  "PANEL_NAME"         => "CatBoy",           // 官方适配Panel
  "PANEL_PORTAL"       => 1,
  "PANEL_PORTAL_KEY"   => "panel",
  "PANEL_PORTAL_VALUE" => "tce",

);
