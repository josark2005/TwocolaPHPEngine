<?php $TITLE='注册' ?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($TITLE)){echo ($TITLE);} ?> - 两杯可乐网</title>
    <meta name="description" content="<?php echo @APP_NAME; ?>为温暖提供无限可能与百度贴吧的各大传话铺子、传话吧合作，可以为您免费高效率传话。">
    <meta name="keywords" content="<?php echo @APP_NAME; ?>,传话小铺,在线传话,情话小铺,传话铺子,高效率传话,情话大全,传话坊吧,百度贴吧传话吧,两杯可乐网,twocola">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="/Applications/messenger/View/public/static/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.5.0/css/amazeui.min.css">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://cdn.amazeui.org/amazeui/2.5.0/js/amazeui.min.js"></script>
    <script language="javascript" src="//apps.bdimg.com/libs/jquery-scrollUp/2.1.0/jquery.scrollUp.min.js"></script>
    <link rel="stylesheet" href="/Applications/messenger/View/public/static/main.css">
    <script src="/Applications/messenger/View/public/static/main.js"></script>

<link rel='stylesheet' href='/Applications/messenger/View/user/css/signup.css'><script src='/Applications/messenger/View/user/js/signup.js'></script>
<script language="javascript">
  var url_signup = "/messenger/user/signup.tpl?app_type=api";
  // var url_signup_email = "/messenger/user/signup_email.tpl";
  var url_signup_email = "/messenger/user/index.tpl";
</script>
  <script language="javascript">
    $(function(){
      $("#"+$("#nav").attr("name")).attr("class","am-active");
      $("#"+$("#nav").attr("name")+">a").removeAttr("href");
      $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 300, // Animation in speed (ms)
        animationOutSpeed: 300, // Animation out speed (ms)
        scrollText: '', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
      });
    });
  </script>
</head>
<body>
  <!-- Topbar -->
  <header class="am-topbar am-topbar-tc" id="topbar">
    <div class="am-container">
      <h1 class="am-topbar-brand">
        <a href="/messenger/index/index.tpl" title="<?php echo @APP_NAME; ?>" class="am-text-ir"><?php echo @APP_NAME; ?></a>
      </h1>

      <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-default-o am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航</span> <span class="am-icon-bars"></span></button>

      <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-tc am-nav-pills am-topbar-nav" id="nav" name="<?php echo @PI_BEHAVIOR; ?>-<?php echo @PI_METHOD; ?>">
          <li id="index-index"><a href="/messenger/index/index.tpl">首页</a></li>
          <li id="shop-index"><a href="/messenger/shop/index.tpl">店铺</a></li>
          <li class="am-dropdown" data-am-dropdown>
            <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
              其他 <span class="am-icon-caret-down"></span>
            </a>
            <ul class="am-dropdown-content">
              <li class="am-dropdown-header">查询 / Check</li>
              <li id="index-siteauthorize"><a href="/messenger/index/siteauthorize.tpl">许可站点</a></li>
              <li class="am-dropdown-header">公益 / Public Interest</li>
              <li id="index-open"><a href="/messenger/index/open.tpl">源码开放</a></li>
              <li class="am-dropdown-header">关于 / About</li>
              <li id="index-join"><a href="/messenger/index/join.tpl">加入我们</a></li>
              <li id="index-about"><a href="/messenger/index/about.tpl">关于我们</a></li>
              <!-- <li class="am-divider"></li> -->
            </ul>
          </li>
        </ul>
        <div class="am-topbar-right">
          <?php if(empty($_COOKIE['user_token'])): ?>
            <button class="am-btn am-btn-default-o am-topbar-btn am-btn-sm" onclick="location.href='/messenger/user/signin.tpl'">登录</button>
            <button class="am-btn am-btn-default-o am-topbar-btn am-btn-sm" onclick="location.href='/messenger/user/signup.tpl'">注册</button>
          <?php else: ?>
            <button class="am-btn am-btn-default-o am-topbar-btn am-btn-sm" onclick="location.href='/messenger/user/index.tpl';">用户中心</button>
            <button class="am-btn am-btn-default-o am-topbar-btn am-btn-sm" onclick="logout('/messenger/user/signout.tpl?app_type=api');">退出登录</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
  <!-- ./Topbar  -->

