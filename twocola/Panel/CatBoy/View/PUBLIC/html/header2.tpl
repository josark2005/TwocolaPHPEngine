<!-- Api地址 -->
<script type="text/javascript">
  /**
   * 1、请勿在运营程序中使用如下Api以避免安全问题
   * 2、运营程序中请将Panel设置为false以关闭Panel模块
  **/
  // TCE设置修改Api
  url_change_tce_settings = "{:U('settings/tce_change?{__API_PORTAL_KEY__}={__API_PORTAL_VALUE__}')}";
  // OAM设置修改Api
  url_change_oam_settings = "{:U('settings/oam_change?{__API_PORTAL_KEY__}={__API_PORTAL_VALUE__}')}";
  // 创建应用
  url_generate_app = "{:U('app/generate?{__API_PORTAL_KEY__}={__API_PORTAL_VALUE__}')}";
  // 删除应用
  url_delete_app = "{:U('app/delete?{__API_PORTAL_KEY__}={__API_PORTAL_VALUE__}')}";
  // 获取应用设置
  url_get_app_name = "{:U('app/get_name?{__API_PORTAL_KEY__}={__API_PORTAL_VALUE__}')}";
</script>
</head>
<body>
