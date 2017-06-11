# TCE框架引擎错误码相关定义

`Author: Jokin`

`联系方式：QQ 327928971 | EMAIL 327928971@qq.com`

---

> 本手册仅供参考，请查询相关Panel中的正式手册。

### 通用定义

1、错误码首字母必须为英文大写的E并紧跟一个下划线 `E_`。

2、首字母后紧跟 `A-Z`或`0-9`，分别表示不同意义。

3、在`E_XXX`后紧跟一个下划线`_`，下划线后的字母提示出错位置*可能不准确*。

4、其后紧跟错误对应的数字组合。

---

### 常见错误码

  >注意：此处均省略`E_`前缀。

  - **S02_C1**
    - 错误原因：Api类库不存在
    - 解决方案：应用目录当前应用文件夹下的Api文件夹下各个文件夹下可能缺少现在正在访问的类库。*详细请查询手册或在线查询错误码*
  - **S02_C2**
    - 错误原因：指定Api通道不存在。
    - 解决方案：应用目录当前应用文件夹下的Api文件夹下各个文件夹下正在访问的类库中缺少当前页面所需的方法。*详细请查询手册或在线查询错误码*
  - **S01_P0**
    - 错误原因：对应页面的模板文件不存在。
    - 解决方案：应用目录当前应用文件夹下的View文件夹下各个文件夹下可能缺少现在正在访问的模板文件。*详细请查询手册或在线查询错误码*
  - **S01_T0**
    - 错误原因：自定义载入的`拒绝访问`模板文件不存在。
    - 解决方案：检查全局设置或应用设置中的自定义模板路径是否存在书写错误。*详细请查询手册或在线查询错误码*
  - **S01_T1**
    - 错误原因：自定义载入的`页面不存在`模板文件不存在。
    - 解决方案：检查全局设置或应用设置中的自定义模板路径是否存在书写错误。*详细请查询手册或在线查询错误码*
  - **S01_T2**
    - 错误原因：自定义载入的`应用不存在`模板文件不存在。
    - 解决方案：检查全局设置或应用设置中的自定义模板路径是否存在书写错误。*详细请查询手册或在线查询错误码*
  - **S01_T3**
    - 错误原因：自定义载入的`应用级错误`模板文件不存在。
    - 解决方案：检查全局设置或应用设置中的自定义模板路径是否存在书写错误。*详细请查询手册或在线查询错误码*
    - 常见问题：此设置在Debug模式关闭（为false）的情况下才启动。
  - **P01_NFP**
    - 错误原因：自定义载入的`Panel`模块不存在。
    - 解决方案：检查全局设置或应用设置中的自定义`Panel`路径是否存在书写错误。（此类设置均采用相对于入口文件的路径）*详细请查询手册或在线查询错误码*
    - 常见问题：暂无。

---

  - **S01_C1**
    - *此错误在4.x及以上版本中取消，使用404页面代替*
    - 错误原因：类库不存在。
    - 解决方案：应用目录当前应用文件夹下的Controller文件夹下各个文件夹下可能缺少现在正在访问的类库。*详细请查询手册或在线查询错误码*
  - **S01_C2**
    - *此错误在4.x及以上版本中取消，使用404页面代替*
    - 错误原因：类库中对应方法不存在。
    - 解决方案：应用目录当前应用文件夹下的Controller文件夹下各个文件夹下正在访问的类库中缺少当前页面所需的方法。*详细请查询手册或在线查询错误码*

---

###错误码查询表

  - **S**:`系统`
    - 0: 类库错误
      - 1自定义类库错误
    - 1: 文件错误
  - **1**:`系统`位置错误


---