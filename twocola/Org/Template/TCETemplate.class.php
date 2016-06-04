<?php
/*
** TCPHPEngine模板引擎
** Version:V1.0.1.2 AD
** DevStudio:Twocola
** Authorize:Twocola.com
*/
namespace TCE;
class TemplateEngine {
  protected $TPL; //模板目录
  protected $TPL_PUBLIC;  //模板公共文件目录
  protected $wTPL;  //WEB模板目录
  protected $wTPL_PUBLIC; //WEB模板公共文件目录
  protected $_PATH; //全局变量PATH
  protected $TplSuffix = ""; //全局变量APP_TPL_FIX
  protected $Runtime; //模板存放路径(PATH)
  protected $content = ""; //页面内容
  protected $_Behavior; //全局变量PI_BEHAVIOR
  protected $_Method; //全局变量PI_METHOD
  public function __construct(){
    /* 基础路径 */
    $app_path = APP_PATH;
    $pattern = "/\.(.*)$/U";
    $preg = preg_match($pattern,$app_path,$match);
    if($preg!=0){
      $app_path = $match[1];
    }
    $this->wTPL = $app_path."/".PI_MODULE."/View/";
    $this->wTPL_PUBLIC = $app_path."/".PI_MODULE."/View/public/";
    $this->TPL = APP_PATH."/".PI_MODULE."/View/";
    $this->TPL_PUBLIC = APP_PATH."/".PI_MODULE."/View/public/";
    $this->TplSuffix = C("APP_TPL_FIX");
    $this->_Behavior = PI_CONTROLLER ;
    $this->_Method = PI_METHOD ;
    $this->_PATH = PATH;
    $this->Runtime = APP_PATH."/".PI_MODULE."/Runtime/";
  }

