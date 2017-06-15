
    <!-- left -->
    <div class="am-u-md-3 am-u-sm-12 nav-left">
      <div class="am-panel-group" id="accordion">
        <!-- tce-settings -->
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd">
            <h4 class="am-panel-title">
              <i class="am-icon-cogs"></i> 框架引擎设置
            </h4>
          </div>
          <div id="tce-settings" class="am-panel-collapse">
            <div class="am-panel-bd">
              <button id="index-tce_information" type="button" class="am-btn am-btn-secondary am-round am-btn-block" onclick="location.href='{:U('index/tce_information')}'">基本状态信息</button>
              <button id="index-tce_settings" type="button" class="am-btn am-btn-primary am-round am-btn-block" onclick="location.href='{:U('index/tce_settings')}'">全局设置调整</button>
              <button id="index-oam_settings" type="button" class="am-btn am-btn-primary am-round am-btn-block" onclick="location.href='{:U('index/oam_settings')}'">OAM设置调整</button>
            </div>
          </div>
        </div>
        <!-- app-settings -->
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd">
            <h4 class="am-panel-title">
              <i class="am-icon-cogs"></i> 应用管理
            </h4>
          </div>
          <div id="app-settings" class="am-panel-collapse">
            <div class="am-panel-bd">
              <button id="index-app_generate" type="button" class="am-btn am-btn-primary am-round am-btn-block" onclick="location.href='{:U('index/app_generate')}'">创建应用</button>
              <button id="index-app_settings" type="button" class="am-btn am-btn-primary am-round am-btn-block" onclick="location.href='{:U('index/app_settings')}'">应用设置</button>
              <button id="index-app_delete" type="button" class="am-btn am-btn-warning am-round am-btn-block" onclick="location.href='{:U('index/app_delete')}'">删除应用</button>
            </div>
          </div>
        </div>

      </div>
    </div>
