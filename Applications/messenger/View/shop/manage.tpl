<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
$(function(){
  textarea();
  $(window).resize(function(){
    textarea();
  });
});
function textarea(){
  $("textarea#shopintro").width($("div.am-u-sm-12").width()-18);
  $("textarea#shopintro").height("100px");
}
function accept(){
  $("#rule").hide();
  $("#table").removeClass("am-hide");
  textarea();
}
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container am-g">
    <!-- 基础信息 -->
    <div class="am-u-sm-12">

      <h1>店铺：{$shop_name} <span class="am-badge am-badge-success">ID: {$shop_id}</span></h1>
      <hr />
      <label for="shopname">店铺名称</label>
      <div class="am-input-group am-input-group-primary input-group-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-flag am-icon-fw"></i></span>
        <input id="shopname" name="shopname" type="text" class="am-form-field" placeholder="例：夏至未至" maxlength="12" value="{$shop_name}">
      </div>

      <label for="shopname">店铺简介</label>
      <div class="am-input-group am-input-group-primary input-group-margin-bottom">
        <textarea id="shopintro" name="shopintro" class="am-form-field" rows=5 placeholder="店铺简介（200字以内）" maxlength="200">{$shop_description}</textarea>
      </div>

      <label for="shopstatus">店铺状态：</label>
      <if condition="$shop_status=='open'">
        <input id="shopstatus" name="shopstatus" type="radio" value="open" checked>开启
        <input id="shopstatus" name="shopstatus" type="radio" value="close">关闭
      <else />
        <input id="shopstatus" name="shopstatus" type="radio" value="open" >开启
        <input id="shopstatus" name="shopstatus" type="radio" value="close" checked>关闭
      </if>
    </div>
    <!-- ./基础信息 -->
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
