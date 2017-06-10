<!DOCTYPE html>
<html lang='zh-cn'>
<head>
  <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
  <meta charset='utf-8'>
  <title>{__FRAMENAME__}</title>
  <style>
    body {
      background-color: rgb(245, 245, 245);
    }
  </style>
</head>
<body>
  <h1>发生错误了 T^T</h1>
  <p>
    <h3>错误：{$error['message']}</h3>
    <h3>位置：...{$error['file']}<if condition="isset($error['line'])">:{$error['line']}</if></h3>
    <table style='border:0px solid #999;max-length:70%'>
      <tbody>
        <!-- <tr>
          <th><strong>#</strong></th>
          <th><strong>Function</strong></th>
          <th><strong>Location</strong></th>
        </tr> -->
        <if condition="isset($trace)">
          <th colspan='3'><h3 style="margin:0;padding:0;">Trace</h3></th>
          <volist name="trace" value="t" key="k">
            <tr>
              <td><strong>#{$k}</strong></td>
              <td>
                {$t['class']}{$t['type']}<strong>{$t['function']}</strong>(<font color='#333000'>{$args}</font>)
              </td>
              <td>
                <if condition="isset($t['file'])&&!empty($t['file'])">...{$t['file']}</if>
                <if condition="isset($t['line'])">:{$t['line']}</if>
              </td>
            </tr>
          </volist>
        </if>
      </tbody>
    </table>
    <br />
    <span style='color:#8e8e8e'>[Simple and Easy to use.]</span>
  </p>
  <small>Designed by Jokin.</small>
</body>
</html>
