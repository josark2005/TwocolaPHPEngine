<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ DO IT　EASY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola Studio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** 数据库操作驱动
** Version 1.0.5.2801
*/
namespace TUnit\Database;
class DatabaseLaungher {

  static public $support = array(
    "Mysql",
  );
  static public $support_beta = array(
    "SQLite3",
  );
  static public $will_support = array(
    "暂无"
  );

  /**
   * 自动连接数据库
   * @param  void
   * @return void
  **/
  static public function run(){
    $DB_TYPE = strtoupper(C("DB_TYPE"));
    // Mysql
    if( $DB_TYPE == "MYSQL" || $DB_TYPE == "MYSQLI" ){
      return new Drivers\Mysql(C("DB_HOST"),C("DB_USERNAME"),C("DB_PASSWORD"),C("DB_NAME"),C("DB_PORT"),C("DB_CHARSET"));
    }
    // SQLite
    if( $DB_TYPE == "SQLITE" || $DB_TYPE == "SQLITE3" ){
      return new Drivers\SQLite(C("DB_HOST"),C("DB_USERNAME"),C("DB_PASSWORD"),C("DB_NAME"),C("DB_PORT"),C("DB_CHARSET"));
    }
  }
}
?>
