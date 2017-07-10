<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ DO IT　EASY ]
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

// 基础常量定义
define( 'FRAMENAME'      ,"Twocola PHP 引擎4.0"     );
define( 'FRAMENAME_EN'   ,"Twocola PHP Engine V4.0" );
define( 'VERSION'        ,"4.0.7.1001"              );

// 版本判断
if( version_compare(PHP_VERSION ,"5.6.0" ,"<") ){
  die("使用此版本TCE框架要求PHP版本为5.6以上");
}
// 报错抑制
if( APP_DEBUG != 2 ){
  error_reporting(0);
}

// 检查配置
if( !defined("EXT")                 ){ define("EXT"               ,".php"          );     }
if( !defined("TPL_EXT")             ){ define("TPL_EXT"           ,".tpl"          );     }

if( !defined("JS_EXT")              ){ define("JS_EXT"            ,".js"           );     }
if( !defined("CSS_EXT")             ){ define("CSS_EXT"           ,".css"          );     }

if( !defined("CACHE_EXT")           ){ define("CACHE_EXT"         ,".php"          );     }
if( !defined("CLASS_EXT")           ){ define("CLASS_EXT"         ,".class.php"    );     }
if( !defined("CONFIG_EXT")          ){ define("CONFIG_EXT"        ,".inc.php"      );     }
if( !defined("DB_EXT")              ){ define("DB_EXT"            ,".db"           );     }
if( !defined("DEFAULT_TIMEZONE")    ){ define("DEFAULT_TIMEZONE"  ,"PRC"           );     }
if( !defined("DB_TYPE")             ){ define("DB_TYPE"           ,"MYSQL"         );     }

// Panel Portal
if( !defined("PANEL")               ){ define("PANEL"             ,false               );     }
if( !defined("PANEL_PATH")          ){ define("PANEL_PATH"        ,"./twocola/Panel"   );     }
  // 入口方式： 1 GET 2 默认进入
if( !defined("PANEL_PORTAL")        ){ define("PANEL_PORTAL"      ,1           );     }
  // 此设置仅对GET方式进入生效
if( !defined("PANEL_PORTAL_KEY")    ){ define("PANEL_PORTAL_KEY"  ,"panel"     );     }
if( !defined("PANEL_PORTAL_VALUE")  ){ define("PANEL_PORTAL_VALUE","tce"       );     }

// Api Portal
if( !defined("API_PORTAL")          ){ define("API_PORTAL"      ,1             );     }
  // 此设置仅对GET方式进入生效
if( !defined("API_PORTAL_KEY")      ){ define("API_PORTAL_KEY"  ,"apimode"     );     }
if( !defined("API_PORTAL_VALUE")    ){ define("API_PORTAL_VALUE","true"        );     }

// 窝群系统驱动
  // 运行模式： 1 APP 2 API
if( !defined("RMODE")             ){ define("RMODE"             ,1             );     }
  // 地址模式： 0兼容 1 Pathinfo
if( !defined("URL_MODE")          ){ define("URL_MODE"          ,0             );     }

// 基础常量
define( 'PATH'        ,str_replace("\\",DIRECTORY_SEPARATOR,getcwd())                 );
define( 'TCE_PATH'    ,str_replace("\\",DIRECTORY_SEPARATOR,str_replace(PATH,".",dirname(__FILE__))));
define( 'TPL_PATH'    ,TCE_PATH.DIRECTORY_SEPARATOR."TPL"                             );
define( 'IS_WIN'      ,strstr(PHP_OS, 'WIN') ? 1 : 0                                  );
// 默认设置 常量
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
