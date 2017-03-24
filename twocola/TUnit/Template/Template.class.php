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
** TCE引擎模板处理核心类
** Ver 1.0.3.2401
*/
namespace TUnit\Template;
class Template {
  //-----存储区
  /*
  ** 模板临时存储
  ** @param  string $content
  */
  static public $Content =  "";

  /*
  ** 变量传递临时存储
  ** @param  string $content
  */
  static public $assign  =  "";


  /*
  ** 显示处理完成的页面
  ** @param  string $title
  ** @return void
  */
  static public function show($title = false){
    $D = DIRECTORY_SEPARATOR;
    // 判断是否设置禁止访问
    // ==更新== ==支持自定义错误模板==
    if( C("APP_RESPONSE") == false ){
      $content = getPresetTpl("App/Error/NoResponse");
    }else if( !is_file(APP_PATH.$D.C("APP").$D."View".$D.C("CONTROLLER").$D.C("METHOD").C("TPL_EXT")) ){
      self::showError("E_S01_P0","模板文件不存在。");
      return ;
    }else{
      $content = file_get_contents(APP_PATH.$D.C("APP").$D."View".$D.C("CONTROLLER").$D.C("METHOD").C("TPL_EXT"));
    }
    if( $title!= false ){
      self::assign("TITLE",$title);   // 传递标题
    }
    self::ProcessTpl($content);       // 处理并临时存储模板文件
    include( self::GeneralCache() );  // 生成缓存并显示页面
    return ;
  }

  /*
  ** 直接展示内容
  ** @param  string $content
  ** @return void
  */
  static public function showContent($content){
    self::ProcessTpl($content);
    include( self::GeneralCache() );
    return ;
  }

  static public function showError($errCode,$reason){
    if(APP_DEBUG===true){
      self::assign("errCode",$errCode);                  // 传递变量
      self::assign("error",$reason);
      $content = getPresetTpl("TUnit/Error/Default");    // 获取模板
      $content = self::ProcessTpl($content);             // 处理模板
      $content = self::GeneralCache(false,"_".$errCode); // 生成缓存并获取路径
    }else{
      $content = getPresetTpl("TUnit/Error/ErrorException_Secure"); // 获取模板
      $content = self::ProcessTpl($content);                        // 处理模板
      $content = self::GeneralCache(false,"_".$errCode);            // 生成缓存并获取路径
    }
    include($content);                                   // 展示页面
  }

  /*
  ** 传递变量
  ** @param  string $name  模板上的变量名
  ** @param  string $var   真实变量
  ** @return void
  */
  /* 替换变量，格式{$变量名} */
  static public function assign($name,$var){
    self::$assign .= "<?php \${$name}=".var_export($var,true)." ?>".self::$assign;
  }

  /*
  ** 输出生成缓存文件
  ** @param  string $content     要输出的内容
  ** @return string $filename    缓存文件路径
  */
  static public function GeneralCache($content=false,$filename=false){
    $D = DIRECTORY_SEPARATOR;
    // $filename = ($filename === false) ? C("APP")."_".C("CONTROLLER")."_".C("METHOD")."_".rand(0,9999999).C("CACHE_EXT") : $filename."_".rand(0,9999999).C("CACHE_EXT");
    $filename = ($filename === false) ? C("APP")."_".C("CONTROLLER")."_".C("METHOD").C("CACHE_EXT") : $filename.C("CACHE_EXT");
    $filename = APP_PATH.$D.C("APP").$D."Runtime".$D."Cache".$D.$filename;
    $content  = ($content  === false) ? self::$Content : $content;
    \TUnit\Storage\StorageCore::Put($filename,$content);
    return $filename;
  }

  //-----模板处理

  /**
  * 获取处理完的模板
  * @param  void
  * @return string
  **/
  static public function GetProcessedTpl(){
    return self::$Content;
  }

  /**
  * 模板集合处理
  * @param  string $content
  * @return void
  **/
  static public function ProcessTpl($content){
    $content = self::ClearComment($content);   // 清除注释
    $content = self::IncludeTpl($content);     // 引用模板
    $content = self::ClearComment($content);   // 清除模板注释
    $content = self::Variable($content);       // 模板标签集合处理
    $content = self::MagicTag($content);       // 魔术标签
    $content = self::VarReference($content);   // 变量引用
    $content = self::ConReference($content);   // 常量引用
    $content = self::SVarReference($content);  // 特殊变量引用
    $content = self::CreateURL($content);      // 生成链接
    $content = self::$assign.$content;   // 传递变量并临时存储模板
    self::$assign  = "";                       // 清空变量传递临时存储区
    self::$Content = $content;
    return ;
  }

