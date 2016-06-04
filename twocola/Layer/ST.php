<?php
/*
** TCE框架引擎自检核心
** Version:1.2
*/
/* 检查系统配置 */
$conf = new TCE\IncReader;
if(!$conf->ConfigExists("SYSTEM_SUFFIX")){
  define("SYSTEM_SUFFIX",""); //伪静态后缀
}
if(!$conf->ConfigExists("SYSTEM_DEFAULT_MODULE")){
  E("配置 SYSTEM_DEFAULT_MODULE 未定义！[预估出错:Layer]");
}
if(!defined("PI_CONTROLLER")){
  E("系统配置 PI_CONTROLLER 未定义！[预估出错:Layer]");
}
if(!defined("PI_METHOD")){
  E("系统配置 PI_METHOD 未定义！[预估出错:Layer]");
}
if(!defined("PATH")){
  E("系统配置 PATH 未定义！[预估出错:Layer]");
}
if(!defined("APP_PATH")){
  E("系统配置 APP_PATH 未定义！[预估出错:Layer]");
}
if(!defined("APP_SUBDOMAIN")){
  E("系统配置 APP_SUBDOMAIN 未定义！[预估出错:Layer]");
}

$storage = new StorageNormal(); //载入存储引擎
/* 检测应用文件夹 */
if(!$storage->FolderExist(APP_PATH)){
  if(!$storage->CreateFolder(APP_PATH)){
    E("应用文件夹创建失败，请确认目录： ".APP_PATH." 是否拥有读写权限！");
    exit();
  }
}
if($conf->ConfigExists("APP_MODULE")){
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE"))){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE"))){
      E("模板文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/config.inc.php")){
    $content = getPresetTpl("config.inc.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/config.inc.php",$content)){
      E("应用单独配置文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/config.inc.php"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/View")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/View")){
      E("模板文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/View"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/View/public")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/View/public")){
      E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/View/public"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/View/index")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/View/index")){
      E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/View/index"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/View/public/html")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/View/public/html")){
      E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/View/public/html"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/View/public/static")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/View/public/static")){
      E("模板公共文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/View/public/static/"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Runtime")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Runtime")){
      E("缓存文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Runtime"." 是否拥有读写权限！");
    }
  }
  /* Controller */
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Controller")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Controller")){
      E("Behavior文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller"." 是否拥有读写权限！");
      exit();
    }
  }
  /* Behavior */
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Controller/Behavior")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Controller/Behavior")){
      E("Behavior文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Behavior"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/Controller/Behavior/indexBehavior.class.php")){
    $content = getPresetTpl("indexBehavior.class.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/Controller/Behavior/indexBehavior.class.php",$content)){
      E("indexBehavior文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Behavior/indexBehavior.class.php"." 是否拥有读写权限！");
      exit();
    }
  }
  /* Displayer */
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Controller/Displayer")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Controller/Displayer")){
      E("Displayer文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Displayer"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/Controller/Displayer/indexDisplayer.class.php")){
    $content = getPresetTpl("indexDisplayer.class.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/Controller/Displayer/indexDisplayer.class.php",$content)){
      E("indexDisplayer文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Displayer/indexDisplayer.class.php"." 是否拥有读写权限！");
      exit();
    }
  }
  /* BaDCommon */
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Controller/Common")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Controller/Common")){
      E("Common文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Common"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/Controller/Common/BehaviorCommon.class.php")){
    $content = getPresetTpl("BehaviorCommon.class.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/Controller/Common/BehaviorCommon.class.php",$content)){
      E("BehaviorCommon文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Common/BehaviorCommon.class.php"." 是否拥有读写权限！");
      exit();
    }
  }
  /* Api */
  if(!$storage->FolderExist(APP_PATH."/".C("APP_MODULE")."/Api")){
    if(!$storage->CreateFolder(APP_PATH."/".C("APP_MODULE")."/Api")){
      E("Api文件夹创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Api"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/Api/index.class.php")){
    $content = getPresetTpl("index.class.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/Api/index.class.php",$content)){
      E("Api.class.php文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Api/index.class.php"." 是否拥有读写权限！");
      exit();
    }
  }
  if(!$storage->FileExist(APP_PATH."/".C("APP_MODULE")."/Controller/Common/Api.class.php")){
    $content = getPresetTpl("Api.class.php");
    if(!$storage->CreateSave(APP_PATH."/".C("APP_MODULE")."/Controller/Common/Api.class.php",$content)){
      E("Api.class.php文件创建失败，请确认目录： ".APP_PATH."/".C("APP_MODULE")."/Controller/Common/Api.class.php"." 是否拥有读写权限！");
      exit();
    }
  }
}
/* 检测默认MODULE是否存在 */
if(!$storage->FolderExist(APP_PATH."/".C("SYSTEM_DEFAULT_MODULE"))){
  E("配置项（配置）默认模块（应用）： ".C("SYSTEM_DEFAULT_MODULE")." 不存在，请确认此模块正确性！");
  exit();
}
/* 检测默认应用是否拒绝访问 */
if(!$storage->FolderExist(APP_PATH."/".C("SYSTEM_DEFAULT_MODULE")."/config.inc.php")){
  $conf->GetConfig(APP_PATH."/".C("SYSTEM_DEFAULT_MODULE")."/config.inc.php");
  if($conf->ReadPointedConfig("APP_RESPONSE")==false){
    E("配置项（配置）默认模块（应用）： ".C("SYSTEM_DEFAULT_MODULE")." 拒绝访问，默认模块不允许拒绝访问！");
    exit();
  }
}
/* 释放资源 */
unset($conf);
?>
