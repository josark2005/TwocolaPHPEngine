<include file="PUBLIC-header" type="autoheader" />
<include file="PUBLIC-header_swich" type="header" />
<include file="PUBLIC-header2" type="header" />
<include file="PUBLIC-nav" type="nav" />
<div class="am-container">
  <div class="am-g">
    <include file="PUBLIC-nav2" type="nav" />
    <!-- right -->
    <div class="am-u-md-9 am-u-sm-12">

      <div id="tce_settings_warning_top" class="am-alert am-alert-warning am-animation-shake am-hide" data-am-alert>
        <button type="button" class="am-close" onclick="storger('tce_settings_warning_top',0)">&times;</button>
        <p>在这里修改配置后，被修改的配置文件中的注释内容将被全部清空，请获悉！</p>
      </div>


      <div class="am-panel am-panel-default">
        <header class="am-panel-hd">
          <h3 class="am-panel-title">框架设置修改</h3>
        </header>

        <div class="am-panel-bd">
          <!-- Infomation -->
          <h4>URL相关设置</h4>
          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">URL静态后缀</span>
            <input id="APP_SUFFIX" type="text" class="am-form-field" value="{__APP_SUFFIX__}">
          </div>

          <div class="bottom-space">
            <input id="APP_SUFFIX_SAFE"
                  type="checkbox" data-off-text="关闭" data-on-text="开启"
                  data-label-text="自适应后缀" data-on-color="success"
                  data-off-color="warning"
                  <if condition="$APP_SUFFIX_SAFE == 'true'">checked</if> >
          </div>

          <hr />
          <!-- ./Information -->
        </div>
      </div>

    </div>
    <!-- ./right -->
  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
