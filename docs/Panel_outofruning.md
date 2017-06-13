# *CatBoy* Panel 无法正常运行

**仅`CayBoy`适用**

Panel模块是TCE框架引擎的特色功能之一，但Panel只是以应用的形式存在于TCE中，不具备任何其他标准应用不具备的功能（Panel能实现的功能，其他应用一样也能实现）。

本手册将提及有关Panel无法正常运作的相关信息与修复方案，若有遗漏，请提交[Issues](https://github.com/jokin1999/TwocolaPHPEngine/issues/new)（请务必添加`Panel`标签）。

## Panel无法正常运作相关解决方案

- 1、Panel配置

请检查Panel开关是否打开：

```php
'PANEL' => true    // 开启Panel
```

请检查Panel相关配置是否正确：

```php
// 自定义时需要指向Panel对应的应用目录 非应用文件夹！
'PANEL_PATH' => false,
// Panel的名称 输入错误也会导致无法进入
'PANEL_NAME' => 'CatBoy',
// Panel的进入方法 1为GET方法进入，2为默认进入Panel
'PANEL_PORTAL' => 1,
// GET方法进入时的Key与Value
'PANEL_PORTAL_KEY' => 'panel',
'PANEL_PORTAL_VALUE' => 'tce',
```

请检查Api相关配置是否正确：

```php
/* Api入口设置 */
"API_PORTAL"         => 1,          // 入口模式
"API_PORTAL_KEY"     => "apimode",  // GET方式
"API_PORTAL_VALUE"   => "true",     // GET方式
```

`入口方式`：0 不允许访问Api（**OAM系统不受限制**）；1 GET方式访问

需要使用Panel，必须开启Api入口。
