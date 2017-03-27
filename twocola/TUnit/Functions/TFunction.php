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
** TCE引擎核心Funciotn
** Ver 1.2.3.2701
*/
/* C函数 读取配置 */
function C($var="none",$content=""){
  $conf = TUnit\TConfigCore::IO();
  if(empty($content)){
    if(!$conf->ConfigExists($var)){
      //读取常量
      return (defined($var)) ? constant($var) : false;
    }else{
      return $conf->ReadPointedConfig($var);  //返回配置
    }
  }else{
    $conf->EditConfig($var,$content); //修改配置
  }
}
/*M函数（连接数据库）*/
function M($table_name){
  $db = TUnit\Database\DatabaseLaungher::run(C("APP_DB_HOST"),C("APP_DB_PORT"),C("APP_DB_NAME"),C("APP_DB_USERNAME"),C("APP_DB_PASSWORD"));
  return $db->table(C("DB_PREFIX").$table_name);
}
/*Mx函数（多表数据库）*/
function Mx($table_name,$prefix=false){
  $db = TUnit\Database\DatabaseLaungher::run(C("APP_DB_HOST"),C("APP_DB_PORT"),C("APP_DB_NAME"),C("APP_DB_USERNAME"),C("APP_DB_PASSWORD"));
  $db->Prefix = ($prefix===false) ? C("DB_PREFIX") : $prefix;
  return $db->table($table_name,true);
}
/*U函数(生成链接)*/
function U($paths){
  // 获取GET内容
  $pattern = "/(.+)\?(.+)$/U";
  $preg = preg_match($pattern,$paths,$match);
  if($preg!=0){
    $path = $match[1];
    $get  = $match[2];
  }else{
    $path = $paths;
    $get = "";
  }
  // 判断生成链接
  $count = substr_count($path,"/");
  if($count == 0){
    return WEB_PATH;
  }
  // 判断URL模式
  if(URL_MODE == 1){
    $pget = empty($get) ? "" : "?".$get;
    // PATHINFO模式
    if(WEB_PATH=="/"){
      return WEB_PATH.$path.C("APP_SUFFIX").$pget;
    }else{
      return WEB_PATH.$path.C("APP_SUFFIX").$pget;
    }
  }else{
    // 兼容模式
    $p       = TUnit\UrlMode\UrlResolution::pathResolution($path);
    $app     = (isset($p['APP'])&&!empty($p['APP']))               ? $p['APP']        : C("APP_DEFAULT");
    $ctrl    = (isset($p['CONTROLLER'])&&!empty($p['CONTROLLER'])) ? $p['CONTROLLER'] : "index";
    $method  = (isset($p['METHOD'])&&!empty($p['METHOD']))         ? $p['METHOD']     : "index";
    $get     = (empty($get))                                       ? ""               : "&".$get;
    if(WEB_PATH=="/"){
      return WEB_PATH."?a={$app}&c={$ctrl}&m={$method}".$get;
    }else{
      return WEB_PATH."?a={$app}&c={$ctrl}&m={$method}".$get;
    }
  }

}
// E函数（生成报错）
function E($err){
  if(APP_DEBUG == true){
    ob_end_clean();
    $tpl = getPresetTpl("TUnit/ErrorException");
    //--处理模板
    exit($tpl);
  }else{
    ob_end_clean();
    exit(getPresetTpl("TUnit/ErrorException_Secure"));
  }
}
/* Cookie */
function cookie($name='',$value='',$expire=0,$path="/"){
  if(empty($name)){
    return false;
  }
  if($value==null || empty($value)){
    setcookie($name,null,time()-1,$path); //删除
  }else{
    setcookie($name,$value,$expire,$path);
  }
}
/* Vender */
function vender($file){
  if(file_exists(TCE_PATH.DIRECTORY_SEPARATOR."Vender".DIRECTORY_SEPARATOR."{$file}")){
    include_once TCE_PATH.DIRECTORY_SEPARATOR."Vender".DIRECTORY_SEPARATOR."{$file}";
    return true;
  }else{
    return false;
  }
}
/* Org */
function org($file){
  if(file_exists(TCE_PATH.DIRECTORY_SEPARATOR."Org".DIRECTORY_SEPARATOR."{$file}")){
    include TCE_PATH.DIRECTORY_SEPARATOR."Org".DIRECTORY_SEPARATOR."{$file}";
    return true;
  }else{
    return false;
  }
}
/* 获取预置模板 */
function getPresetTpl($name){
  $name = str_replace("\\",DIRECTORY_SEPARATOR,$name);
  if(file_exists(TCE_PATH.DIRECTORY_SEPARATOR."Tpl".DIRECTORY_SEPARATOR.$name.TPL_EXT)){
    return file_get_contents(TCE_PATH.DIRECTORY_SEPARATOR."Tpl".DIRECTORY_SEPARATOR.$name.TPL_EXT);
  }else{
    return false;
  }
}
