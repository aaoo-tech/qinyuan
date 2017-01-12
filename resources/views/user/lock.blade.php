@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-users"></i>用户</span>
          </div>
        </div>
        <div class="main-body">
          <div class="common-table">
            <table>
              <col width="50px"></col>
              <col></col>
              <col></col>
              <col></col>
              <col></col>
              <col width="175px"></col>
              <thead>
                <tr>
                  <th>排序</th>
                  <th>姓名</th>
                  <th>注册时间</th>
                  <th>个人资料</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><a href="#" >张雨</a></td>
                  <td>2016-11-04 16:40:11</td>
                  <td>https://cloud.baidu.com/beian/index.html</td>
                  <td><a href="#" >1</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')