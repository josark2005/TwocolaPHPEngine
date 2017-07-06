# TCE框架引擎

TCE框架引擎（全名Twocola PHP Engine），一款从实用角度出发的PHP MVC开发模式的框架，独有的“窝群”系统解决了服务器的一些限制。

`作者: Jokin`

`联系方式：QQ 327928971 | EMAIL 327928971@qq.com`

---

[![GitHub Tag](https://img.shields.io/github/tag/jokin1999/TwocolaPHPEngine.svg?style=flat-square)](https://raw.githubusercontent.com/jokin1999/TwocolaPHPEngine/master)
[![GitHub license](https://img.shields.io/badge/license-Apache%202-blue.svg?style=flat-square)](https://raw.githubusercontent.com/jokin1999/TwocolaPHPEngine/master/LICENSE)

[Coding](https://coding.net/u/Jokin/p/TwocolaPHPEngine/git) |
[Github](https://github.com/jokin1999/TwocolaPHPEngine)

---

> Notice:自带入口文件（`index.php`）仅供参考，`版本间可能存在不一致的配置`，请自行参考手册进行调整。升级时请勿直接解压替换，一般情况只需替换库文件夹（默认为`twocola`）即可完成升级，少数情况下需要使用`Panel`完善结构（为了减少框架判断次数优化运行效率）。

> `3.0`及以下版本不提供更新支持，请勿直接进行升级。

---

### 更新日志

> `大规模升级` | `v4.0及以上版本`可进行`平滑升级`（直接替换库文件夹即可）。

[优化] `E函数`报错机制。*(E报错不支持自定义模板)*

> E报错属于框架报错，暂不支持模板函数，但可以修改报错模板。模板路径：twocola/Tpl/TUnit/Error/Error.tpl

[优化] `自定义错误页`支持Controller动态载入。

[优化] `启动器`优化运行速度。

[优化] `启动器`增加URL_MODE配置检查。

[优化] `模板引擎模板引入`标签简化（删除最后的斜杠要求）。*(优化兼容上个版本)*

[修复] `数据库操作类`Mysql无法使用的问题。

[优化] `自动加载类`。

[优化] `模板引擎`生成更标准的模板文件。

[新增] `CatBoy Panel`新增`应用管理`。

[新增] `CatBoy Panel`新增`OAM设置调整`。

[优化] 模板函数`Volist`在被遍历函数不存在时仍然执行导致报错的Bug。

---
