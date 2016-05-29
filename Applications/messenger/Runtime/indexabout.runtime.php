<?php $TITLE='关于' ?><!DOCTYPE html>
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

<div class="container" style="padding-top:10px;">
  
  <div class="am-container">
    
    <div>
      <article class="am-article">
        <div class="am-article-hd">
          <h1 class="am-article-title"><?php echo @APP_NAME; ?></h1>
          <p class="am-article-meta">两杯可乐工作室（<?php echo @APP_NAME; ?>官方运营团队）</p>
        </div>

        <div class="am-article-bd">
          <p class="am-article-lead">来自两杯可乐的灵感与故事。</p>
          <p>其实<?php echo @APP_NAME; ?>原来并不是一个网站，而是一个简单的开发框架，当然一开始也不是这个名字。</p>
          <P>故事要从两杯可乐开始说起。</p>
          <P>也记不清是哪天了，只记得跟<span class="am-badge">那个少年</span>约好一起去散散步，锻炼锻炼。后来散步散乏了，便就近去了一家肯德基。（不要问我为什么又是肯德基）点了两杯可乐，一份薯条我们就坐了很久，也聊了很多。我们聊人生，聊创业，聊思想。总之，能聊的我们好像都聊了。</p>
          <p>聊乏了，各自打道回府，我思考了很久，决定做些什么去纪念这两杯可乐（薯条就算了，因为可乐和薯条我比较喜欢薯条），后来想到我手头上还有这个开发框架的项目，要不就做一个网站吧，接着就着手开发这个网站。</p>
          <p>因为<span class="am-badge">那个少年</span>不懂开发，所以也只能我一个人去做这件“伟大”的事。</p>
          <p>当时在考虑网站定位的时候，我正在玩百度贴吧的<span class="am-badge">传话铺子</span>，我觉得这很有意思，不仅充实了自己的空余时间，又帮助到了别人。但当时的种种操作体验十分不爽，复制来复制去，还要删除吧友下单的格式，这个体验我这辈子不想再去做第二次。所以我就想，能不能去除这个删除格式的步骤，想了又想，最终决定，就做这个网站吧！</p>
          <p>接着我又研究了每次传话的步骤，无论是用户的角度还是传话铺子的角度，我想在这里都能得到一个良好的体验。</p>
          <p>我不是想把传话铺子全部吸引到这个网站或者说是平台上来，我觉得这样也没有必要，我觉得应该让需要传话的人能快速“下单”，快速地找到能满足需求的铺子，而不是在贴吧翻，这样效率太低。</p>
          <p>我也跟身边的朋友闹过矛盾，朋友拉黑我之后，有时候真的感觉无奈，去找TA吧觉得尴尬（我性格比较犟），不去吧又联系不到，怎么办？只有借助传话铺子！但是贴吧毕竟只是一个交流的平台，它不是一个类似电商的平台，店铺无法快速响应。所以，这里的单子店铺方会得到专门的通知，以便快速响应需求方。</p>
          <p><span class="am-badge am-badge-warning">收费？免费？</span>众所周知，网站的运营是需要一定费用的，使用的人越多，费用越高。当时考虑是否收费的时候，我的第一反应就是<span class="am-badge am-badge-warning">一定要免费！</span>我觉得这是一份公益的“事业”，不能收费！可是运营费用哪里来呢？我决定接入少量广告，虽然我知道广告很让人烦，但是没办法，我只能控制广告的数量，毕竟一个人去运营一个网站是很累的。</p>
          <p>细心的朋友可能发现了，其实你把这篇文章看到现在都没有出现任何的广告，那所谓的广告去哪了呢？（当然也有可能是还没有接入）我想了很久，决定把广告区域放在用户收单页面的页尾。这样安排，一来不影响店铺接单的效率和心情，二来也照顾到了用户。用户把重要（我认为是重要的）的信息（返单）看完了才会有广告，我觉得我已经做到我的极限了。</p>
          <p>可能在这个页面放那么多文字不太好，但是我也想不出有什么其他东西放了，也就趁着还有点感触写了这篇文章，也大概就是<?php echo @APP_NAME; ?>的由来了吧！</p>
          <hr />
          <p class="am-text-right"><small>两杯可乐工作室</small><br /><small>惟易 2016</small></p>
        </div>
      </article>
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

