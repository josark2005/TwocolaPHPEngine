<?php
 /**
  * 应用独立配置文件
  * @version：1.3.0
 **/
$config = array (
  "APP_NAME"     => "应用名称",
  "APP_VERSION"  => "1.0.0",     // 应用版本（可留空）
  "APP_RESPONSE" => true,        // 设置为false则拒绝访问
  "DB_TYPE"      => "Mysql",     // SQLite请直接使用函数访问
  "DB_HOST"      => "localhost",
  "DB_PORT"      => 3306,
  "DB_NAME"      => "",
  "DB_USERNAME"  => "",
  "DB_PASSWORD"  => "",
  "DB_PREFIX"    => "",
  "DB_CHARSET"   => "utf8",
  // 模板函数相关设置
  "APP_AUTO_FILE_VERSION" => false,
);
