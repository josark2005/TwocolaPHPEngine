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
** TCE引擎驱动类库
** Ver 1.0
*/
/* URL_MODE解释    0:兼容模式   1:Rewrite/Pathinfo模式 */
namespace TUnit;
class TLaungher {

  /**
  * 引擎启动驱动
  * @param  void
  * @return void
  **/
  static public function Run(){
    // 检查并进行配置
    self::ConfigChecker();
    // 检查、修复、创建应用
    self::GeneralConsturct();
    // 检查应用是否允许访问
    if( C("APP_RESPONSE") == false ){
      $tpl = getPresetTpl("App/Error/NoResponse");
      Template\Template::ProcessTpl($tpl);
      $path = Template\Template::GeneralCache(false,"_Error");
      include ( $path );
      exit();
    }
    // 自动检测模式
    if( C("RMODE") == false ){
      // 运行应用
      App::run();
    }else{
      // Api模式
      Api::run();
    }
  }

  /**
  * 检查配置
  * @param  void
  * @return void
  **/
  static public function ConfigChecker(){
    // 读取全局配置
    $D = DIRECTORY_SEPARATOR;
    $conf = TConfigCore::IO();
    $conf->GetConfig(".{$D}config".CONFIG_EXT);
    // 设置当前模块、控制器、行为
    if(URL_MODE == "0"){
      define("APP"        ,isset($_GET['a'])&&!empty($_GET['a']) ? $_GET['a'] : C("APP_DEFAULT") );
      define("CONTROLLER" ,isset($_GET['c'])&&!empty($_GET['c']) ? $_GET['c'] : "index" );
      define("METHOD"     ,isset($_GET['m'])&&!empty($_GET['m']) ? $_GET['m'] : "index" );
    }
    if(URL_MODE == "1"){
      UrlMode\UrlResolution::TCE(URL_MODE); //直接定义 App/Controller/Method
    }
    // OAM系统支持
    OneAsMuiltiple::OAM();
    // 读取应用配置
    $conf->GetConfig(APP_PATH.$D.C("APP").$D."config".CONFIG_EXT);
    // 检查其余配置
    if(URL_MODE != "0"){
      if( !C("APP_SUFFIX") ){  C("APP_SUFFIX","");   }
    }
    if(!C("APP_PATH")){
      E("[TLaungher|PRE] 配置 APP_PATH 未定义！");
    }
    // 模式配置检查
    if(URL_MODE==1 && !Storage\StorageCore::FileExist(PATH.DIRECTORY_SEPARATOR.".htaccess")){
      $content = getPresetTpl("TUnit/Default_Htaccess".TPL_EXT);
      if(!Storage\StorageCore::CreateSave(PATH.DIRECTORY_SEPARATOR.".htaccess")){
        E("自动配置htaccess文件失败，请确认目录： ".PATH.DIRECTORY_SEPARATOR." 是否拥有读写权限！");
        exit();
      }
    }
    // 创建全局配置文件
    self::SaveFile(PATH.DIRECTORY_SEPARATOR."config".CONFIG_EXT ,"TUnit/TCEngine_Default_Config".CONFIG_EXT ,1);
  }

  /**
  * 应用相关文件（夹）检查、修复、创建
  * @param  void
  * @return void
  **/
  static public function GeneralConsturct(){
    // 检测默认APP是否存在不存在则创建
    if(C("APP_GENERATE")){
      self::CreateApp(C("APP_GENERATE"));
    }
    // 检测默认APP是否存在
    if(!Storage\StorageCore::FolderExist(APP_PATH."/".C("APP_DEFAULT"))){
      self::CreateApp(C("APP_DEFAULT"));
      exit();
    }
    return ;
  }
  static private function CreateApp($AppName){
    $D = DIRECTORY_SEPARATOR;
    $CL = CLASS_EXT;
    $CO = CONFIG_EXT;
    // Application
    self::CreateFolder(APP_PATH);
    self::CreateFolder(APP_PATH.$D.$AppName);
    // Api
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Api");
    // Runtime
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Runtime");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Runtime".$D."Cache");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Runtime".$D."Logs");
    // Controller
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Controller");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Controller".$D."Common");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Controller".$D."Behavior");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."Controller".$D."Displayer");
    // View
    self::CreateFolder(APP_PATH.$D.$AppName.$D."View");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."View".$D."PUBLIC");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."View".$D."index");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."View".$D."PUBLIC".$D."html");
    self::CreateFolder(APP_PATH.$D.$AppName.$D."View".$D."PUBLIC".$D."static");
    // Files
    $Controller = APP_PATH.$D.$AppName.$D."Controller".$D;
    self::SaveFile(APP_PATH.$D.$AppName.$D."config".$CO            ,"App/App_Default_Config{$CO}"                    ,1 ,$AppName);
    self::SaveFile(APP_PATH.$D.$AppName.$D."Api".$D."index".$CL    ,"App/App_Default_Api{$CL}"                       ,1 ,$AppName);
    self::SaveFile($Controller."Common".$D."BehaviorCommon".$CL    ,"App/Controller/App_Default_BehaviorCommon{$CL}" ,1 ,$AppName);
    self::SaveFile($Controller."Behavior".$D."indexBehavior".$CL   ,"App/Controller/App_Default_Behavior{$CL}"       ,1 ,$AppName);
    self::SaveFile($Controller."Displayer".$D."indexDisplayer".$CL ,"App/Controller/App_Default_Displayer{$CL}"      ,1 ,$AppName);
  }

  /**
  * 创建文件夹
  * @param  string $path 文件夹路径
  * @return void
  **/
  static private function CreateFolder($path){
    if(!Storage\StorageCore::FolderExist($path)){
      if(!Storage\StorageCore::CreateFolder($path)){
        E("应用文件夹创建失败，请确认目录： ".$path." 是否拥有读写权限！");
        exit();
      }
    }
    return ;
  }

  /**
  * 保存文件
  * @param  string $path    文件路径
  * @param  string $content 文件内容
  * @param  string $tpl     是否存在模板魔法变量
  * @param  string $AppName 应用APP常量
  * @return void
  **/
  static private function SaveFile($path,$content,$tpl=0,$AppName=""){
    if(!Storage\StorageCore::FileExist($path)){
      if($tpl == 1){
        $content = getPresetTpl($content);
        $content = self::TplResolution($content ,$AppName);
      }
      if(!Storage\StorageCore::CreateSave($path ,$content)){
        E("文件创建失败，请确认目录： ".$path." 是否拥有读写权限！");
        exit();
      }
    }
    return ;
  }

  /**
  * 模板变量替换
  * @param  string $content 模板内容
  * @param  string $AppName 应用名称
  * @return string $content
  **/
  static private function TplResolution($content ,$AppName=""){
    $content = str_replace("{__APP__}" ,$AppName ,$content);
    return $content;
  }

//--
}
?>
