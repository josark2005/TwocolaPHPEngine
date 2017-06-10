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
          <h3 class="am-panel-title">框架基本信息</h3>
        </header>

        <div class="am-panel-bd">
          <!-- Infomation -->
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>框架名称：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-success am-radius">{__FRAMENAME__}</span> <span class="am-badge am-badge-success am-radius">{__FRAMENAME_EN__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>框架版本：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-success am-radius" data-am-popover="{content: '主版本.次版本.更新月份.更新日期与批次', trigger: 'hover focus' , theme: 'md'}">{__VERSION__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>Panel版本：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-success am-radius" >{__PANEL_NAME__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>地址模式代码：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-danger am-radius">{__URL_MODE__}</span>(0为兼容模式 | 1为Pathinfo模式)</div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>默认时区：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-secondary am-radius">{__DEFAULT_TIMEZONE__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>默认数据库：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-secondary am-radius">{__DB_TYPE__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>默认应用名称：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-secondary am-radius">{__APP_DEFAULT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>程序后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>模板后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__TPL_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>JS后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__JS_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>CSS后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__CSS_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>缓存文件后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__CACHE_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>类库文件后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__CLASS_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>设置文件后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__CONFIG_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>数据库文件后缀：</strong></div>
              <div class="am-u-md-9 am-u-sm-6"><span class="am-badge am-badge-warning am-radius">{__DB_EXT__}</span></div>
          </div>
          <div class="am-g list">
              <div class="am-u-md-3 am-u-sm-6"><strong>数据库支持：</strong></div>
              <div class="am-u-md-9 am-u-sm-6">
                <volist name="db_support" value="db">
                  <span class="am-badge am-badge-success am-radius">{$db}</span>
                </volist>
                <volist name="db_support_beta" value="db_b">
                  <span class="am-badge am-badge-warning am-radius" data-am-popover="{content: '测试中的数据库支持类', trigger: 'hover focus', theme: 'sm'}">{$db_b}</span>
                </volist>
                <volist name="db_support_future" value="db_f">
                  <span class="am-badge am-radius" data-am-popover="{content: '未来可能支持但暂未支持的数据库', trigger: 'hover focus', theme: 'sm'}">{$db_f}</span>
                </volist>
              </div>
          </div>
          <div class="am-g list">
              *本页信息仅为当前版本相关设置以及信息。
          </div>

        </div>
      </div>

    </div>
    <!-- ./right -->
  </div>
</div>
<include file="PUBLIC-footer" type="footer" />
