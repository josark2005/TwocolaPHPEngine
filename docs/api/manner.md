# Twocola PHP Engine

**Api使用手册**

更多相关设置请[参考这里](http://tce.twocola.com/manner_4_2_settings.html)

---

### 开启Api

在全局设置中，使用以下设置：
```
/* Api入口设置 */
"API_PORTAL"         => 1,          // 入口开关，1为开启，0为关闭
"API_PORTAL_KEY"     => "apimode",  // GET方式
"API_PORTAL_VALUE"   => "true",     // GET方式
```
`API_PORTAL_KEY` 简称`key`，`API_PORTAL_VALUE`简称`value`,使用`http://yourdomain?key=value`的形式访问Api。
**或者**
使用以下配置：
```
/* OAM系统设置 */
"OAM"             => array(
  "BDAPI"         => array(
    // domainname=>apiname
    "api.domain.com"  => "test"
  ),
),
```
第二种方法使用了OAM的相关设置，使用`绑定`的方式访问Api。
第二种方法的例子说明了`api.domain.com`访问时，将跳过第一种设置并直接访问Api。

### 新建Api类
将下方代码保存到`应用目录`下`Api`目录中，以`api名称`加后缀的形式保存，默认后缀：`.class.php`。
**请注意替换{}内的内容**
```
<?php
namespace Api;
use TUnit\TJson;
class {api名称} extends TJson{
  /**
   * 首个Api方法
   * @param  void
   * @return void
  **/
  public function index(){
    // 参数顺序：系统状态|系统信息|应用状态|应用错误编码|应用错误信息
    $this->json_e("1","Welcome! You can use our api in this way!","1","0","0");
  }
}
?>
```
您可以不使用`$this->json_e()`方法输出json，看您的喜好。
---

审核：Jokin

发布：Jokin

---
