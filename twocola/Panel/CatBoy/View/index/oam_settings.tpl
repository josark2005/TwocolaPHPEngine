<include file="PUBLIC-header" type="autoheader" />
<script language="javascript">
  var url_this = "{:U('index/oam_settings')}";
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
          <h3 class="am-panel-title">OAM设置修改</h3>
        </header>

        <div class="am-panel-bd">
          <!-- Infomation -->
          <h4>域名绑定应用</h4>

          <span class="warning">*修改后请单击一次页面其他位置以表您确认修改。</span>

          <div class="am-g">
            <volist name="OAM['BDA']" key="domain" value="app">
              <div id="OAM_BDA_C_{$app}" class="selector">

                <div class="am-u-sm-5 am-input-group bottom-space no-padding-right">
                  <input id="OAM_BDA_domain_{$app}" type="text" class="am-form-field" value="{$domain}" disabled>
                </div>

                <div class="am-u-sm-7 am-input-group bottom-space no-padding-left">
                  <span class="am-input-group-label">=></span>
                  <input id="OAM_BDA_app_{$app}" type="text" class="am-form-field" value="{$app}" onchange="javascript:change_bda('{$domain}','{$app}');">
                  <span class="am-input-group-btn">
                    <button id="bdabtn_{$app}" class="am-btn am-btn-default" type="button" onclick="javascript:del_bda('{$domain}','{$app}');">
                      <i class="am-icon-sm am-icon-trash am-icon-fw"></i>
                    </button>
                  </span>
                </div>

              </div>
            </volist>

            <hr />

            <!-- New -->
            <div class="am-u-sm-5 am-input-group bottom-space no-padding-right">
              <span class="am-input-group-label">新增</span>
              <input type="text" id="newbda_domain" class="am-form-field">
            </div>

            <div class="am-u-sm-7 am-input-group bottom-space no-padding-left">
              <span class="am-input-group-label">=></span>
              <input type="text" id="newbda_app" class="am-form-field check">
              <span class="am-input-group-btn">
                <button class="am-btn am-btn-default check" type="button" onclick="javascript:new_bda();">
                  <i class="am-icon-sm am-icon-check am-icon-fw"></i>
                </button>
              </span>
            </div>

          </div>

          <empty name="OAM['BDA']">
            <div class="am-alert">
              还没有绑定任何应用呢~
            </div>
          </empty>

          <hr />

          <h4>域名绑定Api</h4>

          <span class="warning">*修改后请单击一次页面其他位置以表您确认修改。</span>

          <div class="am-g">
            <volist name="OAM['BDAPI']" key="domain" value="app">
              <div id="OAM_BDAPI_C_{$app}" class="selector">

                <div class="am-u-sm-5 am-input-group bottom-space no-padding-right">
                  <input id="OAM_BDAPI_{$app}" type="text" class="am-form-field" value="{$domain}" disabled>
                </div>

                <div class="am-u-sm-7 am-input-group bottom-space no-padding-left">
                  <span class="am-input-group-label">=></span>
                  <input id="OAM_BDAPI_api_{$app}" type="text" class="am-form-field" value="{$app}" onchange="javascript:change_bdapi('{$domain}','{$app}');">
                  <span class="am-input-group-btn">
                    <button id="bdapibtn_{$app}" class="am-btn am-btn-default" type="button" onclick="javascript:del_bdapi('{$domain}','{$app}');">
                      <i class="am-icon-sm am-icon-trash am-icon-fw"></i>
                    </button>
                  </span>
                </div>

              </div>
            </volist>

            <div id="bdapi_new"></div>

            <!-- New -->
            <div class="am-u-sm-5 am-input-group bottom-space no-padding-right">
              <span class="am-input-group-label">新增</span>
              <input type="text" id="newbdapi_domain" class="am-form-field">
            </div>

            <div class="am-u-sm-7 am-input-group bottom-space no-padding-left">
              <span class="am-input-group-label">=></span>
              <input type="text" id="newbdapi_api" class="am-form-field check">
              <span class="am-input-group-btn">
                <button class="am-btn am-btn-default check" type="button" onclick="javascript:new_bdapi();">
                  <i class="am-icon-sm am-icon-check am-icon-fw"></i>
                </button>
              </span>
            </div>

          </div>

          <empty name="OAM['BDAPI']">
            <div class="am-alert">
              还没有绑定任何Api呢~
            </div>
          </empty>

          <hr />

          <span>理论上我们允许您绑定无限制数量的应用或Api，但是随着绑定数量的增加，框架的性能将收到微弱的影响，请尽可能的压缩绑定的数量以保证最快的体验。</span>

          <!-- ./Information -->
        </div>
      </div>

    </div>
    <!-- ./right -->
  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
