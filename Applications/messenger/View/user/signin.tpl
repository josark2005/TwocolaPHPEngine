<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
  <empty name="_GET['jumpfrom']">
  var url_signin = "`$url_signin`";
  <else />
  var url_signin = "`$_GET['jumpfrom']`";
  </empty>
  var url_api_signin = "{:U('user/signin?app_type=api')}";
</script>
<include file='PUBLIC-nav' type='nav' />
<div>
  <!-- Slider(1600*350) -->
  <!-- <div data-am-widget="slider" class="am-slider am-slider-a5" data-am-slider='{&quot;directionNav&quot;:false}' >
    <ul class="am-slides">
       <li><img src="http://s.amazeui.org/media/i/demos/bing-1.jpg"></li>
    </ul>
  </div> -->
  <!-- ./Slider -->
  <!-- Curtain -->
  <div class="curtain container">
    <div class="am-container am-g">
      <div class="am-u-md-7 am-show-md-up">
        <img class="am-center am-img-responsive am-animation-fade am-center" height="230px" width="230px" src="__IMG:house.png__">
      </div>
      <div class="am-u-md-5 am-u-sm-12 am-animation-slide-bottom curtain-panel-delay">
        <!-- Signin Panel -->
        <div class="am-panel am-panel-primary">
  				<div class="am-panel-hd">
  					<h2 class="am-panel-title am-text-center">登录{__APP_NAME__}帐号</h2>
  				</div>
  				<div class="am-panel-bd">
						<div class="am-input-group am-input-group-secondary input-group-margin-bottom">
						  <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
						  <input id="username" type="text" class="am-form-field" placeholder="UID/用户名/电子邮箱" tabindex="1">
						</div>

						<div class="am-input-group am-input-group-warning input-group-margin-bottom">
						  <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
						  <input id="password" type="password" class="am-form-field" placeholder="登录密码" tabindex="2">
						</div>
						<div class="am-g">
							<div class="am-u-lg-6 am-u-sm-7">
								<strong><a href="{:U('user/forget_password')}" tabindex="-1">忘记密码?</a></strong>
							</div>
							<div class="am-u-lg-6 am-u-sm-5 am-text-right">
                <buttom class="am-btn am-btn-success am-radius" onclick="signin();" tabindex="3">登录 <i class="am-icon am-icon-hand-spock-o"></i></buttom>
							</div>
							<hr />
						</div>
  				</div>
  				<div class="am-panel-footer">
  					<small>*为了您的账户安全，请确认当前是{__APP_NAME__}官网。</small>
  				</div>
  			</div>
        <!-- ./Signin Panel -->
      </div>
      <div class="am-u-sm-12">
        <div class="am-alert alert-radius am-alert-warning am-animation-slide-bottom am-text-center am-show-md-up am-animation-delay-1" data-am-alert>
          还没有账户？<a href="{:U('user/signup?from=twocola&id=0')}" tabindex="-1">点此注册</a>！
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
