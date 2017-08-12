# Twocola PHP Engine

**OAM使用手册**

OAM(OneAsMuiltiple)模块是TCE框架引擎的核心功能之一，OAM可以实现`一服多站`，`独立Api通道`等便捷功能。

---

### 设置

OAM的设置十分简单，看起来仅仅是域名与应用或Api的绑定。
```
/* OAM系统设置 */
"OAM"             => array(

    // 域名绑定应用
    "BDA"           => array(
      // domain=>app
    ),

    // 域名绑定应用API
    "BDAPI"         => array(
      // domain=>api
    ),

),
```
域名绑定应用中，如果替换`// domain=>app`为`class.doamin.com=>class`则在访问`class.domain.com`时系统会忽略默认App而直接访问`class`应用。
同理，Api的绑定也是如此。Api的绑定可以参考手册页目录`Api相关`。

---

审核：Jokin

发布：Jokin

---
