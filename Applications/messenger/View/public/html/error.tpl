<include file='PUBLIC-header' type='header' />
<include file='PUBLIC-nav' type='nav' />
</head>
<body>
  <div class="am-container">
    <img class="am-center am-img-responsive am-animation-fade" src="__STATIC:{$errimg}.png__">
    <div class="am-alert am-alert-warning am-text-center">{$error}</div>
    <hr />
    <p class="am-text-center">
      <button class="am-btn am-btn-success am-animation-scale-up" onclick="location.href='{$url}'">返回</button>
    </p>
  </div>
<include file='PUBLIC-footer' type='footer' />
