<?php
/*
** TCPHPEngine模板引擎驱动类
** Version:V1.0.1.1
** DevStudio:Twocola
** Authorize:Twocola.com
*/
namespace TCE;
use TCE\TemplateEngine;
class Template extends TemplateEngine {
  /* 初始化 */
  public function __construct(){
    parent::__construct();
  }
  /* 系统方法：createTpl，根据$this->content写出模板缓存文件 */
  public function createTpl($tpl=""){
    $tpl = $this->_getRuntimePath($tpl);
    file_put_contents($tpl,$this->content);
    return $tpl;  //返回缓存文件路径
  }
  /* 用户方法：show显示页面 */
  public function show($tpl=""){
    $tpl = $this->_getTplPath($tpl);
    if(file_exists($tpl)){
      $this->content .= $this->getTpl(file_get_contents($tpl));
      include($this->createTpl());
    }else{
      /* 判断用户自定义404是否存在 */
      $tpl = $this->_getTplPath("public/html/404");
      if(file_exists($tpl)){
        $this->content .= $this->getTpl(file_get_contents($tpl));
        include($this->createTpl("404"));
      }else{
        /* 使用系统404 */
        $this->content .= $this->getTpl(file_get_contents(TCE_PATH."/Tpl/404".$this->TplSuffix));
        include($this->createTpl("404"));
      }
    }
  }
  /* 用户方法：showT显示页面 */
  public function show_t($title="",$tpl=""){
    $title = ($title=="") ? C("APP_NAME") : $title;
    $this->assign("TITLE",$title);
    $this->show($tpl);
  }
  /* 用户方法：assign，替换变量，格式{$变量名} */
  public function assign($name,$var,$inTag=false){
    $this->content = "<?php \${$name}=".var_export($var,true)." ?>".$this->content;
  }
  /*用户方法：getContent，返回原始页面内容*/
  public function getContent(){
    return $this->content;
  }
  /*用户方法：putContent，最终处理输出放置的content，使用show方法显示*/
  public function putContent($content){
    $this->content = $content;
  }
  /* 用户方法：showContent，直接输出content */
  public function showContent($content){
    $name = md5($content);
    $this->content = $this->getTpl($content);
    include($this->createTpl($name));
  }
  /* 系统方法：_getTplPath */
  public function _getTplPath($tpl=""){
    $tpl = (empty($tpl)) ? $this->TPL.$this->_Behavior."/".$this->_Method.$this->TplSuffix : $this->TPL.$tpl.$this->TplSuffix;
    return $tpl;
  }
  /* 系统方法：_getRuntimePath */
  public function _getRuntimePath($tpl=""){
    return $tpl = (empty($tpl)) ? $this->Runtime.$this->_Behavior.$this->_Method.".runtime.php" : $this->Runtime.$tpl.".runtime.php";
  }
}
?>
