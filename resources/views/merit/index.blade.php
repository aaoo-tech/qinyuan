@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="other fr">
            <div class="toggle fl">
              <a class="btn-best" href="/champion">状元榜</a>
              <a class="btn-kind active" href="#">功德榜</a>
            </div>
            <div class="btn-set fl">
              <a class="btn-recycling" href="/champion/recycle"><i class="iconfont icon-recycling"></i>回收站</a>
            </div>
            <div class="form-holder add-famous fr">
              <form action="#" method="POST">
                <div class="search-input fl">
                  <i class="iconfont icon-search"></i><input type="text" name="keyword" value="@if (isset($keyword)) {{$keyword}} @endif" placeholder="输入姓名"/>
                </div>
                <div class="btn-set fr">
                  <a class="btn-submit" href="#">添加</a>
                </div>
              </form>
            </div>
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
              <col></col>
              <col></col>
              <col width="175px"></col>
              <thead>
                <tr>
                  <th></th>
                  <th>排序</th>
                  <th>姓名</th>
                  <th>籍贯</th>
                  <th>学历</th>
                  <th>职务</th>
                  <th>捐款金额（元）</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              @if($data)
              @foreach ($data as $datum)
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>{{$datum['id']}}</td>
                  <td><a href="/merit/edit?id={{$datum['addr']}}" >{{$datum['uname']}}</a></td>
                  <td>{{$datum['addr']}}</td>
                  <td>{{$datum['education']}}</td>
                  <td>{{$datum['job']}}</td>
                  <td>{{$datum['money']}}</td>
                  <td><a class="link-edit" href="/merit/edit?id={{$datum['addr']}}" >编辑</a><a class="link-remove" href="/merit/del?id={{$datum['id']}}" >删除</a></td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
            <div class="table-foot">
              <a class="btn" href="#" >批量删除</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')