@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-message"></i>消息</span>
          </div>
        </div>
        <div class="main-body">
          <div class="common-table message-table">
            <table>
              <col></col>
              <col width="350px"></col>
              <thead>
                <tr>
                  <th>标题</th>
                  <th>时间</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <td>用户xxx上传了24张相片<a href="#">(查看详情)</a></td>
                <td>2016-11-04 16:40:11</td>
              </tr>
              <tr>
                <td>管理员xxx上传了12篇史料</td>
                <td>2016-11-04 16:40:11</td>
              </tr>
            </table>
            <div class="table-foot">
              <a class="btn" href="#" >清空全部消息</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')