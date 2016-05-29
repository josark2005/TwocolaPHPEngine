<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
  var url_check = "{:U('admin/shop_check?app_type=api')}";
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container am-g">
    <!-- Notice -->
    <div class="am-u-sm-12">
      <div class="am-alert alert-radius am-alert-warning am-animation-slide-top am-text-center am-show-md-up" data-am-alert>
        请严格审查
      </div>
    </div>
    <!-- ./Notice -->
    <!-- left -->
    <div class="am-u-sm-12 am-u-md-3 side-left">
      <div class="part-left-head">
        <img src="{$head_img}" height="100px" width="100px" class="am-center am-circle" border="1">
        <p class="am-text-center">
          <span class="am-badge am-badge-success">{$level}</span><br />
          {!COOKIE:username}(UID:{!COOKIE:uid})<br />
        </p>
      </div>
    </div>
    <!-- ./left -->

    <!-- right -->
    <div class="am-u-sm-12 am-u-md-9 side-right">
      <empty name="v_status">
        <div class="am-alert am-alert-success">暂无需要审批的店铺,点此 <strong onclick="location.href='{:U('admin/index')}'">返回 。</strong></div>
      </empty>
      <volist name='shops' value='shop' key='key'>
        <article class="am-article" id="`$shop['shop_id']`">
          <div class="am-article-hd">
            <h2 class="am-article-title am-monospace shop-title">
              <span class="am-badge am-badge-warning am-text-md">ID:`$shop['shop_id']`</span>
              `$shop['name']`
              <button class="am-btn am-btn-sm am-btn-danger am-radius am-fr a-btn" onclick="javascript:refuse_reason(`$shop['shop_id']`);">拒绝</button>
              <button class="am-btn am-btn-sm am-btn-success am-radius am-fr a-btn" onclick="javascript:ratify(`$shop['shop_id']`);">批准</button>
            </h2>
          </div>
          <div class="am-article-bd">
            <p class="am-article-lead">`$shop['description']`</p>
          </div>
        </article>
        <hr />
      </volist>
    </div>
    <!-- ./right -->
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
<!-- Prompt -->
<div class="am-modal am-modal-prompt" tabindex="-1" id="refuse_shop">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">拒绝店铺</div>
    <div class="am-modal-bd">
      请填写拒绝原因
      <input id="refuse_reason" type="text" class="am-modal-prompt-input" value="非法的店铺名称/简介。">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span id="shop_id" class="am-modal-btn" onclick="javascript:refuse(this.id);" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>
<!-- ./Prompt -->
<include file='PUBLIC-footer' type='footer' />
