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
            <div class="btn-set fr">
              <a class="btn-back" href="/user/">返回用户列表</a>
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
              @if($data)
              @foreach ($data as $datum)
                <tr>
                  <td>{{$datum['uid']}}</td>
                  <td><a href="#" >{{$datum['uname']}}</a></td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link" href="https://cloud.baidu.com/beian/index.html" target="_blank">{{$datum['uinfo']}}</a></td>
                  <td><a href="/user/locked?id={{$datum['uid']}}&lockflag=0" class="link-unlock">解锁</a></td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')