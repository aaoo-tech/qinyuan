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
              @if($data)
              @foreach ($data as $datum)
              <tr>
                <td>{{$datum['title']}}</td>
                <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
              </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="2">空</td>
                </tr>
              @endif
            </table>
            <div class="table-foot">
              <a class="btn" href="/msg_del" >清空全部消息</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')