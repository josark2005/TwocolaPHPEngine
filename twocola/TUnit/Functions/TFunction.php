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
** TCE引擎核心方法
** Ver 1.2.5.2801
*/
/**
 * 读取存储配置
 * @param  var string
 * @param  content string
 * @return string/boolean
**/
function C($var="none",$content=""){
  $conf = TUnit\TConfigCore::IO();
  if(empty($content)){
    if(!$conf->ConfigExists($var)){
      //读取常量
      return (defined( strtoupper($var) )) ? constant( strtoupper($var) ) : false;
    }else{
      return $conf->ReadPointedConfig($var);  //返回配置
    }
  }else{
    $conf->EditConfig($var,$content); //修改配置
  }
}

/**
 *自动连接数据库
 * @param  table_name string
 * @param  prefix string/boolean
 * @return object/boolean
**/
function M($table_name ,$prefix=true){
  $db = TUnit\Database\DatabaseLaungher::run();
  if($prefix == true){
    return $db->table(C("DB_PREFIX").$table_name);
  }elseif($prefix == false){
    return $db->table($table_name);
  }else{
    return $db->table($prefix.$table_name);
  }
}
/**
 * 自动连接数据库（多表）
 * @param  table_name string
 * @param  prefix string/boolean
 * @return object/boolean
**/
function Mx($table_name,$prefix=false){
  $db = TUnit\Database\DatabaseLaungher::run();
  $db->Prefix = ($prefix===false) ? C("DB_PREFIX") : $prefix;
  return $db->table($table_name,true);
}

/**
 * 链接生成
 * @param  paths string
 * @return string
**/
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
    return C("WEB_PATH");
  }
  // 判断URL模式
  if(C("URL_MODE") == 1){
    $pget = empty($get) ? "" : "?".$get;
    // PATHINFO模式
    if(C("WEB_PATH")=="/"){
      return C("WEB_PATH").$path.C("APP_SUFFIX").$pget;
    }else{
      return C("WEB_PATH").$path.C("APP_SUFFIX").$pget;
    }
  }else{
    // 兼容模式
    $p       = TUnit\UrlMode\UrlResolution::pathResolution($path);
    $app     = (isset($p['APP'])&&!empty($p['APP']))               ? $p['APP']        : C("APP_DEFAULT");
    $ctrl    = (isset($p['CONTROLLER'])&&!empty($p['CONTROLLER'])) ? $p['CONTROLLER'] : "index";
    $method  = (isset($p['METHOD'])&&!empty($p['METHOD']))         ? $p['METHOD']     : "index";
    $get     = (empty($get))                                       ? ""               : "&".$get;
    if(C("WEB_PATH")=="/"){
      return C("WEB_PATH")."?a={$app}&c={$ctrl}&m={$method}".$get;
    }else{
      return C("WEB_PATH")."?a={$app}&c={$ctrl}&m={$method}".$get;
    }
  }

}
/**
 * 生成报错
 * @param  err string
 * @return void
**/
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
/**
 * COOKIE操作
 * @param  name string
 * @param  value string
 * @param  expire int
 * @param  path string
 * @param  domain string
 * @return void
**/
function cookie($name='',$value='',$expire=0,$path="/",$domain=null){
  if(empty($name)){
    return false;
  }
  if($value==null || empty($value)){
    setcookie($name,null,time()-1,$path); //删除
  }else{
    setcookie($name,$value,$expire,$path);
  }
}
/**
 * 第三方类库
 * @param  file string
 * @return boolean
**/
function vender($file){
  $D = DIRECTORY_SEPARATOR;
  if(file_exists(C("TCE_PATH").$D."Vender".$D."{$file}")){
    include_once C("TCE_PATH").$D."Vender".$D."{$file}";
    return true;
  }else{
    return false;
  }
}
/**
 * 官方插件库
 * @param  file string
 * @return void
**/
function org($file){
  $D = DIRECTORY_SEPARATOR;
  if(file_exists(C("TCE_PATH").$D."Org".$D."{$file}")){
    include C("TCE_PATH").$D."Org".$D."{$file}";
    return true;
  }else{
    return false;
  }
}
/**
 * 获取预置模板
 * @param  name string
 * @return string/boolean
**/
function getPresetTpl($name){
  $D = DIRECTORY_SEPARATOR;
  $name = str_replace("\\",$D,$name);
  if(file_exists(C("TCE_PATH").$D."Tpl".$D.$name.C("TPL_EXT"))){
    return file_get_contents(C("TCE_PATH").$D."Tpl".$D.$name.C("TPL_EXT"));
  }else{
    return false;
  }
}
/**
 * 获取用户设置模板
 * @param  name string
 * @return string/boolean
**/
function getUserTpl($name){
  $D = DIRECTORY_SEPARATOR;
  $name = str_replace("\\" ,$D ,$name);
  // 判断是否为相对路径
  if( substr($name,0,1) == "." ){
    if( file_exists($name) ){
      return $name;
    }else{
      return false;
    }
  }else{
    // 非相对路径 进行Path解析
    $p = TUnit\UrlMode\UrlResolution::pathResolution($name);
    $app     = (isset($p['APP'])&&!empty($p['APP']))               ? $p['APP']        : C("APP_DEFAULT");
    $ctrl    = (isset($p['CONTROLLER'])&&!empty($p['CONTROLLER'])) ? $p['CONTROLLER'] : "index";
    $method  = (isset($p['METHOD'])&&!empty($p['METHOD']))         ? $p['METHOD']     : "index";
    $tpl = ".".C("APP_PATH").$D.$app.$D."View".$D.$ctrl.$D.$method.C("TPL_EXT");
    if( file_exists($tpl) ){
      $file = file_get_contents($tpl);
      \TUnit\Template\Template::ProcessTpl($file);
      $file = \TUnit\Template\Template::GeneralCache(false,"_404");
      return $file;
    }else{
      return false;
    }
  }

}
