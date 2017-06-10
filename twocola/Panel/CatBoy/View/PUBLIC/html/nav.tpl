<header class="am-topbar">
  <div class="am-container">
    <h1 class="am-topbar-brand">
      <a href="javascript:;" class="am-text-ir">{__APP_NAME__}</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar'}"><span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar">
      <ul class="am-nav am-nav-pills am-topbar-nav">
        <li id="index-index"><a href="{:U('index/index?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">开始</a></li>
        <li class="am-dropdown" data-am-dropdown>
          <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
            开发手册 <span class="am-icon-caret-down"></span>
          </a>
          <ul class="am-dropdown-content">

            <li class="am-dropdown-header">函数及方法</li>
            <li id="manner-functions"><a href="{:U('manner/functions?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">全局方法</a></li>

            <li class="am-divider"></li>

            <li class="am-dropdown-header">设置相关</li>
            <li id="manner-settings_notice"><a href="{:U('manner/settings_notice?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">设置注意事项</a></li>
            <li id="manner-settings"><a href="{:U('manner/settings?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">全局设置</a></li>
            <li id="manner-app_settings"><a href="{:U('manner/app_settings?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">应用设置</a></li>

          </ul>
        </li>
        <li id="index-about"><a href="{:U('index/about?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}')}">关于</a></li>
      </ul>

    </div>
  </div>
</header>
