<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container am-g">

    <div class="am-u-sm-12">
      <div class="am-alert alert-radius am-alert-secondary am-animation-slide-top am-text-center am-show-md-up" data-am-alert>
        站点仍在测试阶段，如发现bug，请联系我们，谢谢。
      </div>
    </div>
    <!-- side-left -->
    <div class="am-u-sm-12 am-u-md-3 side-left">
      <div class="part-left-head">
        <img src="{$head_img}" height="100px" width="100px" class="am-center am-circle" border="1">
        <p class="am-text-center">
          <span class="am-badge am-badge-success">{$level}</span><br />
          {!COOKIE:username}(UID:{!COOKIE:uid})<br />
        </p>
      </div>
      <!-- left-service -->
      <div class="part-left-service">
        <!-- panel-group -->
        <div class="am-panel-group" id="accordion">
          <!-- ServicePanel -->
          <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
              <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#part-left-service'}">
                <span class="am-icon-list-ul"></span> 服务
              </h4>
            </div>
            <div id="part-left-service" class="am-panel-collapse am-collapse am-in">
              <div class="am-panel-bd panel">
                <ul class="am-list">
                  <li>
                    <a class="am-btn am-btn-md am-btn-secondary" href="#">
                      <i class="am-icon-twitch"></i>
                      传话下单
                    </a>
                  </li>
                  <empty name="shop">
                    <li>
                      <a class="am-btn am-btn-md am-btn-secondary" href="{:U('shop/open')}">
                        <i class="am-icon-flag"></i>
                        开通店铺（限量）
                      </a>
                    </li>
                  <else />
                    <li>
                      <a class="am-btn am-btn-md am-btn-secondary" href="{:U('shop/manage')}">
                        <i class="am-icon-flag"></i>
                        管理店铺
                      </a>
                    </li>
                  </empty>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./ServicePanel -->
          <!-- UserPanel -->
          <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
              <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#part-left-user'}">
                <span class="am-icon-user"></span> 个人资料
              </h4>
            </div>
            <div id="part-left-user" class="am-panel-collapse am-collapse">
              <div class="am-panel-bd panel">
                <ul class="am-list">
                  <li>
                    <a class="am-btn am-btn-md am-btn-secondary" href="javascript:;" data-am-modal="{target: '#modal-headimg'}">
                      <i class="am-icon-smile-o"></i>
                      修改头像
                    </a>
                  </li>
                  <li>
                    <a class="am-btn am-btn-md am-btn-secondary" href="javascript:_alert('现在好像也没什么资料可以改吧')">
                      <i class="am-icon-file-o"></i>
                      修改资料
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./UserPanel -->
        </div>
        <!-- ./panel-group -->
      </div>
      <!-- ./left-service -->
    </div>
    <!-- ./side-left -->
    <!-- side-right -->
    <div class="am-u-sm-12 am-u-md-9 side-right">
      <!-- <div class="am-alert am-alert-success">此区块测试中哦~</div> -->
      <h2>个人</h2>
      <hr />
      <ul class="am-avg-sm-3 am-avg-md-5">
        <li>
          <button class="btn-service am-btn am-btn-primary am-text-lg" <empty name="admin">disabled<else />onclick="javascript:location.href='{:U('user/friends')}'"</empty>><i class="am-icon-lg am-icon-users am-center"></i> 好友</button>
        </li>
        <li>
          <if condition="$message=='0'">
            <button class="btn-service am-btn am-btn-primary am-text-lg" onclick="javascript:location.href='{:U('user/message')}'"><i class="am-icon-lg am-icon-envelope-o am-center"></i> 短信</button>
          <else />
            <button class="btn-service am-btn am-btn-danger am-text-lg" onclick="javascript:location.href='{:U('user/message?type=3&status=100101')}'"><i class="am-icon-lg am-icon-envelope-o am-center"></i> 短信</button>
          </if>
          <!-- <button class="btn-service am-btn am-btn-primary am-text-lg" <empty name="admin">disabled<else />onclick="javascript:location.href='{:U('user/message')}'"</empty>><i class="am-icon-lg am-icon-envelope-o am-center"></i> 短信</button> -->
        </li>
        <li><button class="btn-service am-btn am-btn-primary am-text-lg" disabled><i class="am-icon-lg am-icon-shopping-cart am-center"></i> 商城</button></li>
      </ul>

      <h2>其他</h2>
      <hr />
      <ul class="am-avg-sm-3 am-avg-md-5">
        <li>
          <button class="btn-service am-btn am-btn-primary am-text-lg"<empty name="admin">disabled<else />onclick="javascript:location.href='{:U("admin/index")}'"</empty>><i class="am-icon-lg am-icon-cog am-center"></i> 管理</button>
        </li>
        <li>
          <button class="btn-service am-btn am-btn-primary am-text-lg" onclick="javascript:location.href='{:U('help/index')}'"><i class="am-icon-lg am-icon-question am-center"></i> 帮助</button>
        </li>
      </ul>

    </div>
    <!-- ./side-right -->
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
<!-- Modal-headimg -->
<div class="am-modal am-modal-alert" tabindex="-1" id="modal-headimg">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改头像</div>
    <div class="am-modal-bd">
      <div class="am-alert am-alert-warning" style="margin:0px;">对不起，此功能暂无法使用。（为了减少服务器费用）</div>
    </div>
  </div>
</div>
<!-- ./Modal-headimg -->
<include file='PUBLIC-footer' type='footer' />
