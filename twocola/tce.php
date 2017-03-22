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

//----------------------------------
// Twocola PHP Engine(TCE)公共入口文件
//----------------------------------

define( 'FRAMENAME'   ,"TCE引擎3"         );
define( 'VERSION'     ,"3.2.3.2201"       );

// error_reporting(0);

// 检查配置
if( !defined("EXT")               ){ define("EXT"               ,".php"        );     }
if( !defined("TPL_EXT")           ){ define("TPL_EXT"           ,".tpl"        );     }

if( !defined("JS_EXT")            ){ define("JS_EXT"            ,".js"         );     }
if( !defined("CSS_EXT")           ){ define("CSS_EXT"           ,".css"        );     }

if( !defined("CACHE_EXT")         ){ define("CACHE_EXT"         ,".php"        );     }
if( !defined("CLASS_EXT")         ){ define("CLASS_EXT"         ,".class.php"  );     }
if( !defined("CONFIG_EXT")        ){ define("CONFIG_EXT"        ,".inc.php"    );     }
if( !defined("DEFAULT_TIMEZONE")  ){ define("DEFAULT_TIMEZONE"  ,"PRC"         );     }
if( !defined("DB_TYPE")           ){ define("DB_TYPE"           ,"mysql"       );     }
// 支持窝群系统
if( !defined("RMODE")             ){ define("RMODE"             ,0             );     }
if( !defined("URL_MODE")          ){ define("URL_MODE"          ,0             );     }
// 基础常量
define( 'PATH'        ,str_replace("\\",DIRECTORY_SEPARATOR,getcwd())                 );
define( 'TCE_PATH'    ,dirname(__FILE__)                                              );
define( 'TPL_PATH'    ,TCE_PATH.DIRECTORY_SEPARATOR."TPL"                             );
define( 'IS_WIN'      ,strstr(PHP_OS, 'WIN') ? 1 : 0                                  );
// 错误阻止常量
if( !defined("APP_DEFAULT")       ){ define("APP_DEFAULT"          ,"APP"      );     }
// 定义根目录
$pattern = "/\/index.php.*$/U";
$preg = preg_match($pattern,$_SERVER['PHP_SELF'],$match);
if( $preg != 0 ){ $WP = str_replace($match[0],"",$_SERVER['PHP_SELF']); }
$WP = ($WP == "") ? "/" : "".$WP."/" ;
define( "WEB_PATH"    ,$WP                                                            );
require_once(TCE_PATH.DIRECTORY_SEPARATOR."TUnit".DIRECTORY_SEPARATOR."TCoreUnit.class.php");
TUnit\TCoreUnit::start();
?>
