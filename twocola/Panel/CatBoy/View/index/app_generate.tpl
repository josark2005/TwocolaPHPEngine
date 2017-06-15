<include file="PUBLIC-header" type="autoheader" />
<include file="PUBLIC-header2" type="header" />
<include file="PUBLIC-nav" type="nav" />
<div class="am-container">
  <div class="am-g">
    <include file="PUBLIC-nav2" type="nav" />
    <!-- right -->
    <div class="am-u-md-9 am-u-sm-12">
      <div class="am-panel am-panel-default">

        <header class="am-panel-hd">
          <h3 class="am-panel-title">注意事项</h3>
        </header>
        <div class="am-panel-bd">
          <div class="am-alert am-alert-success">
            @ 您正在使用<span class="am-badge am-badge-secondary am-radius">Panel</span>的<span class="am-badge am-badge-secondary">应用创建</span>功能，此功能仅仅为您创建应用，若要设置默认应用，请<a href="{:U('index/tce_settings')}" target="_self">点击这里</a>。
          </div>
        </div>
      </div>

      <div class="am-panel am-panel-success">
        <header class="am-panel-hd">
          <h3 class="am-panel-title">创建应用</h3>
        </header>
        <div class="am-panel-bd">

          <p class="warning bottom-space">
            *应用目录与应用目录名称是不同的，应用目录是指应用统一存放的文件夹，而应用目录名称是指应用在应用统一存放文件夹中的子文件夹名称。
          </p>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">应用目录名称 <small>(APP)</small></span>
            <input id="APP" type="text" class="am-form-field" placeholder="如:APP">
          </div>

          <p class="am-text-right">
            <button class="am-btn am-btn-success am-radius" onclick="create_app();">创建应用</button>
          </p>

        </div>

      </div>

    </div>

  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
