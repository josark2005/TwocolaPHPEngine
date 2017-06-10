# TCE框架引擎

TCE框架引擎（全名Twocola PHP Engine），一款从实用角度出发的PHP MVC开发模式的框架，独有的“窝群”系统解决了服务器的一些限制。

`作者: Jokin`

`联系方式：QQ 327928971 | EMAIL 327928971@qq.com`

---

[![GitHub Tag](https://img.shields.io/github/tag/jokin1999/TwocolaPHPEngine.svg?style=flat-square)](https://raw.githubusercontent.com/jokin1999/TwocolaPHPEngine/master)

[![GitHub license](https://img.shields.io/badge/license-Apache%202-blue.svg?style=flat-square)](https://raw.githubusercontent.com/jokin1999/TwocolaPHPEngine/master/LICENSE)

[Coding](https://coding.net/u/Jokin/p/TwocolaPHPEngine/git)

[Github](https://github.com/jokin1999/TwocolaPHPEngine)

---

> Notice:自带入口文件（`index.php`）仅供参考，`版本间可能存在不一致的配置`，请自行参考手册进行调整。升级时请勿直接解压替换，一般情况只需替换库文件夹（默认为`twocola`）即可完成升级，少数情况下需要使用`Panel`完善结构（为了减少框架判断次数优化运行效率）。

> `3.0`及以下版本不提供更新支持，请勿直接进行升级。

---

### 更新日志

#####  TCE `4.0.6.1001` | Panel `1.0.5.1901`

> `大规模升级` | `v3.2及以上版本`可进行`半平滑升级`（直接替换库文件夹即可）。

> 本次升级新增多个函数与相关数据存放点，需要配合新功能`Panel`完善结构。

[新增 | 流程] --提供升级模块放置目录并自动进行载入。

[新增 | 设置] --`自动升级`。

[优化] `Api`模式下，访问失败提示404相关信息。

[优化 | 流程] 应用不存在的情况下，错误页缓存将写入默认应用的缓存目录中。

[修复 | 设置] `默认时区`在设置文件中定义无效的Bug。(*结构逻辑优化*)

[优化 | 设置] `自定义`应用拒绝访问页面，支持类U函数定义与模板解析。(*结构逻辑优化*)

[优化 | 设置] `自定义`页面不存在错误页面，支持类U函数定义与模板解析。(*结构逻辑优化*)

[优化 | 设置] `自定义`应用不存在错误页面，支持类U函数定义与模板解析。(*结构逻辑优化*)

- > （Pathinfo路径）`应用不存在`页面在全局定义时为`APP_PATH`路径下的相对应的应用内的页面。定义`Panel`模块需要在`Panel`应用设置中单独定义。

[优化 | 设置] `自定义`系统错误页面，支持类U函数定义与模板解析。(*结构逻辑优化*)

[新增 | *Beta*] `SQLite3`数据库。

[修复] `全局设置项`将域名与Api模式绑定后不生效的问题。

- > 详细请见
[Github](https://github.com/jokin1999/TwocolaPHPEngine/issues/2)
|
[Coding](https://coding.net/u/Jokin/p/TwocolaPHPEngine/topic/350310)

[修复] `数据库连接`配置数据库相关设置后使用M()等函数无法连接。

- > 详情请见
[Github](https://github.com/jokin1999/TwocolaPHPEngine/issues/1)
|
[Coding](https://coding.net/u/Jokin/p/TwocolaPHPEngine/topic/347620)

[修复] `启动器`启动时应用不存在情况下载入页面出错的Bug。

[修复] `模板引擎`assign生成双倍信息的Bug。

[修复] `自定义后缀`设置后模板函数生成出现问题的Bug。

[优化] `读取设置（函数C）`使用非大写字母且读取内容为常量时返回false的问题。

[新增] `View`目录下Controller对应文件夹中的`css`、`js`、`img`文件夹，可直接使用模板函数引入相应文件。

[支持 | `Panel`] `启动器`，支持`Panel`模式。

[支持 | `Panel`] `模板引擎`，支持`Panel`模式（多应用目录）运行。

[新增] `Panel`相关设置项。

[新增] 应用相关文件夹`Database`用于存储数据库文件。

[新增] 应用相关文件夹`Upload`用于存储被上传的文件。（暂无相关函数，后续会完善）

[新增 | BETA] 面板开发模式。

[删除] `Ver 3.3`以及之前的更新日志。

---
