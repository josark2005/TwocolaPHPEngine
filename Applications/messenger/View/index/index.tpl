<include file='PUBLIC-header' type='autoheader' />
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
<include file='PUBLIC-nav' type='nav' />
<div id="fullpage">
  <div class="section">
    <div class="am-container am-g" style="margin-top:-51px;">
      <div class="am-u-md-3" style="margin-top:61px;">
        <img class="am-center am-animation-fade" height="160px" width="160px;" src="__STATIC:logo.png__">
      </div>
      <div class="am-u-md-9">
        <h2 class="am-serif curtain-title am-animation-slide-left am-sm-only-text-center">{__APP_NAME__} - 两杯可乐网</h2>
        <p class="am-serif curtain-p am-animation-slide-bottom dely-p am-sm-only-text-center">两杯可乐：为温暖提供无限可能 <i class="am-icon am-icon-hand-spock-o"></i></p>
        <div class="am-sm-only-text-center">
          <button class="am-btn am-btn-default-o" onclick="location.href='{:U('user/signin?from=index')}'">我要下单</button>
          <button class="am-btn am-btn-default-o" onclick="location.href='{:U('user/signup?from=index')}'">我要加入</button>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="__IMG:clock.png__" style="margin-top:71px;" alt="{__APP_NAME__}">
      </div>
      <div clas="am-u-md-9">
        <h2 class="am-serif curtain-title am-sm-only-text-center">快速响应</h2>
        <p class="am-serif curtain-p">{__APP_NAME__}为各大传话铺子提供了很多方便的通知方式，当接单员或客户（来自客户的订单将随机分配给各大传话铺子）将订单上传后，我们将会即时使用电子邮件、短信等方式通知店铺成员，以便店铺成员快速进行响应。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="__IMG:user.png__"  style="margin-top:56px;">
      </div>
      <div clas="am-u-md-9">
        <h2 class="am-serif curtain-title am-sm-only-text-center">精确定位</h2>
        <p class="am-serif curtain-p">{__APP_NAME__}使用同位链接定位方式，即接单人上传订单时填写的链接或地址，这样可以快速精确的定位到下单人，使每一条订单都能让下单人满意。无错单是我们追求的目标。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-centeram-img-responsive" height="160px" width="160px;" src="__IMG:feedback.png__" style="margin-top:81px;">
      </div>
      <div clas="am-u-md-9" style="padding-top:35px;">
        <h2 class="am-serif curtain-title am-sm-only-text-center">格式返单</h2>
        <p class="am-serif curtain-p">{__APP_NAME__}使用了预定义格式，返单内容将会被自动处理成类似当前页面的格式（以实际为准），无论是图片还是文字，都能良好的适应，每次返单都是艺术创作。</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="am-container am-g">
      <div class="am-u-md-3">
        <img class="am-center am-img-responsive" height="160px" width="160px;" src="__IMG:star.png__" style="margin-top:96px;">
      </div>
      <div clas="am-u-md-9" style="padding-top:25px;">
        <h2 class="am-serif curtain-title am-sm-only-text-center">收单评价</h2>
        <p class="am-serif curtain-p">{__APP_NAME__}使用了基于电商的运营模式，当每个单子被签收时会要求下单人进行收单评价，为保证评价的有效性，收单时不评价或低星评价的理由不充分时，评价将被驳回（驳回评价会通知下单人）。</p>
      </div>
    </div>
  </div>
  <!--footer-->
  <div class="fp-auto-height section">
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
            {__APP_NAME__}是一家专为百度贴吧传话铺子提供免费服务的网站，致力于提高传话铺子的下单、返单等流程操作效率。
          </p>
        </div>
        <!-- ./关于 -->
      </div>
    </div>
    <div class="footer-bottom am-footer">
      <div class="am-container am-g">
        <div class="am-u-sm-6 am-text-left">
          <a class="footer-bottom" target="_blank" href="{:U('index/about')}">关于我们</a>
        </div>
        <div class="am-u-sm-6 am-text-right"><a class="footer-bottom" href="{:U('admin/index')}">当前版本：{__APP_VERSION__}</a></div>
      </div>
  <!--./footer-->
</div>
</body>
</html>
