<?php
  /* 检查基础目录 */
  $storage = new StorageNormal();
  if(!$storage->FolderExist(EZ_PATH."/Runtime")){
    if(!$storage->CreateFolder(EZ_PATH."/Runtime")){
      E("缓存文件夹创建失败，请确认目录： ".EZ_PATH."/Runtime"." 是否拥有读写权限！");
    }
  }
  /* 定义系统函数 */
  if(!defined("SYSTEM_SUFFIX")){
    define("SYSTEM_SUFFIX","");
  }
?>
