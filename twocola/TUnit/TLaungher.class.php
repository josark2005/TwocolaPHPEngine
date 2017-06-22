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
** TCE引擎驱动类库
** Ver 1.1.6.2101
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
    // 检查应用是否允许访问
    if( C("APP_RESPONSE") == false ){
      $path = C("TPL");
      if( isset($path['NoResponse']) && $path['NoResponse'] != false ){
        $file = getUserTpl($path['NoResponse']);
        if( $file == false ){
          Template\Template::showError("E_S01_T0","自定义模板文件不存在。");
          return ;
        }else{
          include $file;
        }
      }else{
        $tpl = getPresetTpl("App/Error/NoResponse");
        Template\Template::ProcessTpl($tpl);
        $path = Template\Template::GeneralCache(false,"_Error");
        include $path;
      }
      exit();
    }
    // 自动检测模式
    if( C("RMODE") == 1 ){
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
    $D = DIRECTORY_SEPARATOR;
    $conf = TConfigCore::IO();
    // 读取全局配置
    $conf->GetConfig( ".{$D}config".C("CONFIG_EXT") );
    // Panel驱动
    Drivers\Panel::driver();
    // 获取真实APP路径
    C("APP_PATH" ,self::GetRealPath(C("APP_PATH")) );
    // 检查、修复、创建应用
    self::GeneralConsturct();
    // 设置当前模块、控制器、行为
    if(C("URL_MODE") == "0"){
      define("APP"        ,UrlMode\UrlResolution::safer(isset($_GET['a'])&&!empty($_GET['a']) ? $_GET['a'] : C("APP_DEFAULT")) );
      define("CONTROLLER" ,UrlMode\UrlResolution::safer(isset($_GET['c'])&&!empty($_GET['c']) ? $_GET['c'] : "index") );
      define("METHOD"     ,UrlMode\UrlResolution::safer(isset($_GET['m'])&&!empty($_GET['m']) ? $_GET['m'] : "index") );
    }
    if(C("URL_MODE") == "1"){
      UrlMode\UrlResolution::TCE(); // 直接定义 App/Controller/Method
    }
    // 判断应用是否存在
    if( !is_dir(".".C("APP_PATH").$D.C("APP")) ){
      // 判断是否为Panel模式
      if( C("IS_PANEL") == true ){
        // 读取Panel配置
        $conf->GetConfig(".".C("APP_PATH").$D.C("APP").$D."config".CONFIG_EXT);
        $path = C("TPL");
        if( isset($path['AppNotFound']) && $path['AppNotFound'] != false ){
          $file = getUserTpl($path['AppNotFound']);
          if( $file == false ){
            Template\Template::showError("E_S01_T2","自定义模板文件不存在。");
          }else{
            include $file;
          }
        }else{
          $tpl = getPresetTpl("App/Error/AppNotFound");
          Template\Template::ProcessTpl($tpl);
          $path = Template\Template::GeneralCache(false,"_APP_NOT_FOUND");
          include $path;
        }
      }else{
        $path = C("TPL");
        if( isset($path['AppNotFound']) && $path['AppNotFound'] != false ){
          $file = getUserTpl($path['AppNotFound']);
          if( $file == false ){
            Template\Template::showError("E_S01_T2","自定义模板文件不存在。");
          }else{
            include $file;
          }
        }else{
          $tpl = getPresetTpl("App/Error/AppNotFound");
          Template\Template::ProcessTpl($tpl);
          $path = Template\Template::GeneralCache(false,"_APP_NOT_FOUND");
          include $path;
        }
      }
      exit();
    }
    // OAM系统支持
    OneAsMuiltiple::OAM();
    // 读取应用配置
    $conf->GetConfig(".".C("APP_PATH").$D.C("APP").$D."config".CONFIG_EXT);
    // 设置默认时区
    date_default_timezone_set(C("DEFAULT_TIMEZONE"));
    // 检查其余配置
    if(URL_MODE != "0"){
      if( !C("APP_SUFFIX") ){  C("APP_SUFFIX","");   }
    }
    if(!C("APP_PATH")){
      E("[TLaungher|PRE] 配置 APP_PATH 未定义！");
    }
    // 模式配置检查
    if(URL_MODE==1 && !Storage\StorageCore::FileExist(PATH.DIRECTORY_SEPARATOR.".htaccess")){
      self::SaveFile(PATH.DIRECTORY_SEPARATOR.".htaccess" ,"TUnit/Default_Htaccess" ,1);
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
    // 检测生成APP命令是否存在不存在则创建
    if(C("APP_GENERATE")){
      self::CreateApp(C("APP_GENERATE"));
    }
    // 检测默认APP是否存在
    if(!Storage\StorageCore::FolderExist(".".C("APP_PATH")."/".C("APP_DEFAULT"))){
      self::CreateApp(C("APP_DEFAULT"));
    }
    return ;
  }

  static public function CreateApp($AppName,$AppPath=false){
    $D = DIRECTORY_SEPARATOR;
    $CL = CLASS_EXT;
    $CO = CONFIG_EXT;
    if( $AppPath == false ){
      $APP_PATH = ".".C("APP_PATH");
    }else{
      $APP_PATH = ".".self::GetRealPath($AppPath);
    }
    // Application
    self::CreateFolder( $APP_PATH );
    self::CreateFolder( $APP_PATH .$D.$AppName);
    // Api
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Api");
    // Database
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Database");
    // Upload
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Upload");
    // Runtime
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Runtime");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Runtime".$D."Cache");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Runtime".$D."Logs");
    // Controller
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Controller");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Controller".$D."Common");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Controller".$D."Behavior");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."Controller".$D."Displayer");
    // View
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."PUBLIC");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."index");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."index".$D."css");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."index".$D."js");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."index".$D."img");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."PUBLIC".$D."html");
    self::CreateFolder( $APP_PATH .$D.$AppName.$D."View".$D."PUBLIC".$D."static");
    // Files
    $Controller =   $APP_PATH .$D.$AppName.$D."Controller".$D;
    self::SaveFile( $APP_PATH .$D.$AppName.$D."config".$CO         ,"App/App_Default_Config{$CO}"                    ,1 ,$AppName);
    self::SaveFile( $APP_PATH .$D.$AppName.$D."Api".$D."index".$CL ,"App/App_Default_Api{$CL}"                       ,1 ,$AppName);
    self::SaveFile($Controller."Common".$D."BehaviorCommon".$CL    ,"App/Controller/App_Default_BehaviorCommon{$CL}" ,1 ,$AppName);
    self::SaveFile($Controller."Behavior".$D."indexBehavior".$CL   ,"App/Controller/App_Default_Behavior{$CL}"       ,1 ,$AppName);
    self::SaveFile($Controller."Displayer".$D."indexDisplayer".$CL ,"App/Controller/App_Default_Displayer{$CL}"      ,1 ,$AppName);
    return ;
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

  /**
   * 获取真实地址
   * @param  void
   * @return void
  **/
  static public function GetRealPath($path){
    // 获取真实APP路径
    $preg = preg_match("/^\.(.+)(?:[\/|\\\])*$/U" ,$path ,$match);
    if($preg != 0){
      $path = str_replace("\\",DIRECTORY_SEPARATOR,$match[1]);
      $path = str_replace("/",DIRECTORY_SEPARATOR,$path);
    }
    return $path;
  }

}
?>
