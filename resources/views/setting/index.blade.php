@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-set"></i>设置</span>
          </div>
        </div>
        <div class="main-body">
          
          <div class="admin-set show">
            <div class="form-holder add-form clearfix">
              <div class="form-title">
                <h3>添加管理员</h3>
              </div>
              <form action="/setting/add" method="post">
                {{csrf_field()}}
                <div class="entry fl">
                  <label>手机号</label>
                  <input type="text" maxlength="11" name="mobile" placeholder="输入待添加管理员手机号" />
                </div>
                <div class="entry fl">
                  <label>用户名</label>
                  <input type="text" maxlength="8" name="uname" placeholder="输入姓名" />
                </div>
                <div class="btn-set fl">
                  <a class="btn-add btn-submit btn" href="#">添加</a>
                </div>
              </form>
            </div>

            <div class="admin-list">
              <div class="list-title">
                <h3>管理员(<span>{{count($data)}}<span>)</h3>
              </div>
              <ul>
              @if($data)
              @foreach ($data as $k => $datum)
                  @if($datum['uid'] == session('uid'))
                    <li>
                      <span class="admin-id">{{ $k+1 }}</span>
                      <span class="admin-name">{{$datum['uname']}}</span>
                      <span>账号：</span>
                      <span class="admin-account">{{$datum['mobile']}}</span>
                    </li>
                  @else
                    <li>
                      <span class="admin-id">{{ $k+1 }}</span>
                      <span class="admin-name">{{$datum['uname']}}</span>
                      <span>账号：</span>
                      <span class="admin-account">{{$datum['mobile']}}</span>
                      <a class="link-remove ajax-remove" href="/setting/del?uid={{$datum['uid']}}">删除</a>
                    </li>
                  @endif
                @endforeach
              @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')