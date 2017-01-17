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
  <p>团队即是一切。<br />
    <span style="color:#8e8e8e">[TwocolaPHPEngine,More teamwork.]</span>
  </p>
  <small>TCE V3</small>
</body>
</html>