  /* 处理Tpl */
  public function getTpl($content){
    $content = $this->clearComment($content);
    $content = $this->includeTpl($content); //替换include标签
    $content = $this->varTPL($content); //替换模板变量
    $content = $this->magicTag($content);  //替换__CSS:xx__ | __JS:xx__ | __IMG:xx.xxx__ | __STATIC:xx.xxx
    $content = $this->createURL($content);
    $content = $this->constantTPL($content); //替换{__常量名__}符号
    $content = $this->clientVar($content);  //替换{!XXXXX:xx变量}
    $content = $this->methodsTag($content);
    return $content;
  }
  /* 系统函数：U */
  public function createURL($content){
    /*U函数 {:U("index/index?get=1")}*/
    $pattern = "/{:U\(['|\"](.*)['|\"]\)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      $matches[0] = array_reverse($matches[0]);
      $matches[1] = array_reverse($matches[1]);
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];
        $paths = $matches[1][$i];
        $pattern = "/(.+)\?(.*)$/U";  //获取get内容
        $preg = preg_match($pattern,$paths,$match);
        if($preg!=0){
          $path = $match[1];
          $get = "?".$match[2];
          // $content = str_replace($origin,$this->_PATH.$match[1].$this->TplSuffix."?".$match[2],$content);
        }else{
          $path = $matches[1][$i];
          $get = "";
          // $content = str_replace($origin,$this->_PATH.$matches[1][$i].$this->TplSuffix,$content);
        }
        //判断是否有module
        $count = substr_count($path,"/");
        if($count<=1){
          $path = PI_MODULE."/".$path;
        }
        $content = str_replace($origin,$this->_PATH.$path.$this->TplSuffix.$get,$content);
      }
    }
    return $content;
  }
  /* 系统方法：clearComment，清除模板注释*/
  public function clearComment($content){
    $pattern = "/<!--([\s\S]*)-->/iU";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"",$content);
      }
    }
    // //清除换行
    // if(APP_DEBUG===false){
    //   $content = str_replace("\r\n","",$content);
    // }
    return $content;
  }
  /* 系统方法：methodsTag，支持模板判断方法 */
  public function methodsTag($content){
    $content = str_replace("<else />","<?php else: ?>",$content); //通用else替换
    $content = $this->MT_Volist($content);
    $content = $this->MT_Notempty($content);
    $content = $this->MT_Empty($content);
    $content = $this->MT_If($content);
    return $content;
  }
  /* MagicTag Volist */
  public function MT_Volist($content){
    $content = str_replace("</volist>","<?php endforeach;endif; ?>",$content);
    $pattern = "/<volist[\s]*name=['|\"](.+)['|\"][\s]*value=['|\"](.+)['|\"][\s]*key=['|\"](.+)['|\"][\s]*>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    // var_dump($preg);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(is_array(\${$matches[1][$i]})):foreach(\${$matches[1][$i]} as \${$matches[3][$i]}=>\${$matches[2][$i]}): ?>",$content);
      }
    }
    return $content;
  }
  /* MagicTag EmptyElse */
  public function MT_Empty($content){
    $content = str_replace("</empty>","<?php endif; ?>",$content);
    $content = str_replace("<else />","<?php else: ?>",$content);
    $pattern = "/<empty[\s]*name=['|\"](.+)['|\"][\s]*>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(empty(\${$matches[1][$i]})): ?>",$content);
      }
    }
    return $content;
  }
  /* MagicTag Notempty */
  public function MT_Notempty($content){
    $content = str_replace("</notempty>","<?php endif; ?>",$content);
    $pattern = "/<notempty[\s]*name=['|\"](.+)['|\"][\s]*>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches[0][$i],"<?php if(!empty(\${$matches[1][$i]})): ?>",$content);
      }
    }
    return $content;
  }
  /* MagicTag IF */
  public function MT_If($content){
    $content = str_replace("</if>","<?php endif; ?>",$content);
    $pattern = "/<if[\s]*condition=['|\"](.+)['|\"][\s]*>/Um";
    $preg = preg_match_all($pattern,$content,$matches_font);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches_font[0][$i],"<?php if({$matches_font[1][$i]}): ?>",$content);
      }
    }
    $pattern = "/<else[\s]*condition=['|\"](.+)['|\"][\s]*\/>/Um";
    $preg = preg_match_all($pattern,$content,$matches_end);
    if($preg!=0){
      for ($i=0; $i < $preg; $i++) {
        $content = str_replace($matches_end[0][$i],"<?php elseif({$matches_end[1][$i]}): ?>",$content);
      }
    }
    return $content;
  }
  public function varTPL($content){
    /*变量代替*/
    $pattern = "/[\{|\`][\$](.*)[\}|\`]/U"; //兼容 `|{}两种定界符号
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        /*$content = str_replace($matches[0][$i],"<?php echo \"\${$matches[1][$i]}\"; ?>",$content);*/
        $content = str_replace($matches[0][$i],"<?php if(isset(\${$matches[1][$i]})){echo (\${$matches[1][$i]});} ?>",$content);
      }
    }
    return $content;
  }
  /* 系统方法：magicTag，支持模板符号__CSS:index__ */
  public function magicTag($content){
    /*配套CSS*/
    $pattern = "/__CSS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->wTPL.$this->_Behavior."/css/".$matches[1][$i].".css",$content);
      }
    }
    /*配套JS*/
    $pattern = "/__JS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->wTPL.$this->_Behavior."/js/".$matches[1][$i].".js",$content);
      }
    }
    /*配套IMG*/
    $pattern = "/__IMG:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->wTPL.$this->_Behavior."/img/".$matches[1][$i],$content);
      }
    }
    /*公共静态文件*/
    $pattern = "/__STATIC:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->wTPL_PUBLIC."static/".$matches[1][$i],$content);
      }
    }
    return $content;
  }
  /* 系统方法：constantTPL，支持模板符号{__常量名__} */
  public function constantTPL($content,$inside=false){
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
        if($inside===true){
          $content = str_replace($matches[0][$i],"echo @{$matches[1][$i]};",$content);
        }else{
          $content = str_replace($matches[0][$i],"<?php echo @{$matches[1][$i]}; ?>",$content);
        }
      }
    }
    return $content;
  }
  /* 系统方法：clientVar，支持模板标签：{!XXXXX:xxx}，Cookie等变量调用 */
  public function clientVar($content,$inside=false){
    $pattern = "/{!(.+):(.+)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];  //源代码
        if($inside===true){
          $content = str_replace($origin,"echo @\$_{$matches[1][$i]}['{$matches[2][$i]}'];",$content);
        }else{
          $content = str_replace($origin,"<?php echo @\$_{$matches[1][$i]}['{$matches[2][$i]}']; ?>",$content);
        }
      }
    }
    return $content;
  }
  /* 系统方法：includeTpl，支持模板标签：<include file='PUBLIC-header' type='autoheader' /> */
  public function includeTpl($content){
    $pattern = "/\<include file=['|\"](.+)-(.+)['|\"](?:[\s]+type=['|\"](.+)['|\"][\s]*|[\s]*)\/\>/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];  //源代码
        //公共文件
        if($matches[1][$i]=="PUBLIC"){
          //判断type
          if($matches[3][$i]=="autoheader"){
            //自动载入配套js/css
            $extra = "";
            if(file_exists($this->TPL.$this->_Behavior."/css/".$this->_Method.".css")){
              $extra .= "<link rel='stylesheet' href='__CSS:{$this->_Method}__'>";
            }
            if(file_exists($this->TPL.$this->_Behavior."/js/".$this->_Method.".js")){
              $extra .= "<script src='__JS:{$this->_Method}__'></script>";
            }
            $text = @file_get_contents($this->TPL_PUBLIC."html/{$matches[2][$i]}{$this->TplSuffix}");
            $content = str_replace($origin,"{$text}\n{$extra}",$content);
          }else{
            //常规输出
            $text = @file_get_contents($this->TPL_PUBLIC."html/{$matches[2][$i]}{$this->TplSuffix}");
            $content = str_replace($origin,$text,$content);
          }
        }else{
          //自有文件
          $text = @file_get_contents($this->TPL."{$matches[1][$i]}/{$matches[2][$i]}{$this->TplSuffix}");
          $content = str_replace($origin,$text,$content);
        }
      }
    }
    return $content;
  }
}
?>
