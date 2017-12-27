# TCE框架引擎

**本项目已经停止维护，并且存在多处核心问题，请使用最新的项目[Twocola-php](https://github.com/jokin1999/Twocola-php)**

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

> `标准升级` | `v4.0及以上版本`可进行`平滑升级`（直接替换库文件夹即可）。

#### 新增
- ~~SQLite 数据库支持~~
> ~~更换为PDO统一进行操作~~

#### 修复
- Launcher 内部错误
- 默认创建App名称错误
- 默认模板信息错误
- 修复创建应用流程

#### 删除
- 删除UI界面
> UI框架`Panel`极大程度上限制了开发的自由性，这可能不是一个好的尝试，所以我决定暂时删除`Panel`，`Panel`也可能以另一种形式回归，但绝对不会是与应用同级的存在，`Panel`有很大的安全隐患，整个框架都需要承担这些安全隐患，这是得不偿失的。


---
