@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-users"></i>用户</span>
          </div>
          <div class="operation fr">
            <div class="btn-set fl">
              <a class="btn-lock" href="/user/lock"><i class="iconfont icon-lock"></i>已锁定用户</a>
            </div>
            <div class="form-holder form-search fr">
              <form action="#" method="POST">
                {{csrf_field()}}
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if (isset($keyword)) {{$keyword}} @endif" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body users">
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
                  <td><a class="link" href="https://cloud.baidu.com/beian/index.html" target="_blank">https://cloud.baidu.com/beian/index.html</a></td>
                  <td><a class="link-lock" href="#" >锁定</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')
