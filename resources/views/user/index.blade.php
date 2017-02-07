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
              <form action="/user/search" method="POST">
                {{csrf_field()}}
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if(isset($keyword)){{$keyword}}@endif" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body users">
          <div class="common-table">
            <table>
              <col width="80px"></col>
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
              @if($data)
              @foreach ($data as $datum)
                <tr>
                  <td>{{$datum['uid']}}</td>
                  <td><a href="#" >{{$datum['uname']}}</a></td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link" href="https://cloud.baidu.com/beian/index.html" target="_blank">{{$datum['uinfo']}}</a></td>
                  <td><a class="link-lock" href="/user/locked?id={{$datum['uid']}}&lockflag=1" >锁定</a></td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="5">空</td>
                </tr>
              @endif
              </tbody>
            </table>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')
