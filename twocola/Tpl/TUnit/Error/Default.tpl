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
  <h1>应用错误:{$errCode}</h1>
  <p>
    <strong>应用：</strong>{__APP__}<br />
    <strong>名称：</strong>{__APP_NAME__}<br />
    <strong>原因：</strong>{$error}<br />
  </p>
  <p>简且易用。<br />
    <span style='color:#8e8e8e'>[Simple and Easy to use.]</span>
  </p>
  <small>Designed by Jokin.</small>
</body>
</html>
