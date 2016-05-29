<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
var url_verify_email = "{:U('shop/send_verify_email?app_type=api')}";
var url_shop_open = "{:U('shop/open_apply?app_type=api')}";
$(function(){
  textarea();
  $(window).resize(function(){
    textarea();
  });
});
function textarea(){
  $("textarea#shopintro").width($("div.am-u-sm-12").width()-18);
  $("textarea#shopintro").height("100px");
}
function accept(){
  $("#rule").hide();
  $("#table").removeClass("am-hide");
  textarea();
}
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container">
    <!-- article -->
    <div id="rule">
      <article class="am-article">
        <div class="am-article-hd">
          <h1 class="am-article-title">{__APP_NAME__} 店铺开通协议<span class="am-badge">v1.0</span></h1>
          <p class="am-article-meta">两杯可乐工作室（{__APP_NAME__}官方运营团队）</p>
        </div>

        <div class="am-article-bd">
          <p class="am-article-lead">请在运营过程中严格遵守以下协议，否则维运团队有权关闭您的店铺。</p>
          <p>1、申请开通铺子的店长在本站需达到2级或2级以上（通过邀请加入的店铺除外）；</p>
          <p>2、申请开通的铺子名不得与之前已开通的铺子名重名（重名情况系统会提示，如使用非法手段开通重名铺子将被封禁）；</p>
          <p>3、申请开通的店铺店长必须长期在线或有能力长期通知店铺成员做单；</p>
          <p>4、请务必以用户利益为重；</p>
          <p>5、贴吧转到本站的店铺审核可能较慢，请耐心等待；</p>
          <p>6、贴吧转到本站的店铺必须拥有5个及以上的成员（包含店长），请务必在7天内将成员添加至自己的店铺。</p>
        </div>
      </article>
      <div class="btn am-text-center"><button class="am-btn am-btn-warning" onclick="javascript:accept();">接受并承诺严格执行</button></div>
    </div>
    <!-- ./article -->
    <div id="table" class="am-g am-hide">
      <div class="am-u-md-offset-3 am-u-sm-12 am-u-md-6">
        <h2>店铺开通申请表</h2>

        <label for="username">申请用户</label>
        <div class="am-input-group am-input-group-primary input-group-margin-bottom">
          <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
          <input id="username" name="username" type="text" class="am-form-field" placeholder="用户名（本项自动填写）" value="{!COOKIE:username}" disabled="disabled">
        </div>


        <label for="email">店长邮箱<small style="color:red;">（提交成功修改的是您账户的邮箱）</small></label>
        <div class="am-input-group am-input-group-primary input-group-margin-bottom">
          <span class="am-input-group-label"><i class="am-icon-envelope am-icon-fw"></i></span>
          <input id="email" name="email" type="text" class="am-form-field" placeholder="例：example@yourdomain.com" value="{$email}">
        </div>

        <label for="shopname">店铺名称</label>
        <div class="am-input-group am-input-group-primary input-group-margin-bottom">
          <span class="am-input-group-label"><i class="am-icon-flag am-icon-fw"></i></span>
          <input id="shopname" name="shopname" type="text" class="am-form-field" placeholder="例：夏至未至" maxlength="12">
        </div>

        <label for="shopname">店铺简介</label>
        <div class="am-input-group am-input-group-primary input-group-margin-bottom">
          <textarea id="shopintro" name="shopintro" class="am-form-field" rows=5 placeholder="店铺简介（200字以内）" maxlength="200"></textarea>
        </div>

        <label for="verify_email">邮箱验证码</label>
        <div class="am-input-group am-input-group-primary input-group-margin-bottom">
          <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
          <input id="verify_email" name="verify_email" type="text" class="am-form-field" placeholder="例：123456">
        </div>

        <div class="am-text-right">
          <button class="am-btn am-btn-warning" onclick="javascript:verfiy_email();" id="btn_email">发送邮箱验证码</button>
          <button class="am-btn am-btn-primary am-hide" onclick="javascript:apply();" id="btn_apply">提交申请</button>
        </div>

      </div>
    </div>
    <!-- success -->
    <div id="success" class="am-g am-hide">
      <div class="am-u-md-offset-3 am-u-sm-12 am-u-md-6">
        <h2>申请成功！</h2>
        <p>您的申请已经提交，结果会发放至您的邮箱！</p>
        <p>在店铺开通后，请严格遵守当地法律法规，且严格按照下列协议运营。</p>
        <hr />
          <p>1、申请开通铺子的店长在本站需达到2级或2级以上（通过邀请加入的店铺除外）；</p>
          <p>2、申请开通的铺子名不得与之前已开通的铺子名重名（重名情况系统会提示，如使用非法手段开通重名铺子将被封禁）；</p>
          <p>3、申请开通的店铺店长必须长期在线或有能力长期通知店铺成员做单；</p>
          <p>4、请务必以用户利益为重；</p>
          <p>5、贴吧转到本站的店铺审核可能较慢，请耐心等待；</p>
          <p>6、贴吧转到本站的店铺必须拥有5个及以上的成员（包含店长），请务必在7天内将成员添加至自己的店铺。</p>
          <hr />
          <p class="am-text-right" style="color:#666666;"><small>两杯可乐工作室（{__APP_NAME__}官方运营团队）</small></p>
          <div class="am-text-right">
            <button class="am-btn am-btn-success" onclick="javascript:location.href='{:U('user/index')}'">返回个人中心</button>
          </div>
      </div>
    </div>
    <!-- ./success -->
  </div>
  <!-- ./Curtain -->
</div>
<!-- Modal -->
<div class="am-modal am-modal-alert" tabindex="-1" id="alert">
  <div class="am-modal-dialog">
    <div class="am-modal-bd" style="padding:0px;border:0px;">
      <div class="am-alert am-alert-warning" style="margin:0px;" id="alert-content"></div>
    </div>
  </div>
</div>
<!-- ./Modal -->
<!-- Loading -->
<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">请稍候。。。</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>
<!-- ./Loading -->
<include file='PUBLIC-footer' type='footer' />
