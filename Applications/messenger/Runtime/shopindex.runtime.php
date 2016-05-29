<?php $TITLE='店铺' ?><?php $pagination=array (
  'index' => 
  array (
    'show' => 'n',
    'active' => 'none',
    'text' => '&laquo;',
    'page' => '1',
  ),
  'b1' => 
  array (
    'show' => 'y',
    'active' => 'active',
    'text' => '1',
    'page' => '1',
  ),
  'b2' => 
  array (
    'show' => 'y',
    'active' => 'none',
    'text' => '2',
    'page' => '2',
  ),
  'b3' => 
  array (
    'show' => 'y',
    'active' => 'none',
    'text' => '3',
    'page' => '3',
  ),
  'end' => 
  array (
    'show' => 'y',
    'active' => 'none',
    'text' => '&raquo;',
    'page' => 10,
  ),
) ?><?php $shops=array (
  0 => 
  array (
    'shop_id' => '3',
    'level' => '0',
    'uid' => '3',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  1 => 
  array (
    'shop_id' => '2',
    'level' => '0',
    'uid' => '2',
    'name' => '夏末夏至',
    'description' => '夏末夏至传话铺子的简介',
    'status' => '100000',
  ),
  2 => 
  array (
    'shop_id' => '4',
    'level' => '0',
    'uid' => '4',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  3 => 
  array (
    'shop_id' => '5',
    'level' => '0',
    'uid' => '5',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  4 => 
  array (
    'shop_id' => '6',
    'level' => '0',
    'uid' => '6',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  5 => 
  array (
    'shop_id' => '7',
    'level' => '0',
    'uid' => '10',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  6 => 
  array (
    'shop_id' => '8',
    'level' => '0',
    'uid' => '16',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  7 => 
  array (
    'shop_id' => '9',
    'level' => '0',
    'uid' => '11',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  8 => 
  array (
    'shop_id' => '10',
    'level' => '0',
    'uid' => '12',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
  9 => 
  array (
    'shop_id' => '11',
    'level' => '0',
    'uid' => '13',
    'name' => '-',
    'description' => '无描述',
    'status' => '100000',
  ),
) ?><?php $cshop='96' ?><!DOCTYPE html>
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

<link rel='stylesheet' href='/Applications/messenger/View/shop/css/index.css'><script src='/Applications/messenger/View/shop/js/index.js'></script>
<script language="javascript">
var url_shop = "/messenger/shop/index.tpl?page=";
function show(id){
  var height,width,top,left;
  top = $("article#"+id).offset().top;
  left = $("article#"+id).offset().left;
  height = $("article#"+id).height();
  width = $("article#"+id).width();
  $("div#"+id).addClass("am-hide");
}
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

<div class="container">
  
  <div class="am-container">
    <h2 class="title am-monospace"><i class="am-icon-flag"></i> 店铺一览</h2>
    <hr />
    
    <div class="shop-list">
      <?php if(is_array($shops)):foreach($shops as $key=>$shop): ?>
        <article class="am-article" id="<?php if(isset($shop['shop_id'])){echo ($shop['shop_id']);} ?>">
          <div class="am-article-hd">
            <h2 class="am-article-title am-monospace shop-title">
              <span class="am-badge am-badge-success am-text-md">Lv.<?php if(isset($shop['level'])){echo ($shop['level']);} ?></span>
              <span class="am-badge am-badge-success am-text-md"><?php if(isset($shop['shop_id'])){echo ($shop['shop_id']);} ?></span>
              <?php if(isset($shop['name'])){echo ($shop['name']);} ?>
              <button class="am-btn am-btn-sm am-btn-default am-radius am-fr a-btn am-hide">进入</button>
              <button class="am-btn am-btn-sm am-btn-primary am-radius am-fr a-btn">下单</button>
              <button class="am-btn am-btn-sm am-btn-success am-radius am-fr a-btn">加入</button>
            </h2>
          </div>
          <div class="am-article-bd">
            <p class="am-article-lead"><?php if(isset($shop['description'])){echo ($shop['description']);} ?></p>
          </div>
        </article>
        <hr />
      <?php endforeach;endif; ?>
      <ul class="am-pagination am-text-right">
        <?php if(is_array($pagination)):foreach($pagination as $key=>$value): ?>
          <?php if($value['show']=='y'): ?>
            <li <?php if($value['active']=='active'): ?>class="am-active"<?php endif; ?>><a href="javascript:location.href='/messenger/shop/index.tpl?page=<?php if(isset($value['page'])){echo ($value['page']);} ?>';"><?php if(isset($value['text'])){echo ($value['text']);} ?></a></li>
          <?php endif; ?>
        <?php endforeach;endif; ?>
        <li>
          <div class="am-input-group am-input-group-sm" style="width:120px;margin-bottom:-10px">
            <input type="text" class="am-form-field" id="turn_page">
            <span class="am-input-group-btn">
              <button class="am-btn am-btn-default" type="button" onclick="jump();">跳转</button>
            </span>
          </div>
        </li>
      </ul>

      <p class="am-text-right"><small>(共<?php if(isset($cshop)){echo ($cshop);} ?>个铺子运营)</small></p>
    </div>
    
  </div>
  
</div>

<div class="am-modal am-modal-alert" tabindex="-1" id="alert">
  <div class="am-modal-dialog">
    <div class="am-modal-bd" style="padding:0px;border:0px;">
      <div class="am-alert am-alert-warning" style="margin:0px;" id="alert-content"></div>
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

