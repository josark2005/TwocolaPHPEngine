<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
  var url_api_signup_email = "{:U('user/signup_email?app_type=api')}";
  var url_api_signup_email_apply = "{:U('user/signup_email_apply?app_type=api')}";
  <empty name='_GET['jumpfrom']'>
    var url_jump = "{:U('user/index')}";
  <else />
    var url_jump = "`$_GET['jumpfrom']`";
  </empty>
</script>
<include file='PUBLIC-nav' type='nav' />
<div>
  <!-- Curtain -->
  <div class="curtain">
    <div class="am-container am-g">
      <div class="am-u-md-7 am-show-md-up">
        <img class="am-center am-img-responsive am-animation-fade am-center" height="350px" width="350px" src="__IMG:paper.png__">
      </div>
      <div class="am-u-md-5 am-u-sm-12 curtain-signup am-animation-slide-bottom curtain-panel-delay">
          <!-- alert -->
          <notempty name='_GET['tips']'><div class="am-alert am-alert-warning">`$_GET['tips']`</div></notempty>
          <!-- ./alert -->
          <!-- Signin Panel -->
          <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
              <h2 class="am-panel-title am-text-center">验证{__APP_NAME__}帐号</h2>
            </div>
            <div class="am-panel-bd">
              <div class="am-input-group am-input-group-secondary input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-user am-icon-fw"></i></span>
                <input id="username" type="text" class="am-form-field am-radius" placeholder="用户名" maxlength="16" value="{!COOKIE:username}" disabled>
              </div>
              <div class="am-input-group am-input-group-success input-group-margin-bottom">
                <span class="am-input-group-label am-radius"><i class="am-icon-envelope am-icon-fw"></i></span>
                <input id="email" type="email" class="am-form-field am-radius" placeholder="电子邮箱/Email" maxlength="64" value="{$email}">
              </div>
              <div class="am-input-group am-input-group-primary input-group-margin-bottom">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input id="verify_email" name="verify_email" type="text" class="am-form-field" placeholder="6位邮箱验证码">
              </div>
              <div class="am-text-right">
                <buttom id="btn_send" class="am-btn am-btn-success am-radius" onclick="signup_email();">发送验证邮件 <i class="am-icon am-icon-send"></i></buttom>
                <buttom id="btn_verify" class="am-btn am-btn-primary am-radius am-hide" onclick="signup_apply();">提交 <i class="am-icon am-icon-check"></i></buttom>
              </div>
            </div>
            <div class="am-panel-footer">
              <small><font id="tips" color="#333">没收到邮件？看看垃圾箱里有木有哦~</font></small>
            </div>
          </div>
          <!-- ./Signin Panel -->
        </div>
      </div>
    </div>
  </div>
  <!-- ./Curtain -->
</div>
<!-- Modal -->
<div class="am-modal am-modal-alert" tabindex="-1" id="alert">
  <div class="am-modal-dialog">
    <div class="am-modal-bd" style="padding:0px;border:0px;">
      <div class="am-alert" style="margin:0px;" id="alert-content"></div>
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
