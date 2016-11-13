<?php
/*
** TCE框架引擎升级核心
** Version:0.1
** Issue:功能概念阶段，不推荐启动（默认关闭）
*/
if( C("SYS_UPGRADE_ENTERANCE") && !empty(C("SYS_UPGRADE_ENTERANCE")) && C("SYS_UPGRADE_UKEY") && !empty(C("SYS_UPGRADE_UKEY")) ) {
  $enterence = C("SYS_UPGRADE_ENTERANCE");
  $password = C("SYS_UPGRADE_UKEY");
  if(@$_GET[$enterence]==$password){
    echo "START-".TCE_PATH.DIRECTORY_SEPARATOR."TCE_VERSION.php"."-END";
    exit();
  }else{
    echo "There is something wrong...";
    exit();
  }
}
/* 释放资源 */
unset($enterence);
unset($password);
?>
