<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>TCPHPEngine模板引擎测试</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <style>body{padding: 0px;margin: 0px;}</style>
  </head>
  <body>
    <h1 style="text-align:center">TCPHPEngine模板引擎测试</h1>
    <empty name="_GET['get']"><p style="text-align:center;color:red">您的测试页不在正确状态中，请<a href="?get=<span style='color:green'>GET函数正常</span>">click</a>恢复。</p></empty>
    <!--普通函数测试-->
    <h2>普通模板函数测试</h2>
    <hr />
    <div style="padding:0px 50px;">
      <h3>U函数测试</h3>
      <strong>生成index/index：</strong>{:U("index/index")}<br />
      <strong>生成test/origin?from=index/index：</strong>{:U("test/origin?from={:U("index/index")}")}
      <hr />
      <h3>include函数测试</h3>
      <include file='tplbuilder-include_1'/>
      <hr />
      <h3>Cookie、Session、GET、POST函数测试</h3>
      <strong>Cookie：</strong>{!COOKIE:testCookie}<br />
      <strong>GET：</strong>{!GET:get}<br />
      <hr />
      <h3>常量函数测试</h3>
      <strong>常量函数testConstant：</strong>{__TESTCONSTANT__}<br />
      <hr />
    </div>
    <!--./普通函数测试-->
    <br />
    <!--高级函数测试-->
    <h2>高级函数测试</h2>
    <hr />
    <div style="padding:0px 50px;">
      <h3>Volist函数测试</h3>
      <p>
        <volist name="volist1" value="value" key="key">
          {$key}={$value}
        </volist>
      </p>
      <hr />
      <h3>Empty函数测试</h3>
      <p>
        <empty name="empty">
          <span style="color:green">Empty函数正常</span>
        </empty>
      </p>
      <hr />
      <h3>NotEmpty函数测试</h3>
      <p>
        <notempty name="notempty">
          {$notempty}
        </notempty>
      </p>
      <hr />
      <h3>EmptyElse函数测试</h3>
      <p>
        <empty name="empty">
          $empty为空
        <else />
          $empty不为空
        </empty>
      </p>
      <hr />
    </div>
    <!--./高级函数测试-->
    <div style="padding:0px;margin:0px;background-color:grey;color:white;text-align:center;">测试结束</div>
    <div style="padding:0px;margin:0px;background-color:grey;color:white;text-align:center;">如果测试页在开启报错的情况下出现任何报错信息，则表示程序出现问题。</div>
  </body>
</html>
