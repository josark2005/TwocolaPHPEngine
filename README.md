#TCE框架引擎

`作者: Jokin`

`联系方式：QQ 327928971 | EMAIL 327928971@qq.com`

---

<!-- 官方网站：[两杯可乐网](http://www.twocola.com) -->

<!-- 官方网站：[TCE引擎（公版）](http://www.twocola.top) -->

<!-- 官方网站：[TCE引擎（定制）未上线](http://www.twocola.top/cm) -->

<!-- 加入我们：[JoinUs](http://www.twocola.com/messenger/index/join) -->

---

###更新日志

<!-- #####Ver 3.3 [常规优化升级]

> Notice:3.2版本可进行平滑升级（直接替换库文件夹即可）。

> **3.0或以下版本请勿直接升级，具体信息请查看3.1版本用户手册。**


[新增] `自定义`应用拒绝访问页面。（更新位置:TUnit/Template/Template.class.php  Line~32）

[新增] `自定义`指定页面不存在错误。（更新位置:TUnit/Template/Template.class.php  Line~40）

[新增] `自定义`系统错误页面。（更新位置:TUnit/TCoreUnit.class.php  Line~128） -->

---

#####Ver 3.2.4.0401 [Bug修复]

> Notice:原计划3.2版本推迟到3.3版本

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[修复] 开启`自动适配后缀`模式后，文件夹中出现`.`时后缀名判断错误的Bug。

[修改] 访问不存在的应用时，默认提示改为“该应用不存在”。

---

#####Ver 3.2.4.0203 [OAM升级]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[升级] OAM系统升级为1.0.4.0203，详情参考`readme`文件夹中OAM的说明文档。

[适配] OAM系统。

> 本次适配修改内容：OAM系统在全局设置下的配置项RMODE修改为BDAPI，并且此版本框架默认生成的全局配置文件中包含了OAM系统的设置项。

---

#####Ver 3.2.4.0201 [漏洞修复]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[新增] `模板引擎`show404方法，用于显示404页面。

[新增] `系统设置`中`APP_SUFFIX_SAFE`设置为`true`时将适配所有后缀。

[修复] `URL解析`引擎在开启后缀名后地址中不出现后缀报错的情况并在APP、CONTROLLER、METHOD中不允许出现`.`、`/`、"\\"符号，如果出现，自行删除。

[修复] 框架中的应用首次运行（创建）时需要进行1次刷新才能使用的问题。

---

#####Ver 3.2.3.2701 [系统优化]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[优化] `报错系统`细节优化。

[增加] 增加`开发模式`，将APP_DEBUG设置为2即开启。`开发模式`启用原生的报错机制，可以查看一些调试模式看不到的错误。

---

#####Ver 3.2.3.2402 [漏洞修复]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[修复] `URL解析引擎`在Pathinfo模式下非utf-8编码可能解析错误的Bug。（更新位置:TUnit/UrlMode/UrlResolution.class.php Line~39）

[修复] `模板引擎`魔术变量生成无效地址的Bug。

---

#####Ver 3.2.3.2401 [性能优化漏洞修复]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[优化] `模板引擎`不再生成GC后缀缓存文件，减少服务器压力。（更新位置:TUnit/Template/Template.class.php Line~341）

[优化] `系统模板`默认使用`.html`为后缀。（更新位置:Tpl/TUnit/TCEngine_Default_Config.inc.php.tpl Line~9）

[修复] `模板引擎`无法使用`模板引用`方法。（更新位置:TUnit/Template/Template.class.php Line~424）

[修复] `URL解析引擎`在Pathinfo模式下解析错误的Bug。（更新位置:TUnit/UrlMode/UrlResolution.class.php Line~39）

[修复] `核心Function`U函数生成错误的Bug。（更新位置:TUnit/Functions/TFunction.php Line~59）

---

#####Ver 3.2.3.2201 [重要漏洞修复]

> Notice:3.1+版本可进行平滑升级（直接替换库文件夹即可）。

[项目 | 修改] `框架版本号`框架版本号组成：主版本.次版本.修改月份.修改日期修改批次

[修复] `模板引擎`无法解析引入的模板文件。（更新位置:TUnit/Template/Template.class.php）

[修复] `路径生成器`（U函数）生成错误的问题。（更新位置:TUnit/Functions/TFcuntion.php  Line~37）

[修复] `系统默认全局设置模板`格式错误问题。（更新位置:Tpl/TUnit/TCEngine_Default_Config.inc.php.tpl Line~9）

---

#####Ver 3.1 [大规模升级]

> **Notice:框架使用全新架构，3.0及以下版本不可直接进行升级。**

[优化] 优化框架运行流程，框架所需类库全面实行懒加载。

[优化] 优化模板引擎，模板标签不再区分大小写。

[优化] 优化`路径解析引擎`，简化解析流程，增加运行效率。

[修改 | 重要] 设置项`SYSTEM_DEFAULT_MODULE`在全局范围内修改为`APP_DEFAULT`。

[修改 | 重要] 设置项`APP_MODULE`在全局范围内修改为`APP_GENERATE`。

[完善] `报错系统`功能。

[增加] `模板引擎`新增模板自定义魔法变量方法。

[优化] `模板引擎`不区分模板（魔法）标签大小写。

[优化] 对部分代码进行规范化，未完成规范的部分将在后续版本进行修改及优化。

[增加 | 优化] `OneAsMuiltiple`（OAM/窝群）功能。

---

#####Ver 3.0 [优化升级]

1、[修复] 设置项`APP_API_PARA`设置为空时，无法进入API模式的BUG。

2、[屏蔽] `SUBDOMAIN_BINDING`功能，重新启用可以在twocola目录下Layer文件夹中的PathInfo.php解除代码屏蔽。

3、[增加 | 概念] `框架自主升级系统`功能，可将升级文件置入服务器中，根据提示进行自动框架升级（本次仅提供升级接口，未内置升级文件）。

4、[增加] `报错系统`功能，使框架拥有完整的报错机制。

---
