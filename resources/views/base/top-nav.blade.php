<div class="main-menu clearfix">
  <div class="translate fl">
    <a href="#">简体中文</a>
  </div>
  <div class="user fr">
    <a href="#"><i class="iconfont icon-user"></i>{{session('uname')}}<i class="iconfont icon-triangle"></i></a>
    <div class="user-more">
      <div class="user-name"><i class="iconfont icon-user"></i><span>{{session('uname')}}</span></div>
      <ul>
        <li><a href="/personal">个人资料</a>
        <li><a href="/help">帮助中心</a>
        <li><a class="btn-logout" href="#">退出</a>
      </ul>
    </div>
  </div>
  <div class="message fr">
    <a href="/message">
      <i class="iconfont icon-message"></i>
      <span class="message-tip">12</span>
    </a>
  </div>
</div>