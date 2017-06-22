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
          <div class="am-alert am-alert-danger">
            @ 您正在使用<span class="am-badge am-badge-secondary am-radius">Panel</span>的<span class="am-badge am-badge-secondary">应用创建</span>功能，此功能可以为您删除应用。
          </div>
        </div>
      </div>

      <div class="am-panel am-panel-danger">
        <header class="am-panel-hd">
          <h3 class="am-panel-title">删除应用</h3>
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
            <button class="am-btn am-btn-danger am-radius" onclick="deleter_app();">删除应用</button>
          </p>

        </div>

      </div>
      <!-- 应用列表 -->
      <div class="am-panel am-panel-secondary">
        <header class="am-panel-hd">
          <h3 class="am-panel-title">应用一览</h3>
        </header>
        <div class="am-panel-bd">

          <p class="warning">*您可以在【OPERATIONS】中选中应用，然后再点击上方删除应用进行删除。这是为了防止误操作，请谅解！</p>

          <div class="am-g">
            <div class="am-u-sm-4 am-text-center"><strong>APP</strong></div>
            <div class="am-u-sm-4 am-text-center"><strong>APP_NAME</strong></div>
            <div class="am-u-sm-4 am-text-center"><strong>OPERATIONS</strong></div>
          </div>

          <empty name="app_list">
            <div class="am-g">
              <div class="am-u-sm-12">
                <div class="am-alert am-text-center">
                  您的应用目录中一个应用也没有
                </div>
              </div>
            </div>
          </empty>

          <volist name="app_list" value="APP">
            <script type="text/javascript">$(function(){appName('{$APP}');});</script>
            <div class="am-g list">
              <div class="am-u-sm-4 am-text-center">{$APP}</div>
              <div class="am-u-sm-4 am-text-center" id="NAME_{$APP}"><i class="am-icon-spinner am-icon-spin"></i></div>
              <div class="am-u-sm-4 am-text-center"><button class="am-btn am-btn-xs am-radius am-btn-warning" onclick="javascript:selected('{$APP}');">选择</button></div>
            </div>
          </volist>


        </div>

      </div>
      <!-- ./应用列表 -->
    </div>

  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
