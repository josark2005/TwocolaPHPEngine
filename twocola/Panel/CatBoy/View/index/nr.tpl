<include file="PUBLIC-header" type="autoheader" />
<include file="PUBLIC-header2" type="header" />
<include file="PUBLIC-nav" type="nav" />
<div class="am-container">
  <article class="am-article">
    <div class="am-article-hd">
      <h1 class="am-article-title">{__APP_NAME__} 拒绝访问</h1>
      <p class="am-article-meta">Jokin（南国七旬）</p>
    </div>

    <div class="am-article-bd">
      <blockquote>抱歉，{__APP_NAME__}拒绝了您的访问。</blockquote>
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当您看到本页时，说明您的{__APP_NAME__}访问请求被拒绝了，若您是管理员并且需要访问{__APP_NAME__}请将{__APP_NAME__}目录下设置文件中的“APP_RESPONSE”设置项修改为True。
      </p>
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在此模式下，您对于{__APP_NAME__}的所有请求将被拒绝。除了修改相关设置项以外别无他法。
      </p>
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;此页面为自定义拒绝访问（NoResponse）页面，使用了Path模式进行定义，Path定义地址：<span class="am-badge">index/nr?{__PANEL_PORTAL_KEY__}={__PANEL_PORTAL_VALUE__}</span>
      </p>
    </div>
  </article>
</div>
<!-- 404页面标记 -->
<include file="PUBLIC-404" type="footer" />
<include file="PUBLIC-footer" type="footer" />
