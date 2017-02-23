@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="operation fr">
            <div class="form-holder form-search fr">
              <form action="/tree/search" method="POST">
                {{csrf_field()}}
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if (isset($keyword)){{$keyword}}@endif" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          var data = <?php echo json_encode($data) ?>;
          console.log('data：',data);
        </script>
        <div class="main-body">
          <div class="common-table">

            <table>
              <col width="120px"></col>
              <col width="120px"></col>
              <col></col>
              <col></col>
              <col></col>
              <thead>
                <tr>
                  <th>排序</th>
                  <th>头像</th>
                  <th>姓名</th>
                  <th>性别</th>
                  <th>代数</th>
                  <th>父/母</th>
                </tr>
              </thead>
              <tbody>
              @if($data)
              @foreach ($data as $datum)
                <tr>
                  <td>{{$datum['uid']}}</td>
                  <td><img src="{{$datum['avatar']}}"></td>
                  <td><a href="/tree?fid={{$datum['uid']}}">{{$datum['uname']}}</a></td>
                  <td>@if($datum['sex'] == 1) 男 @else 女 @endif</td>
                  <td>{{$datum['generation']}}</td>
                  <td>{{$datum['father']}}</td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="6">空</td>
                </tr>
              @endif
              </tbody>
            </table>
            @include('base.pagination')

          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
@include('base.footer')