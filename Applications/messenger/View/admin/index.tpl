<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container am-g">
    <!-- Notice -->
    <div class="am-u-sm-12">
      <div class="am-alert alert-radius am-alert-secondary am-animation-slide-top am-text-center am-show-md-up" data-am-alert>
        站点仍在测试阶段，如发现bug，请联系我们，谢谢。
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
      <!-- 申请管理 -->
      <h2><i class="am-icon-check-square-o"></i> 申请管理</h2>
      <hr />
      <button class="am-btn am-btn-primary am-radius" id='shop_check' onclick="location.href='{:U('admin/shop_check')}'">店铺申请审批 lv.10+</button>
      <!-- ./申请管理 -->
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
<include file='PUBLIC-footer' type='footer' />
