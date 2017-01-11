@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-home"></i>家族中心</span>
          </div>
        </div>
        <div class="main-body">
          <div class="center-list">
            <ul class="clearfix">
              <li><a href="/card">家族名片</a></li>
              <li><a href="/profile">家族简介</a></li>
              <li><a href="/history">史料</a></li>
              <li><a href="/famous">名人榜</a></li>
              <li><a href="/champion">状元榜</a></li>
              <li><a href="/tree">家族树</a></li>
              <li><a href="/image">影像中心</a></li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
@include('base.footer')