  /**
  * 自定义魔法变量
  * @param  string $content 初始内容
  * @param  string $pattern 正则表达式
  * @param  string $text    替换文本
  * @return string $content 结果内容
  **/
  static public function CustomizeVar($content,$pattern,$text){
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0; $i<count($matches[0]); $i++){
        $origin  =  $matches[0][$i];
        $wt      =  $matches[1][$i];
        $content =  str_replace($origin,$wt,$content);
      }
    }
    return $content;
  }

  /**
   * 模板标签集合处理
   * @param  string  $content 内容
   * @return string  $content
  **/
  static public function Variable($content){
    // 出错修复区
    /* $content = str_replace("<else />","<?php else: ?>",$content); //通用else替换 */
    $content = str_ireplace("<else />","<?php else: ?>",$content); //通用else替换
    $content = self::Tag_If($content);
    $content = self::Tag_Empty($content);
    $content = self::Tag_Volist($content);
    $content = self::Tag_NotEmpty($content);
    return $content;
  }

  /**
   * Volist标签
   * @param  string  $content 内容
   * @return string  $content
  **/
  static public function Tag_Volist($content){
    // 出错修复区
    /* $content = str_replace("</volist>","<?php endforeach;endif; ?>",$content); */
    $content = str_ireplace("</volist>","<?php endforeach;endif; ?>",$content);
    // 处理标准Volist
    $pattern = "/<volist[\s]*name=['|\"](.+)['|\"][\s]*value=['|\"](.+)['|\"][\s]*key=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(is_array(\${$matches[1][$i]}) && !empty(\${$matches[1][$i]})):foreach(\${$matches[1][$i]} as \${$matches[3][$i]}=>\${$matches[2][$i]}): ?>",$content);
      }
    }
    // 处理标准Volist 2
    $pattern = "/<volist[\s]*name=['|\"](.+)['|\"][\s]*key=['|\"](.+)['|\"][\s]*value=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(is_array(\${$matches[1][$i]}) && !empty(\${$matches[1][$i]})):foreach(\${$matches[1][$i]} as \${$matches[2][$i]}=>\${$matches[3][$i]}): ?>",$content);
      }
    }
    // 处理简化Volist
    $pattern = "/<volist[\s]*name=['|\"](.+)['|\"][\s]*value=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(is_array(\${$matches[1][$i]}) && !empty(\${$matches[1][$i]})):foreach(\${$matches[1][$i]} as \${$matches[2][$i]}): ?>",$content);
      }
    }
    return $content;
  }

  /**
   * Empty标签
   * @param  string  $content 内容
   * @return string  $content
  **/
  static public function Tag_Empty($content){
    // 出错修复区
    /* $content = str_replace("</empty>","<?php endif; ?>",$content);
    $content = str_replace("<else />","<?php else: ?>",$content); */
    $content = str_ireplace("</empty>","<?php endif; ?>",$content);
    $content = str_ireplace("<else />","<?php else: ?>",$content);
    $pattern = "/<empty[\s]*name=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(empty(\${$matches[1][$i]})): ?>",$content);
      }
    }
    return $content;
  }

  /**
   * NotEmpty标签
   * @param  string  $content 内容
   * @return string  $content
  **/
  static public function Tag_NotEmpty($content){
    // 出错修复区
    /* $content = str_replace("</notempty>","<?php endif; ?>",$content); */
    $content = str_ireplace("</notempty>","<?php endif; ?>",$content);
    $pattern = "/<notempty[\s]*name=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(!empty(\${$matches[1][$i]})): ?>",$content);
      }
    }
    return $content;
  }

  /**
   * IF标签
   * @param  string  $content 内容
   * @return string  $content
  **/
  static public function Tag_If($content){
    // 出错修复区
    /* $content = str_replace("</if>","<?php endif; ?>",$content); */
    $content = str_ireplace("</if>","<?php endif; ?>",$content);
    $pattern = "/<if[\s]*condition=['|\"](.+)['|\"][\s]*>/iUm";
    $preg = preg_match_all($pattern,$content,$matches_font);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches_font[0][$i],"<?php if({$matches_font[1][$i]}): ?>",$content);
      }
    }
    $pattern = "/<else[\s]*condition=['|\"](.+)['|\"][\s]*\/>/iUm";
    $preg = preg_match_all($pattern,$content,$matches_end);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches_end[0][$i],"<?php elseif({$matches_end[1][$i]}): ?>",$content);
      }
    }
    return $content;
  }
  /**
  * 魔术标签
  * @param  string $content
  * @return string $content
  **/
  /* 支持模板符号__CSS:index__ */
  static public function MagicTag($content){
    $D = DIRECTORY_SEPARATOR;
    $tpath = APP_PATH.$D.C("APP")."{$D}View$D";
    $tpath_p = APP_PATH.$D.C("APP")."{$D}View$D"."PUBLIC".$D;
    /*配套CSS*/
    $pattern = "/__CSS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$tpath.C("CONTROLLER")."/css/".$matches[1][$i].CSS_EXT,$content);
      }
    }
    /*配套JS*/
    $pattern = "/__JS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$tpath.C("CONTROLLER")."/js/".$matches[1][$i].JS_EXT,$content);
      }
    }
    /*配套IMG*/
    $pattern = "/__IMG:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$tpath.C("CONTROLLER")."/img/".$matches[1][$i],$content);
      }
    }
    /*公共静态文件*/
    $pattern = "/__STATIC:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$tpath_p."static/".$matches[1][$i],$content);
      }
    }
    return $content;
  }


  /**
   * 清除注释
   * @param  string  $content 内容
   * @param  boolean $lf      是否清除换行
   * @return string  $content
  **/
  static public function ClearComment($content,$lf=false){
    $pattern = "/<!--([\s\S]*)-->/iU";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"",$content);
      }
    }
    // 清除换行
    if($lf === true){
      $content = str_replace(PHP_EOL,"",$content);
    }
    return $content;
  }

  /**
  * 变量引用
  * @param  string  $content 内容
  * @return string  $content
  **/
  static public function VarReference($content){
    $pattern = "/[\{|\`][\$](.*)[\}|\`]/U"; //兼容 `|{}两种定界符号
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"<?php if(isset(\${$matches[1][$i]})){echo (\${$matches[1][$i]});} ?>",$content);
      }
    }
    return $content;
  }

  /**
  * 常量引用
  * @param  string  $content 内容
  * @return string  $content
  **/
  static public function ConReference($content){
    $pattern = "/{__(.+)__}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      //去除重复
      $matches[0] = array_unique($matches[0]);
      $matches[1] = array_unique($matches[1]);
      $i = 0;
      $res = "";
      foreach($matches[0] as $match){
        $res[0][$i] = $match;
        $i++;
      }
      $i = 0;
      foreach($matches[1] as $match){
        $res[1][$i] = $match;
        $i++;
      }
      $matches = $res;
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"<?php echo @C(\"{$matches[1][$i]}\"); ?>",$content);
      }
    }
    return $content;
  }

  /**
  * 特殊变量引用
  * @param  string  $content 内容
  * @return string  $content
  **/
  /* 支持模板标签：{!Cookie:xxx}等变量调用 */
  static public function SVarReference($content){
    $pattern = "/{!(.+):(.+)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];  //源代码
        $content = str_replace($origin,"<?php if(isset(\$_{$matches[1][$i]}['{$matches[2][$i]}'])){echo (\$_{$matches[1][$i]}['{$matches[2][$i]}']);} ?>",$content);
      }
    }
    return $content;
  }

  /**
  * 模板引用
  * @param  string  $content 内容
  * @return string  $content
  **/
  /* 支持模板标签：<include file='PUBLIC-header' type='autoheader' /> */
  static public function IncludeTpl($content){
    $D = DIRECTORY_SEPARATOR;
    $P_APP_TPL = APP_PATH.$D.C("APP").$D."View".$D;
    $P_APP_PUBLIC_TPL = $P_APP_TPL."PUBLIC".$D;
    $APP = C("APP");
    $METHOD = C("METHOD");
    $CONTROLLER = C("CONTROLLER");
    $JS = C("JS_EXT");
    $CSS = C("CSS_EXT");
    $TPL = C("TPL_EXT");
    $pattern = "/\<include file=['|\"](.+)-(.+)['|\"](?:[\s]+type=['|\"](.+)['|\"][\s]*|[\s]*)\/\>/iU";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];  //源代码
        // 公共文件
        if($matches[1][$i]=="PUBLIC"){
          // 判断type
          if($matches[3][$i]=="autoheader"){
            // 自动载入配套js/css
            $extra = "";
            if(file_exists($P_APP_TPL.$CONTROLLER."{$D}css{$D}".$METHOD.$CSS)){
              $extra .= "<link rel='stylesheet' href='__CSS:{$METHOD}__'>";
            }
            if(file_exists($P_APP_TPL.$CONTROLLER."{$D}js{$D}".$METHOD.$JS)){
              $extra .= "<script src='__JS:{$METHOD}__'></script>";
            }
            $text = \TUnit\Storage\StorageCore::Read($P_APP_PUBLIC_TPL."html{$D}{$matches[2][$i]}{$TPL}");
            $content = (!$text) ? $content : str_replace($origin,"{$text}\n{$extra}",$content);
          }else{
            // 常规输出
            $text = \TUnit\Storage\StorageCore::Read($P_APP_PUBLIC_TPL."html{$D}{$matches[2][$i]}{$TPL}");
            $content = (!$text) ? $content : str_replace($origin,$text,$content);
          }
        }else{
          // 自有文件
          $text = \TUnit\Storage\StorageCore::Read($P_APP_TPL."{$matches[1][$i]}{$D}{$matches[2][$i]}{$TPL}");
          $content = (!$text) ? $content : str_replace($origin,$text,$content);
        }
      }
    }
    return $content;
  }

  /**
  * 路径生成函数
  * @param  string $content 内容
  * @return string $content 内容
  **/
  static public function CreateURL($content){
    $pattern = "/{:U\(['|\"](.*)['|\"]\)}/iU";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      // 去除重复
      $matches[0] = array_reverse($matches[0]);
      $matches[1] = array_reverse($matches[1]);
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];
        $paths = $matches[1][$i];
        $content = str_replace($origin,U($paths),$content);
      }
    }
    return $content;
  }

}
?>
