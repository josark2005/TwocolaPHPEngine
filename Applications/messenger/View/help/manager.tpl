<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container">
    <h1 class="am-text-center">错误状态码查询表（管理员）</h1>
    <hr />
    <!-- 100000 -->
    <a name="100000"></a>
    <h2>#错误码：100000</h2>
    <p class="content-r">
      <strong>错误原因：</strong>该管理员的等级（level）被降为0，系统判定为无效权限。
    </p>
    <p class="content-c">
      <strong>解决方案：</strong>如未有非法操作，请查看页面下方的“联系我们”，并与管理员取得联系。
    </p>
    <hr />
    <!-- ./100000 -->

    <!-- 100001 -->
    <a name="100001"></a>
    <h2>#错误码：100001</h2>
    <p class="content-r">
      <strong>错误原因：</strong>该管理员没有获得站点级管理员（level大于等于200）批准。
    </p>
    <p class="content-c">
      <strong>解决方案：</strong>耐心等待站点级管理员（level大于等于200）的批准。
    </p>
    <hr />
    <!-- ./100001 -->

    <!-- 100401 -->
    <a name="100401"></a>
    <h2>#错误码：100401</h2>
    <p class="content-r">
      <strong>错误原因：</strong>该管理员因<font color="red">违规执法</font>被多次举报后由块级管理员（level大于等于10且小于20）封禁。
    </p>
    <p class="content-c">
      <strong>解决方案：</strong>暂无。
    </p>
    <hr />
    <!-- ./100401 -->

    <!-- 100402 -->
    <a name="100402"></a>
    <h2>#错误码：100402</h2>
    <p class="content-r">
      <strong>错误原因：</strong>该管理员因<font color="red">违规执法</font>被块级管理员（level大于等于10且小于20）封禁。
    </p>
    <p class="content-c">
      <strong>解决方案：</strong>暂无。
    </p>
    <hr />
    <!-- ./100402 -->

    <!-- 100403 -->
    <a name="100403"></a>
    <h2>#错误码：100403</h2>
    <p class="content-r">
      <strong>错误原因：</strong>该管理员可能因<font color="red">违规执法</font>被高等级用户多次执行“删除/开除/弹劾”操作。
    </p>
    <p class="content-c">
      <strong>解决方案：</strong>暂无。
    </p>
    <hr />
    <!-- ./100403 -->

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
