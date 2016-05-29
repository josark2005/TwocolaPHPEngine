<include file='PUBLIC-header' type='autoheader' />
<script language="javascript">
var url_message = "{:U('user/getmessage?app_type=api')}";
</script>
<include file='PUBLIC-nav' type='nav' />
<div class="container">
  <!-- Curtain -->
  <div class="am-container am-g">
    <h2 class="am-serif" style="font-size:24px;"><i class="am-icon-envelope"></i> 消息中心-alpha</h2>
    <p style="margin:0px;padding:0px;color:#808080">功能Alpha阶段，暂无手机版。</p>
    <hr />
    <!-- 信息分类 -->
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-2">
        <!-- 所有消息 -->
        <if condition="$_GET['type']=='3'&&$_GET['status']=='all'">
            <button class="am-btn am-btn-primary am-btn-block">&raquo; 所有消息</button>
          <else />
            <button class="am-btn am-btn-block" onclick="location.href='{:U('user/message?type=3&status=all')}'">所有消息</button>
        </if>
        <!-- ./所有消息 -->
        <!-- 未读消息 -->
        <if condition="$message_count_unread=='0'">
          <button class="am-btn am-btn-block" onclick="_alert('暂无未读消息')">未读消息</button>
        <else condition="$_GET['type']=='3'&&$_GET['status']=='100101'" />
          <button class="am-btn am-btn-primary am-btn-block">&raquo; 未读消息</button>
        <else />
          <button class="am-btn am-btn-block" onclick="location.href='{:U('user/message?type=3&status=100101')}'">未读消息 <span class="am-badge am-badge-success">`$message_count_unread`</span></button>
        </if>
        <!-- ./未读消息 -->
        <!-- 邀请消息 -->
        <if condition="$_GET['type']=='2'&&$_GET['status']=='all'">
          <button class="am-btn am-btn-primary am-btn-block">&raquo; 邀请消息</button>
        <else condition="$message_invite_count=='0'" />
          <button class="am-btn am-btn-block" onclick="_alert('暂无邀请消息')">邀请消息</button>
        <else />
          <button class="am-btn am-btn-block" onclick="location.href='{:U('user/message?type=2')}'">邀请消息 <span class="am-badge am-badge-success">`$message_count_unread`</span></button>
        </if>
        <!-- ./邀请消息 -->
      </div>
      <div class="am-u-sm-12 am-u-md-10 side-right">
        <div class="am-g">
          <if condition="$message_count=='0'">
            <div class="am-alert am-alert-success">暂时没有信息哟~</div>
          <else />
            <div class="am-u-sm-4 am-u-md-3 am-text-truncate message-header" style="font-weight:bold;font-size:18px;background-color:rgb(0, 143, 198);">标题</div>
            <div class="am-u-sm-6 am-u-md-7 am-text-truncate message-header" style="font-weight:bold;font-size:18px;background-color:rgb(0, 143, 198);">导读</div>
            <div class="am-u-sm-2 am-u-md-2 am-text-truncate message-header" style="font-weight:bold;font-size:18px;background-color:rgb(0, 143, 198);">来源</div>
            <volist name="messages" value="message" key="key">
              <div class="am-u-sm-12 message">
                <if condition="$message['status']=='100101'">
                  <div class="am-u-sm-4 am-u-md-3 am-text-truncate" style="font-size:16px;line-height:20px;" onclick="message('{$message['mid']}')"><a class="message message-unread" href="javascript:;" id="{$message['mid']}"><span class="am-badge am-badge-danger" id="{$message['mid']}">NEW</span>{$message['title']}</a></div>
                <else />
                  <div class="am-u-sm-4 am-u-md-3 am-text-truncate" style="font-size:16px;line-height:20px;" onclick="message('{$message['mid']}')"><a class="message" href="javascript:;">{$message['title']}</a></div>
                </if>
                <div class="am-u-sm-6 am-u-md-7 am-text-truncate" style="color:#7c7c7c;font-size:14px;line-height:20px;">[{$message['post_time']}] {$message['leader']}</div>
                <div class="am-u-sm-2 am-u-md-2 am-text-truncate" style="font-size:16px;line-height:20px;"><if condition="$message['from_uid']==0">系统</if></div>
              </div>
            </volist>
            <hr />
            <!-- 分页 -->
            <div class="am-u-sm-12">
              <ul class="am-pagination am-text-right">
                <volist name="pagination" value="value" key="key">
                  <if condition="$value['show']=='y'">
                    <li <if condition="$value['active']=='active'">class="am-active"</if>><a href="javascript:location.href='{:U('user/message?type={$_GET['type']}&status={$_GET['status']}&page={$value['page']}')}';">{$value['text']}</a></li>
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
            </div>
            <!-- ./分页 -->
          </if>
        </div>
      </div>
    </div>
    <!-- ./信息分类 -->
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
<!-- Message -->
<div class="am-popup" style="height:auto;" id="alert-message">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title" id="m-title"></h4>
      <span class="am-close" data-am-modal-close>&times;</span>
    </div>
    <div class="am-popup-bd" id="m-article"></div>
  </div>
</div>
<!-- ./Message -->
<include file='PUBLIC-footer' type='footer' />
