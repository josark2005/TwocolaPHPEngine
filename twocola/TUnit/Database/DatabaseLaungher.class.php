<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ More Teamwork ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola STudio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** 数据库操作驱动
** Version 1.0.5.0101
*/
namespace TUnit\Database;
class DatabaseLaungher {
  static public function run($HOST,$USERNAME,$PASSWORD,$DBNAME,$PROT,$CHARSET="utf8"){
    $DB_TYPE = strtoupper(C("DB_TYPE"));
    if( $DB_TYPE == "MYSQL" || $DB_TYPE == "MYSQLI" ){
      return new Drivers\Mysql($HOST,$USERNAME,$PASSWORD,$DBNAME,$PROT,$CHARSET);
    }
  }
}
?>
