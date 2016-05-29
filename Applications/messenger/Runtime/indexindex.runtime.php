<?php $TITLE='应用名称' ?><!DOCTYPE html>
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

<link rel='stylesheet' href='/Applications/messenger/View/index/css/index.css'>
<link rel="stylesheet" href="//cdn.bootcss.com/fullPage.js/2.7.7/jquery.fullPage.min.css">
<script language="javascript" src="//cdn.bootcss.com/fullPage.js/2.7.7/jquery.fullPage.min.js"></script>
<script language="javascript" src="//cdn.bootcss.com/fullPage.js/2.7.7/vendors/jquery.easings.min.js"></script>
<script language="javascript" src="//cdn.bootcss.com/fullPage.js/2.7.7/vendors/jquery.slimscroll.min.js"></script>
<script language="javascript">
$(document).ready(function() {
  //判断视口大小调整topbar
  if($(window).width()<=640){
    $(".am-topbar").addClass("m-topbar");
  }
  //窗口监听
  $(window).resize(function(){
    if($(window).width()<=640){
      $(".am-topbar").addClass("m-topbar");
    }else{
      $(".am-topbar").removeClass("m-topbar");
    }
  });
  $('#fullpage').fullpage({
    navigation: 1,
    verticalCentered: 1,
    sectionsColor: ['#0091c6','#00b428','#ff4bd7','#ffa500','#ff3c3c'],
    onLeave: function(index, nextIndex, direction){
      if($(window).width()>640){
        if(index==1&&direction=="down"){
          $(".am-topbar").animate({top:-51},700);
        }else if(index==2&&direction=="up"){
          $(".am-topbar").animate({top:0},200);
        }else if(nextIndex==1){
          $(".am-topbar").animate({top:0},700);
        }
      }else{
        if(nextIndex==6){
          $(".am-topbar").animate({top:-51},700);
        }else{
          $(".am-topbar").animate({top:0},700);
        }
      }
    },
  });
});
</script>
<style>
  .am-topbar{
    position: fixed;
    z-index: 10;
    width: 100%;
  }
  .section {overflow: hidden;}
</style>
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

<div id="fullpage">
  <div class="section">
    <div class="am-container am-g" style="margin-top:-51px;">
      <div class="am-u-md-3" style="margin-top:61px;">
        <img class="am-center am-animation-fade" height="160px" width="160px;" src="/Applications/messenger/View/public/static/logo.png">
      </div>
      <div class="am-u-md-9">
        <h2 class="am-serif curtain-title am-animation-slide-left am-sm-only-text-center"><?php echo @APP_NAME; ?> - 两杯可乐网</h2>
        <p class="am-serif curtain-p am-animation-slide-bottom dely-p am-sm-only-text-center">两杯可乐：为温暖提供无限可能 <i class="am-icon am-icon-hand-spock-o"></i></p>
        <div class="am-sm-only-text-center">
          <button class="am-btn am-btn-default-o" onclick="location.href='/messenger/user/signin.tpl?from=index'">我要下单</button>
          <button class="am-btn am-btn-default-o" onclick="location.href='/messenger/user/signup.tpl?from=index'">我要加入</button>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="/Applications/messenger/View/index/img/clock.png" style="margin-top:71px;" alt="<?php echo @APP_NAME; ?>">
      </div>
      <div clas="am-u-md-9">
        <h2 class="am-serif curtain-title am-sm-only-text-center">快速响应</h2>
        <p class="am-serif curtain-p"><?php echo @APP_NAME; ?>为各大传话铺子提供了很多方便的通知方式，当接单员或客户（来自客户的订单将随机分配给各大传话铺子）将订单上传后，我们将会即时使用电子邮件、短信等方式通知店铺成员，以便店铺成员快速进行响应。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="/Applications/messenger/View/index/img/user.png"  style="margin-top:56px;">
      </div>
      <div clas="am-u-md-9">
        <h2 class="am-serif curtain-title am-sm-only-text-center">精确定位</h2>
        <p class="am-serif curtain-p"><?php echo @APP_NAME; ?>使用同位链接定位方式，即接单人上传订单时填写的链接或地址，这样可以快速精确的定位到下单人，使每一条订单都能让下单人满意。无错单是我们追求的目标。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-centeram-img-responsive" height="160px" width="160px;" src="/Applications/messenger/View/index/img/feedback.png" style="margin-top:81px;">
      </div>
      <div clas="am-u-md-9" style="padding-top:35px;">
        <h2 class="am-serif curtain-title am-sm-only-text-center">格式返单</h2>
        <p class="am-serif curtain-p"><?php echo @APP_NAME; ?>使用了预定义格式，返单内容将会被自动处理成类似当前页面的格式（以实际为准），无论是图片还是文字，都能良好的适应，每次返单都是艺术创作。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="/Applications/messenger/View/index/img/star.png" style="margin-top:96px;">
      </div>
      <div clas="am-u-md-9" style="padding-top:25px;">
        <h2 class="am-serif curtain-title am-sm-only-text-center">收单评价</h2>
        <p class="am-serif curtain-p"><?php echo @APP_NAME; ?>使用了基于电商的运营模式，当每个单子被签收时会要求下单人进行收单评价，为保证评价的有效性，收单时不评价或低星评价的理由不充分时，评价将被驳回（驳回评价会通知下单人）。</p>
      </div>
    </div>
  </div>
  
  <div class="fp-auto-height section">
    <div class="footer am-footer">
      <div class="am-container am-g">
        
        <div class="am-u-md-3 am-u-sm-12">
          <h5 class="footer am-monospace am-sm-only-text-left">联系我们</h5>
          <p class="footer am-text-center am-serif am-sm-only-text-left">
            <i class="am-icon am-icon-qq"></i> 群215950801<br />
            
            <i class="am-icon am-icon-phone"></i> 13094761170<br />
            <i class="am-icon am-icon-envelope"></i> 327928971@qq.com
          </p>
        </div>
        
        
        <div class="am-u-md-4 am-u-sm-12" style="border-right:1px solid rgb(215,215,215);border-left:1px solid rgb(215,215,215);height:120px;">
          <h5 class="footer am-monospace am-sm-only-text-left">友情链接</h5>
          <p class="footer am-text-center am-selif am-sm-only-text-left">
            <a class="footer" href="http://www.twocola.com/" target="_blank">两杯可乐网</a><br />
          </p>
        </div>
        
        
        <div class="am-u-md-5 am-u-sm-12" style="height:120px;">
          <h5 class="footer am-monospace am-sm-only-text-left">关于</h5>
          <p class="footer am-text-left am-kai am-sm-only-text-left">
            <?php echo @APP_NAME; ?>是一家专为百度贴吧传话铺子提供免费服务的网站，致力于提高传话铺子的下单、返单等流程操作效率。
          </p>
        </div>
        
      </div>
    </div>
    <div class="footer-bottom am-footer">
      <div class="am-container am-g">
        <div class="am-u-sm-6 am-text-left">
          <a class="footer-bottom" target="_blank" href="/messenger/index/about.tpl">关于我们</a>
        </div>
        <div class="am-u-sm-6 am-text-right"><a class="footer-bottom" href="/messenger/admin/index.tpl">当前版本：<?php echo @APP_VERSION; ?></a></div>
      </div>
  
</div>
</body>
</html>
