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
        <div class="main-body">
          <div class="family-tree">
            <div class="container">
              <table>
                <col width="50px"></col>
                <col></col>
                <col></col>
                <col></col>
                <col></col>
                <col></col>
                <col></col>
                <col width="175px"></col>
                <thead>
                  <tr>
                    <th></th>
                    <th>排序</th>
                    <th>姓名</th>
                    <th>第几代</th>
                    <th>父/母</th>
                  </tr>
                </thead>
                <tbody>
                @if($data)
                @foreach ($data as $datum)
                  <tr>
                    <td><img src="{{$datum['avatar']}}"></td>
                    <td>{{$datum['uid']}}</td>
                    <td><a href="/tree?fid={{$datum['uid']}}">{{$datum['uname']}}</a></td>
                    <td>{{$datum['generation']}}</td>
                    <td>{{$datum['father']}}</td>
                  </tr>
                @endforeach
                @else
                  <tr>
                    <td colspan="5">空</td>
                  </tr>
                @endif
                </tbody>
              </table>
              @include('base.pagination')
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
@include('base.footer')