<?php
/*
** TCPHPEngine模板引擎
** Version:V1.0.0.0
** DevStudio:Twocola
** Authorize:Twocola.com
*/
class Template {
  private $TPL; //模板目录
  private $TPL_PUBLIC;  //模板公共文件目录
  private $_PATH; //全局变量PATH
  private $_Behavior; //全局变量PI_BEHAVIOR
  private $_Method; //全局变量PI_METHOD
  private $Public;  //公共模板路径(WEB)
  private $Runtime; //模板存放路径(PATH)
  private $_TplSuffix = "";
  private $content = ""; //页面内容

  public function __construct(){
    /* 基础路径 */
    $this->TPL = APP_TPL;
    $this->TPL_PUBLIC = APP_TPL."public/";
    $this->_Behavior = PI_BEHAVIOR ;
    $this->_Method = PI_METHOD ;
    $this->_TplSuffix = APP_TPL_FIX;
    $this->_PATH = PATH;
    $this->Runtime = EZ_PATH."\Runtime\\";
    $this->isTpl(); //清除缓存
    //判断页面是否存在
    if(file_exists($this->TPL.$this->_Behavior."/".$this->_Method.$this->_TplSuffix)){
      //页面存在
      $this->createTpl();
    }else{
      //页面不存在
      $this->show404();
    }
  }
  /* 系统方法：show404 */
  public function show404(){
    $tpl = $this->Runtime."404.runtime.php";
    $this->content = $this->getTpl(file_get_contents($this->TPL_Public."html/404".$this->_TplSuffix));
    $this->show("页面找不到了",$tpl);
    exit();
  }
  /* 系统方法：showerror */
  public function showerror($url="",$title="发生错误了",$content="我什么都不知道，憋打我！",$errimg="error"){
    $url = (empty($url)) ? U("index/index") : $url ;
    $tpl = $this->Runtime."error.runtime.php";
    $this->content = $this->getTpl(file_get_contents($this->TPL_Public."html/error".$this->_TplSuffix));
    $this->assign("url",$url);
    $this->assign("errimg",$errimg);
    $this->assign("error",$content);
    $this->show($title,$tpl);
    exit();
  }
  /* 系统方法：isTpl，判断模板缓存文件是否存在，存在删除 */
  private function isTpl($tpl=""){
    $tpl = (empty($tpl)) ? $this->Runtime.$this->_Behavior.$this->_Method.".runtime.php" : $tpl;
    if(file_exists($tpl)){
      unlink($tpl) or die(E("系统无法删除缓存文件！"));
    }
  }
  /* 系统方法：createTpl，写出模板缓存文件 */
  private function createTpl($tpl=""){
    $tpl = (empty($tpl)) ? $this->Runtime.$this->_Behavior.$this->_Method.".runtime.php" : $tpl;
    $this->content = $this->getTpl(file_get_contents($this->TPL.$this->_Behavior."/".$this->_Method.$this->_TplSuffix));
  }
  private function getTpl($content){
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
  private function createURL($content){
    /*U函数*/
    $pattern = "/{:U\(['|\"](.*)['|\"]\)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->_PATH.$matches[1][$i],$content);
      }
    }
    return $content;
  }
  /* 系统方法：clearComment，清除模板注释*/
  protected function clearComment($content){
    $pattern = "/<!--([\s\S]*)-->/iU";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"",$content);
      }
    }
    //清除换行
    if(APP_DEBUG===false){
      $content = str_replace("\n","",$content);
    }
    return $content;
  }

  /* 系统方法：methodsTag，支持模板判断方法 */
  protected function methodsTag($content){
    /* 标准解决方案 */
    //volist
    $pattern = "/<volist name=['|\"](.+)['|\"] value=['|\"](.+)['|\"] key=['|\"](.+)['|\"][\s]*>([\s\S]*)<\/volist>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[1]);$i++){
        $c = $matches[4][$i]; //本体内容
        $sub_pattern = "/`(.+)`/U";
        $sub_preg = preg_match_all($sub_pattern,$c,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $c = str_replace($sub_matches[0][$sub_i],"{{$sub_matches[1][$sub_i]}}",$c);
          }
        }
        $c = "echo @\"".str_replace('"','\"',$c)."\";";
        $content = str_replace($matches[0][$i],"<?php if(is_array(\${$matches[1][$i]})){foreach(\${$matches[1][$i]} as \${$matches[3][$i]}=>\${$matches[2][$i]}){".$c."}} ?>",$content);
      }
    }
    //empty+else
    $pattern = "/<empty name=['|\"](.+)['|\"][\s]*>([\s\S]*)<else \/>([\s\S]*)<\/empty>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[1]);$i++){
        $c1 = $matches[2][$i]; //本体内容
        $sub_pattern = "/`(.+)`/U";
        $sub_preg = preg_match_all($sub_pattern,$c1,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $c1 = str_replace($sub_matches[0][$sub_i],"{{$sub_matches[1][$sub_i]}}",$c1);
          }
        }
        $c1 = "echo @\"".str_replace('"','\"',$c1)."\";";
        $c2 = $matches[3][$i]; //本体内容
        $sub_pattern = "/`(.+)`/U";
        $sub_preg = preg_match_all($sub_pattern,$c2,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $c2 = str_replace($sub_matches[0][$sub_i],"{{$sub_matches[1][$sub_i]}}",$c2);
          }
        }
        $c2 = "echo @\"".str_replace('"','\"',$c2)."\";";
        $content = str_replace($matches[0][$i],"<?php if(empty(@\${$matches[1][$i]})){{$c1}}else{{$c2}} ?>",$content);
      }
    }
    //notempty
    $pattern = "/<notempty name=['|\"](.+)['|\"][\s]*>([\s\S]*)<\/notempty>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[1]);$i++){
        $c = $matches[2][$i]; //本体内容
        $sub_pattern = "/`(.+)`/U";
        $sub_preg = preg_match_all($sub_pattern,$c,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $c = str_replace($sub_matches[0][$sub_i],"{{$sub_matches[1][$sub_i]}}",$c);
          }
        }
        $c = "echo @\"".str_replace('"','\"',$c)."\";";
        $content = str_replace($matches[0][$i],"<?php if(!empty(@\${$matches[1][$i]})){{$c}} ?>",$content);
      }
    }
    //empty
    $pattern = "/<empty name=['|\"](.+)['|\"][\s]*>([\s\S]*)<\/empty>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[1]);$i++){
        $c = $matches[2][$i]; //本体内容
        $sub_pattern = "/`(.+)`/U";
        $sub_preg = preg_match_all($sub_pattern,$c,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $c = str_replace($sub_matches[0][$sub_i],"{{$sub_matches[1][$sub_i]}}",$c);
          }
        }
        $c = "echo @\"".str_replace('"','\"',$c)."\";";
        $content = str_replace($matches[0][$i],"<?php if(empty(@\${$matches[1][$i]})){{$c}} ?>",$content);
      }
    }
    //if
    $pattern = "/<if condition=['|\"](.+)['|\"][\s]*>([\s\S]*)<\/if>/Um";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0; $i<count($matches[0]); $i++){
        $origin = $matches[0][$i];
        $condition = $matches[1][$i];
        $script = $matches[2][$i];  //if内
        $script = str_replace("<else />","}else{",$script); //替换普通else
        //处理条件else
        $pattern = "/<else condition=['|\"](.+)['|\"] \/>/U";
        $sub_preg = preg_match_all($pattern,$script,$sub_matches);
        if($sub_preg!=0){
          for($sub_i=0;$sub_i<count($sub_matches[0]);$sub_i++){
            $sub_origin = $sub_matches[0][$sub_i];
            $sub_condition = $sub_matches[1][$sub_i];
            $script = str_replace($sub_origin,"}else if({$sub_condition}){",$script);
          }
        }
        //格式化script
        $pattern = "/(?:<if condition=['|\"].+['|\"][\s]*>|<else \/>|<else condition=['|\"].+['|\"] \/>|)([\s\S]*)(?:<else \/>|<else condition=['|\"].+['|\"] \/>|<\/if>)/Um";
        $s_preg = preg_match_all($pattern,$origin,$s_matches);
        if($s_preg!=0){
          for($s_i=0;$s_i<count($s_matches[0]);$s_i++){
            $s_c = "echo @\"".str_replace('"','\"',$s_matches[1][$s_i])."\";";
            $script = str_replace($s_matches[1][$s_i],$s_c,$script);
          }
          /* `` */
          $pattern = "/\`(.+)\`/U";
          $preg = preg_match_all($pattern,$script,$matches_tag);
          if($preg!=0){
            for ($ss_i=0; $ss_i < count($matches_tag[0]); $ss_i++) {
              $script = str_replace($matches_tag[0][$ss_i],"\".{$matches_tag[1][$ss_i]}.\"",$script);
            }
          }
          /*- `` -*/
        }
        $content = str_replace($origin,"<?php if({$condition}){{$script}} ?>",$content);
      }
    }
    return $content;
  }
  protected function varTPL($content){
    /*变量代替*/
    $pattern = "/{[\$](.*)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],"<?php echo \"\${$matches[1][$i]}\" ?>",$content);
      }
    }
    return $content;
  }
  /* 系统方法：magicTag，支持模板符号__CSS:index__ */
  protected function magicTag($content){
    /*配套CSS*/
    $pattern = "/__CSS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->_PATH."tpl/".$this->_Behavior."/css/".$matches[1][$i].".css",$content);
      }
    }
    /*配套JS*/
    $pattern = "/__JS:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->_PATH."tpl/".$this->_Behavior."/js/".$matches[1][$i].".js",$content);
      }
    }
    /*配套IMG*/
    $pattern = "/__IMG:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->_PATH."tpl/".$this->_Behavior."/img/".$matches[1][$i],$content);
      }
    }
    /*公共静态文件*/
    $pattern = "/__STATIC:(.*)__/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $content = str_replace($matches[0][$i],$this->TPL_PUBLIC."static/".$matches[1][$i],$content);
      }
    }
    return $content;
  }
  /* 系统方法：constantTPL，支持模板符号{__常量名__} */
  private function constantTPL($content){
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
        $content = str_replace($matches[0][$i],"<?php echo @{$matches[1][$i]}; ?>",$content);
      }
    }
    return $content;
  }
  /* 系统方法：clientVar，支持模板标签：{!XXXXX:xxx} */
  private function clientVar($content){
    $pattern = "/{!(.+):(.+)}/U";
    $preg = preg_match_all($pattern,$content,$matches);
    if($preg!=0){
      for($i=0;$i<count($matches[0]);$i++){
        $origin = $matches[0][$i];  //源代码
        $content = str_replace($origin,"<?php echo @\$_{$matches[1][$i]}['{$matches[2][$i]}']; ?>",$content);
      }
    }
    return $content;
  }
  /* 系统方法：includeTpl，支持模板标签：<include file='PUBLIC-header' type='autoheader' /> */
  private function includeTpl($content){
    $pattern = "/\<include file='(.+)-(.+)' type='(.+)' \/\>/U";
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
            $text = @file_get_contents($this->TPL_Public."html/{$matches[2][$i]}{$this->_TplSuffix}");
            $content = str_replace($origin,"{$text}\n{$extra}",$content);
          }else{
            //常规输出
            $text = @file_get_contents($this->TPL_Public."html/{$matches[2][$i]}{$this->_TplSuffix}");
            $content = str_replace($origin,$text,$content);
          }
        }
      }
    }
    return $content;
  }
  /* 用户方法：show显示页面 */
  protected function show($title="",$tpl=""){
    //替换标题（Title）
    if(empty($title)){
      $this->assign("TITLE",APP_NAME);
    }else{
      $this->assign("TITLE",$title." - ".APP_NAME);
    }
    //写出模板
    $tpl = (empty($tpl)) ? $this->Runtime.$this->_Behavior.$this->_Method.".runtime.php" : $tpl;
    if(!file_exists($tpl)){
      touch($tpl);
    }
    file_put_contents($tpl,$this->content);
    if(file_exists($tpl)){
      include($tpl);
    }else{
      E("载入模板时发生错误，请检查程序的读写权限！");
    }
    exit();
  }
  /* 用户方法：assign，替换变量，格式{$变量名} */
  protected function assign($name,$var,$inTag=false){
    $this->content = "<?php \${$name}=".var_export($var,true)." ?>".$this->content;
    /*
      if($inTag===false){
        $this->content = str_replace("{\$".$name."}","<?php echo @(\${$name}) ?>",$this->content); //变量替换(assign变量支持)
      }
    */
  }

  /*用户方法：getContent，获取处理过后的页面内容*/
  public function getContent(){
    return $this->content;
  }

  /*用户方法：putContent，最终处理输出放置的content*/
  public function putContent($content){
    $this->content = $content;
  }

}
?>
