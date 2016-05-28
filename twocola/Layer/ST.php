<?php
/*
** TCE框架引擎自检核心
** Version:1.2
*/
/* 检查系统常量 */
if(!defined("SYSTEM_SUFFIX")){
  define("SYSTEM_SUFFIX",""); //伪静态后缀
}
if(!defined("PI_MODULE")){
  E("常量 PI_MODULE 未定义！[预估出错:Layer]");
}
if(!defined("PI_CONTROLLER")){
  E("常量 PI_CONTROLLER 未定义！[预估出错:Layer]");
}
if(!defined("PI_METHOD")){
  E("常量 PI_METHOD 未定义！[预估出错:Layer]");
}
if(!defined("PATH")){
  E("常量 PATH 未定义！[预估出错:Layer]");
}
if(!defined("APP_PATH")){
  E("常量 APP_PATH 未定义！[预估出错:Layer]");
}
if(!defined("APP_MODULE")){
  E("常量 APP_MODULE 未定义！[预估出错:Layer]");
}
if(!defined("APP_SUBDOMAIN")){
  E("常量 APP_SUBDOMAIN 未定义！[预估出错:Layer]");
}
/* 检测模板文件夹 */
$storage = new StorageNormal();
if(!$storage->FolderExist(APP_PATH)){
  if(!$storage->CreateFolder(APP_PATH)){
    E("应用文件夹创建失败，请确认目录： ".APP_PATH." 是否拥有读写权限！");
    exit();
  }
}
$storage = new StorageNormal();
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE)){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE)){
    E("模板文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/View")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/View")){
    E("模板文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/View"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/View/public")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/View/public")){
    E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/View/public"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/View/index")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/View/index")){
    E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/View/index"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/View/public/html")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/View/public/html")){
    E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/View/public/html"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/View/public/static")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/View/public/static")){
    E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/View/public/static/"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/Runtime")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/Runtime")){
    E("缓存文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Runtime"." 是否拥有读写权限！");
  }
}
// if(!$storage->FileExist(APP_PATH."/View/public/html/404".APP_TPL_FIX)){
//   $content = "<!DOCTYPE html><html lang='zh-cn'><head><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><meta charset='utf-8'><title>TCE框架引擎</title></head><body><h1>系统未找到页面</h1><p>本页引用".APP_PATH."/View/public/html/404".APP_TPL_FIX."<br />您可以通过修改此文件修改404页面！</p><small>TCE框架-Beta</small></body></html>";
//   if(!$storage->CreateSave(APP_PATH."/View/public/html/404".APP_TPL_FIX,$content)){
//     E("404模板创建失败，请确认目录： ".APP_PATH."/View/public/html/404".APP_TPL_FIX." 是否拥有读写权限！");
//     exit();
//   }
// }
/* API */
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/API")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/API")){
    E("API文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/API"." 是否拥有读写权限！");
    exit();
  }
}
/* Controller */
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/Controller")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/Controller")){
    E("Behavior文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller"." 是否拥有读写权限！");
    exit();
  }
}
/* Behavior */
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/Controller/Behavior")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/Controller/Behavior")){
    E("Behavior文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Behavior"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FileExist(APP_PATH."/".APP_MODULE."/Controller/Behavior/indexBehavior.class.php")){
  $content = "<?php\nnamespace Controller;\nuse Controller\BehaviorCommon;\nclass indexBehavior extends BehaviorCommon{\n/*BehaviorCommon函数可以在这里直接调用*/\n  public function _index_index(){\n    \$this->showContent(\"<!DOCTYPE html><html lang='zh-cn'><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><title>TCE框架引擎</title></head><body><h1>TwocolaPHPEngine - Just for simple.</h1><p>Simple is the most important.<br /><span style='color:#8e8e8e'>[TwocolaPHPEngine,Just for simple.]</span></p><small>TCE框架-Beta</small></body></html>\");\n  }\n}\n?>";
  if(!$storage->CreateSave(APP_PATH."/".APP_MODULE."/Controller/Behavior/indexBehavior.class.php",$content)){
    E("indexBehavior文件创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Behavior/indexBehavior.class.php"." 是否拥有读写权限！");
    exit();
  }
}
/* Displayer */
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/Controller/Displayer")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/Controller/Displayer")){
    E("Displayer文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Displayer"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FileExist(APP_PATH."/".APP_MODULE."/Controller/Displayer/indexDisplayer.class.php")){
  $content = "<?php\nnamespace Controller;\nuse Controller\indexBehavior;\nclass indexDisplayer extends indexBehavior{\n/*Behavior与BehaviorCommon函数可以在这里直接调用*/\n  public function index(){\n    \$this->_index_index();//这里调用Controller/Behavior/indexBehavior中的_index_index函数\n  }\n}\n?>";
  if(!$storage->CreateSave(APP_PATH."/".APP_MODULE."/Controller/Displayer/indexDisplayer.class.php",$content)){
    E("indexDisplayer文件创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Displayer/indexDisplayer.class.php"." 是否拥有读写权限！");
    exit();
  }
}
/* BaDCommon */
if(!$storage->FolderExist(APP_PATH."/".APP_MODULE."/Controller/Common")){
  if(!$storage->CreateFolder(APP_PATH."/".APP_MODULE."/Controller/Common")){
    E("Common文件夹创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Common"." 是否拥有读写权限！");
    exit();
  }
}
if(!$storage->FileExist(APP_PATH."/".APP_MODULE."/Controller/Common/BehaviorCommon.class.php")){
  $content = "<?php\nnamespace Controller;\nuse TCE\Template;\nclass BehaviorCommon extends Template{\n/*这里的函数可以在Behavior与Displayer中调用*/\n}\n?>";
  if(!$storage->CreateSave(APP_PATH."/".APP_MODULE."/Controller/Common/BehaviorCommon.class.php",$content)){
    E("BehaviorCommon文件创建失败，请确认目录： ".APP_PATH."/".APP_MODULE."/Controller/Common/BehaviorCommon.class.php"." 是否拥有读写权限！");
    exit();
  }
}
?>
