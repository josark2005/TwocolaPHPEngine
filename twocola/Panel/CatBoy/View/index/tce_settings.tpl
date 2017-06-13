<include file="PUBLIC-header" type="autoheader" />
<script language="javascript">
  var url_this = "{:U('index/tce_settings')}";
</script>
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

      <div id="tce_settings_warning_top2" class="am-alert am-alert-danger am-animation-shake am-hide" data-am-alert>
        <button type="button" class="am-close" onclick="storger('tce_settings_warning_top2',0)">&times;</button>
        <p>全局设置不代表设置的最终值，全局设置可以被应用设置、用户自定义设置覆盖。</p>
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
            <input id="APP_SUFFIX" type="text" class="am-form-field" value="{$config['APP_SUFFIX']}">
          </div>

          <div>
            <input id="APP_SUFFIX_SAFE"
                  type="checkbox" data-off-text="关闭" data-on-text="开启"
                  data-label-text="自适应后缀" data-on-color="success"
                  data-off-color="warning"
                  <if condition="$config['APP_SUFFIX_SAFE'] == 'true'">checked</if> data-am-switch>
            <span>*自适应后缀开启后，任何后缀都可以进行访问。</span>
          </div>

          <h4>系统设置</h4>

          <div class="am-input-group">
            <span class="am-input-group-label">默认应用</span>
            <input id="APP_DEFAULT" type="text" class="am-form-field" value="{$config['APP_DEFAULT']}">
          </div>

          <h4>Api设置</h4>

          <div id="tce_settings_warning" class="am-alert am-alert-danger am-animation-shake am-hide" data-am-alert>
            <button type="button" class="am-close" onclick="storger('tce_settings_warning',0)">&times;</button>
            <p>请谨慎修改Api相关的设置，可能导致Panel无法正常运作！</p>
          </div>

          <div class="bottom-space">
            <input id="API_PORTAL"
                  type="checkbox" data-off-text="禁止进入" data-on-text="GET模式"
                  data-label-text="Api进入模式" data-on-color="success"
                  data-off-color="danger"
                  <if condition="$config['API_PORTAL'] == 1">checked</if> data-am-switch>
            <span class="warning">*关闭后Panel无法对框架进行设置。</span>
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Api进入Key值</span>
            <input id="API_PORTAL_KEY" type="text" class="am-form-field" value="{$config['API_PORTAL_KEY']}">
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Api进入Value值</span>
            <input id="API_PORTAL_VALUE" type="text" class="am-form-field" value="{$config['API_PORTAL_VALUE']}">
          </div>

          <span class="warning">*由于上两种设置的特殊性，修改完成后请点击页面其他部分表示确认，随后页面会刷新一次保证接下来的修改正常进行。</span>

          <h4>Panel设置</h4>

          <div id="tce_settings_warning2" class="am-alert am-alert-danger am-animation-shake am-hide" data-am-alert>
            <button type="button" class="am-close" onclick="storger('tce_settings_warning2',0)">&times;</button>
            <p>请谨慎修改Panel相关的设置，部分设置将导致Panel无法访问！</p>
          </div>

          <div class="bottom-space">
            <input id="PANEL"
                  type="checkbox" data-off-text="关闭" data-on-text="开启"
                  data-label-text="Panel" data-on-color="success"
                  data-off-color="danger"
                  <if condition="$config['PANEL'] == true">checked</if> data-am-switch>
            <span class="warning">*关闭后若页面进行刷新将无法进入Panel。</span>
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Panel地址</span>
            <input id="PANEL_PATH" type="text" class="am-form-field"
             value="<if condition='$config['PANEL_PATH'] != false'>{$config['PANEL_PATH']}</if>"
             placeholder="<if condition="$config['PANEL_PATH'] == false">false (默认地址)</if>" >
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Panel名称</span>
            <input id="PANEL_NAME" type="text" class="am-form-field" value="{$config['PANEL_NAME']}">
          </div>

          <div class="bottom-space">
            <input id="PANEL_PORTAL"
                  type="checkbox" data-off-text="自动" data-on-text="GET"
                  data-label-text="Panel入口方式" data-on-color="success"
                  data-off-color="warning"
                  <if condition="$config['PANEL_PORTAL'] == 1">checked</if> data-am-switch>
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Panel进入Key值</span>
            <input id="PANEL_PORTAL_KEY" type="text" class="am-form-field" value="{$config['PANEL_PORTAL_KEY']}">
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">Panel进入Value值</span>
            <input id="PANEL_PORTAL_VALUE" type="text" class="am-form-field" value="{$config['PANEL_PORTAL_VALUE']}">
          </div>

          <span class="warning">*由于Panel设置的特殊性，修改完成后请点击页面其他部分表示确认。</span>

          <h4>模板设置</h4>

          <div id="tce_settings_warning3" class="am-alert am-alert-warning am-animation-shake am-hide" data-am-alert>
            <button type="button" class="am-close" onclick="storger('tce_settings_warning3',0)">&times;</button>
            <p>这里的设置将影响框架的报错系统，请合理设置！</p>
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">发生错误</span>
            <input id="TPL-Error" type="text" class="am-form-field"
             value="<if condition='$config['TPL']['Error'] != false'>{$config['TPL']['Error']}</if>"
             placeholder="<if condition="$config['TPL']['Error'] == false">false (默认设置)</if>" >
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">拒绝访问</span>
            <input id="TPL-NoResponse" type="text" class="am-form-field"
             value="<if condition='$config['TPL']['NoResponse'] != false'>{$config['TPL']['NoResponse']}</if>"
             placeholder="<if condition="$config['TPL']['NoResponse'] == false">false (默认设置)</if>" >
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">无法找到应用</span>
            <input id="TPL-AppNotFound" type="text" class="am-form-field"
             value="<if condition='$config['TPL']['AppNotFound'] != false'>{$config['TPL']['AppNotFound']}</if>"
             placeholder="<if condition="$config['TPL']['AppNotFound'] == false">false (默认设置)</if>" >
          </div>

          <div class="am-input-group bottom-space">
            <span class="am-input-group-label">无法找到页面</span>
            <input id="TPL-PageNotFound" type="text" class="am-form-field"
             value="<if condition='$config['TPL']['PageNotFound'] != false'>{$config['TPL']['PageNotFound']}</if>"
             placeholder="<if condition="$config['TPL']['PageNotFound'] == false">false (默认设置)</if>" >
          </div>

          <hr />

          <span>*红色底色的设置或提示表示该设置将影响Panel的运行或框架的安全性，具体情况请查看相关文档。</span>

          <!-- ./Information -->
        </div>
      </div>

    </div>
    <!-- ./right -->
  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
