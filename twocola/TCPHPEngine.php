<?php
/*Twocola Studio*/
if(APP_DEBUG===false){
  error_reporting(0);
}
session_start();
define("EZ_PATH",dirname(__FILE__));  //定义基础地址
date_default_timezone_set("PRC");//设置时区
//以下顺序请勿随意修改，否则会出现逻辑错误
/* Storage */
require(EZ_PATH."/Org/Storage/Normal.class.php");
//require(EZ_PATH."/Org/Storage/ALIOSS.class.php");
require(EZ_PATH."/Layer/Initialize.php"); //程序初始化
/* IncReader */
require(EZ_PATH."/Org/IncReader.class.php");  //配置文件核心（系统）
/* Function */
require(EZ_PATH."/Layer/Function.php");  //核心Function（系统）
/* Config Verfier */
require(EZ_PATH."/Layer/Config.php"); //配置文件驱动（系统）
/* Path_Info */
require(EZ_PATH."/Org/PathInfo.class.php"); //路径解析（系统）
require(EZ_PATH."/Layer/PathInfo.php"); //路径解析驱动（系统）
/* Info */
require(EZ_PATH."/Org/Json.class.php"); //Json系统（系统）
/* Mysqli */
require(EZ_PATH."/Org/Mysqli.class.php");  //数据库核心（系统）
/* SelfTest */
require(EZ_PATH."/Layer/ST.php"); //自检
//UI模式
if(APP_TYPE=="ui"){
  require(EZ_PATH."/Org/TemplateLoad.php"); //模板系统（系统）
  require(EZ_PATH."/Org/Authorize.class.php"); //权限系统（系统）
  require(EZ_PATH."/BaDCommon/BehaviorCommon.class.php"); //内建级公共API函数（系统）
  require(EZ_PATH."/Layer/Template.php"); //模板引擎驱动（系统）
}
if(APP_TYPE=="api"){
  require(EZ_PATH."/Org/Api.class.php");  //系统状态驱动（系统）
  require(EZ_PATH."/Layer/Api.php");  //api驱动
}
?>
