<include file="PUBLIC-header" type="autoheader" />
<include file="PUBLIC-header2" type="header" />
<include file="PUBLIC-nav" type="nav" />
<div class="am-container">
  <article class="am-article">
    <div class="am-article-hd">
      <h1 class="am-article-title">{__APP_NAME__} 无法找到页面</h1>
      <p class="am-article-meta">Jokin（南国七旬）</p>
    </div>

    <div class="am-article-bd">
      <blockquote>抱歉我们无法找到您需要的页面！</blockquote>
      <p class="am-text-center">
        此页面为自定义404（PageNotFound）页面，使用了Path模式进行定义，Path定义地址：<span class="am-badge">index/pnf?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}</span>
      </p>
    </div>
  </article>
</div>
<!-- 404页面标记 -->
<include file="PUBLIC-404" type="footer" />
<include file="PUBLIC-footer" type="footer" />
