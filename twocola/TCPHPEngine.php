<?php
/*Twocola Studio*/
if(APP_DEBUG===false){
  error_reporting(0);
}
session_start();
define("TCE_PATH",dirname(__FILE__));  //定义基础地址
date_default_timezone_set("PRC");//设置时区
/* UPGRADE */
//此功能尚在开发阶段
if(@$GLOBALS["sconfig"]['upgrade_enterence']!=null) {
  $enterence = $GLOBALS["sconfig"]['upgrade_enterence'];
  $password = $GLOBALS["sconfig"]['upgrade_enterence_pw'];
  if(@$_GET[$enterence]==$password){
    echo "START-".TCE_PATH.DIRECTORY_SEPARATOR."TCE_VERSION.php"."-END<br />此路径用于升级，复制全部到升级页面指定区域即可";
    exit();
  }
}
//以下顺序请勿随意修改，否则会出现逻辑错误
/* Storage */
require_once(TCE_PATH."/Org/Storage/Normal.class.php");
// require_once(TCE_PATH."/Org/Storage/ALIOSS.class.php");
// require_once(TCE_PATH."/Layer/Initialize.php"); //程序初始化
/* IncReader */
require_once(TCE_PATH."/Org/IncReader.class.php");  //配置文件核心（系统）
/* Function */
require_once(TCE_PATH."/Layer/Function.php");  //核心Function（系统）
/* Config Verfier */
require_once(TCE_PATH."/Layer/Config.php"); //配置文件驱动（系统）
/* Path_Info */
require_once(TCE_PATH."/Org/PathInfo.class.php"); //路径解析（系统）
require_once(TCE_PATH."/Layer/PathInfo.php"); //路径解析驱动（系统）
/* Info */
require_once(TCE_PATH."/Org/Json.class.php"); //Json系统（系统）
/* Mysqli */
require_once(TCE_PATH."/Org/Mysqli.class.php");  //数据库核心（系统）
/* SelfTest */
require_once(TCE_PATH."/Layer/ST.php"); //自检核心，不需要自检可屏蔽（不推荐）
require_once(TCE_PATH."/Layer/AppConfig.php"); //配置文件驱动（系统）
//UI模式
if(APP_TYPE=="ui"){
  require_once(TCE_PATH."/Org/TemplateLoad.php"); //模板系统（系统）
  require_once(TCE_PATH."/Layer/Template.php"); //模板引擎驱动（系统）
}
//API模式(不使用可关闭/屏蔽以下代码)
if(APP_TYPE=="api"){
  if(file_exists(APP_PATH."/".PI_MODULE."/Controller/Common/Api.class.php")){
    require_once(APP_PATH."/".PI_MODULE."/Controller/Common/Api.class.php");
  }
  require_once(TCE_PATH."/Layer/Api.php");  //api驱动
}
?>
