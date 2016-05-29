<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
  var url_signup = "{:U('user/signup?app_type=api')}";
  // var url_signup_email = "{:U('user/signup_email')}";
  var url_signup_email = "{:U('user/index')}";
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
          <!-- Signin Panel -->
          <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
              <h2 class="am-panel-title am-text-center">注册{__APP_NAME__}帐号</h2>
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
                  <strong><a href="{:U('user/signin')}">已有帐号?</a></strong>
                </div>
                <div class="am-u-lg-6 am-u-sm-5 am-text-right">
                  <buttom class="am-btn am-btn-success am-radius" onclick="signup();">注册 <i class="am-icon am-icon-hand-spock-o"></i></buttom>
                </div>
                <hr />
              </div>
            </div>
            <div class="am-panel-footer">
              <small><font id="tips" color="#333">欢迎使用{__APP_NAME__}</font></small>
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