<div>
  
  <div class="curtain">
    <div class="am-container am-g">
      <div class="am-u-md-7 am-show-md-up">
        <img class="am-center am-img-responsive am-animation-fade am-center" height="350px" width="350px" src="/Applications/messenger/View/user/img/paper.png">
      </div>
      <div class="am-u-md-5 am-u-sm-12 curtain-signup am-animation-slide-bottom curtain-panel-delay">
          
          <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
              <h2 class="am-panel-title am-text-center">注册<?php echo @APP_NAME; ?>帐号</h2>
            </div>
            <div class="am-panel-bd">
              <div class="am-input-group am-input-group-secondary input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-user am-icon-fw"></i></span>
                <input id="username" type="text" class="am-form-field am-radius" placeholder="用户名" maxlength="16" onfocus="javascript:f_username();">
              </div>
              <div class="am-input-group am-input-group-success input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-envelope am-icon-fw"></i></span>
                <input id="email" type="email" class="am-form-field am-radius" placeholder="电子邮箱/Email" maxlength="64" onfocus="f_email();">
              </div>
              <div class="am-input-group am-input-group-warning input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-lock am-icon-fw"></i></span>
                <input id="password" type="password" class="am-form-field am-radius" placeholder="密码/Password" maxlength="16" onfocus="f_password();">
              </div>
              <div class="am-input-group am-input-group-warning input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-lock am-icon-fw"></i></span>
                <input id="repassword" type="password" class="am-form-field am-radius" placeholder="重复密码/Password" maxlength="16" onfocus="f_password();">
              </div>
              <div class="am-g">
                <div class="am-u-lg-6 am-u-sm-7">
                  <strong><a href="/messenger/user/signin.tpl">已有帐号?</a></strong>
                </div>
                <div class="am-u-lg-6 am-u-sm-5 am-text-right">
                  <buttom class="am-btn am-btn-success am-radius" onclick="signup();">注册 <i class="am-icon am-icon-hand-spock-o"></i></buttom>
                </div>
                <hr />
              </div>
            </div>
            <div class="am-panel-footer">
              <small><font id="tips" color="#333">欢迎使用<?php echo @APP_NAME; ?></font></small>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
</div>

<div class="am-modal am-modal-alert" tabindex="-1" id="alert">
  <div class="am-modal-dialog">
    <div class="am-modal-bd" style="padding:0px;border:0px;">
      <div class="am-alert" style="margin:0px;" id="alert-content"></div>
    </div>
  </div>
</div>


<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">请稍候。。。</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>

  <div class="footer-container">
    <hr class="footer" />
    <div class="footer am-footer">
      <div class="am-container am-g">
        <!-- 联系我们 -->
        <div class="am-u-md-3 am-u-sm-12">
          <h5 class="footer am-monospace am-sm-only-text-left">联系我们</h5>
          <p class="footer am-text-center am-serif am-sm-only-text-left">
            <i class="am-icon am-icon-qq"></i> 群215950801<br />
            <!-- 企鹅群：---------<br /> -->
            <i class="am-icon am-icon-phone"></i> 13094761170<br />
            <i class="am-icon am-icon-envelope"></i> 327928971@qq.com
          </p>
        </div>
        <!-- ./联系我们 -->
        <!-- 友情链接 -->
        <div class="am-u-md-4 am-u-sm-12" style="border-right:1px solid rgb(215,215,215);border-left:1px solid rgb(215,215,215);height:120px;">
          <h5 class="footer am-monospace am-sm-only-text-left">友情链接</h5>
          <p class="footer am-text-center am-selif am-sm-only-text-left">
            <a class="footer" href="http://www.twocola.com/" target="_blank">两杯可乐网</a><br />
          </p>
        </div>
        <!-- ./友情链接 -->
        <!-- 关于 -->
        <div class="am-u-md-5 am-u-sm-12" style="height:120px;">
          <h5 class="footer am-monospace am-sm-only-text-left">关于</h5>
          <p class="footer am-text-left am-kai am-sm-only-text-left">
            <?php echo @APP_NAME; ?>是一家专为百度贴吧传话铺子提供免费服务的网站，致力于提高传话铺子的下单、返单等流程操作效率。
          </p>
        </div>
        <!-- ./关于 -->
      </div>
    </div>
    <div class="footer-bottom am-footer">
      <div class="am-container am-g">
        <div class="am-u-md-6 am-u-sm-12 am-text-left">
          <a class="footer-bottom" target="_blank" href="/messenger/index/about.tpl">关于我们</a> |
          <a class="footer-bottom" target="_blank" href="/messenger/index/join.tpl">加入我们</a> |
          <a class="footer-bottom" target="_blank" href="/messenger/index/open.tpl">源码开放</a>
        </div>
        <div class="am-u-md-6 am-u-sm-12 am-text-right am-sm-only-text-left"><a class="footer-bottom" href="/messenger/admin/index.tpl">当前版本：<?php echo @APP_VERSION; ?></a></div>
      </div>
    </div>
  </div>
</body>
</html>

