<?php
/*
** TCE框架引擎自检核心
** Version:1.0
*/
/* 检测模板文件夹 */
$storage = new StorageNormal();
if(!$storage->FolderExist(APP_TPL)){
  if(!$storage->CreateFolder(APP_TPL)){
    E("模板文件夹创建失败，请确认目录： ".APP_TPL." 是否拥有读写权限！");
  }
}
if(!$storage->FolderExist(APP_TPL."public/")){
  if(!$storage->CreateFolder(APP_TPL."public/")){
    E("模板文件夹创建失败，请确认目录： ".APP_TPL."public/"." 是否拥有读写权限！");
  }
}
if(!$storage->FolderExist(APP_TPL."public/html/")){
  if(!$storage->CreateFolder(APP_TPL."public/html/")){
    E("模板文件夹创建失败，请确认目录： ".APP_TPL."public/html/"." 是否拥有读写权限！");
  }
}
if(!$storage->FolderExist(APP_TPL."public/static/")){
  if(!$storage->CreateFolder(APP_TPL."public/static/")){
    E("模板文件夹创建失败，请确认目录： ".APP_TPL."public/static/"." 是否拥有读写权限！");
  }
}
if(!$storage->FileExist(APP_TPL."public/html/404".APP_TPL_FIX)){
  $content = "<!DOCTYPE html><html lang='zh-cn'><head><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><meta charset='utf-8'><title>TCE框架引擎</title></head><body><h1>系统成功创建！</h1><p>本页引用".APP_TPL."public/html/404".APP_TPL_FIX."<br />您可以通过修改此文件建立404页面！</p><small>TCE框架-Beta</small></body></html>";
  if(!$storage->CreateSave(APP_TPL."public/html/404".APP_TPL_FIX,$content)){
    E("模板文件夹创建失败，请确认目录： ".APP_TPL."public/html/404".APP_TPL_FIX." 是否拥有读写权限！");
  }
}
?>
