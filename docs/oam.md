# OAM 窝群

OAM(OneAsMuiltiple)模块是TCE框架引擎的核心功能之一，OAM可以实现`一服多站`，`独立Api通道`等便捷功能。

## 使用手册

- 1、配置

OAM的相关设置在运行过TCE框架引擎的入口文件后会自动在入口文件目录生成一个`config.inc.php`，OAM相关的设置如下：

```php
"OAM"             => array(
  "BDA"             => array(
    "yourdomain"      => "APP"
  ),
  "BDAPI"           => array(
    "yourdomain"      => "APP"
  ),
),
```

`BDA`可以理解为`BindingApp`，通过类似`"yourdomian.com" => "APP"`这样的设置将域名与应用捆绑在一起。

`BDAPI`可以理解为`BindingApi`，设置方法与`BDA`设置相同，可将域名与Api捆绑在一起，并自动将模式设置为`Api模式`。

- 2、泛捆绑

> 此功能将影响框架运行速度且存在一定的安全隐患，若您觉得需要，请[点击这里](https://github.com/jokin1999/TwocolaPHPEngine/issues/3)发表您的需求。

举个例子，要求将`xxx.yourdomain.com`绑定到应用`APP`（xxx表示任意合法域名字符），则可以使用`*.yourdomain.com`进行绑定。实例如下：

```php
"BDA"             => array(
  "*.yourdomain.com" => "APP"
),
```

泛捆绑也支持Api绑定，方法相同，不再赘述。
