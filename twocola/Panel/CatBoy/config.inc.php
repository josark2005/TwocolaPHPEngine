<?php
/**
 * 应用独立配置文件
 * @version：1.3.0
**/
$config = array (
  "APP_NAME" => "CatBoy",
  "APP_VERSION" => "1.1",
  "PANEL_NAME" => "CatBoy",
  "APP_RESPONSE" => true,       //设置为false则拒绝访问
  "DB_TYPE" => "SQLite3",
  "DB_HOST" => "catboy",
  "DB_PORT" => "3306",
  "DB_NAME" => "",
  "DB_USERNAME" => "",
  "DB_PASSWORD" => "",
  "DB_PREFIX" => "",
  "DB_CHARSET" => "utf8",
  "APP_AUTO_FILE_VERSION" => false,      // 默认false

  /* Panel模板设置 */
  "TPL"             => array(
    "PageNotFound"  => "index/pnf",
    "AppNotFound"   => "index/pnf",
    "NoResponse"    => "index/nr",
  ),
);
