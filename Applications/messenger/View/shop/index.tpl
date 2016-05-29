<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
var url_shop = "{:U('shop/index?page=')}";
function show(id){
  var height,width,top,left;
  top = $("article#"+id).offset().top;
  left = $("article#"+id).offset().left;
  height = $("article#"+id).height();
  width = $("article#"+id).width();
  $("div#"+id).addClass("am-hide");
}
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container">
    <h2 class="title am-monospace"><i class="am-icon-flag"></i> 店铺一览</h2>
    <hr />
    <!-- shop -->
    <div class="shop-list">
      <volist name='shops' value='shop' key='key'>
        <article class="am-article" id="`$shop['shop_id']`">
          <div class="am-article-hd">
            <h2 class="am-article-title am-monospace shop-title">
              <span class="am-badge am-badge-success am-text-md">Lv.`$shop['level']`</span>
              <span class="am-badge am-badge-success am-text-md">`$shop['shop_id']`</span>
              `$shop['name']`
              <button class="am-btn am-btn-sm am-btn-default am-radius am-fr a-btn am-hide">进入</button>
              <button class="am-btn am-btn-sm am-btn-primary am-radius am-fr a-btn">下单</button>
              <button class="am-btn am-btn-sm am-btn-success am-radius am-fr a-btn">加入</button>
            </h2>
          </div>
          <div class="am-article-bd">
            <p class="am-article-lead">`$shop['description']`</p>
          </div>
        </article>
        <hr />
      </volist>
      <ul class="am-pagination am-text-right">
        <volist name="pagination" value="value" key="key">
          <if condition="$value['show']=='y'">
            <li <if condition="$value['active']=='active'">class="am-active"</if>><a href="javascript:location.href='{:U('shop/index?page={$value['page']}')}';">{$value['text']}</a></li>
          </if>
        </volist>
        <li>
          <div class="am-input-group am-input-group-sm" style="width:120px;margin-bottom:-10px">
            <input type="text" class="am-form-field" id="turn_page">
            <span class="am-input-group-btn">
              <button class="am-btn am-btn-default" type="button" onclick="jump();">跳转</button>
            </span>
          </div>
        </li>
      </ul>

      <p class="am-text-right"><small>(共{$cshop}个铺子运营)</small></p>
    </div>
    <!-- ./shop -->
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
<include file='PUBLIC-footer' type='footer' />
