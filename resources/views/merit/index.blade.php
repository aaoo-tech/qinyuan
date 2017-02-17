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
            <div class="toggle fl">
              <a class="btn-best" href="/champion">状元榜</a>
              <a class="btn-kind active" href="#">功德榜</a>
            </div>
            <div class="btn-set fl">
              <a class="btn-recycling" href="/merit/recycle"><i class="iconfont icon-recycling"></i>回收站</a>
            </div>
            <div class="btn-set fr">
              <a class="btn-add" href="/merit/add">添加</a>
            </div>
            <div class="form-holder form-search fr">
              <form action="/merit/search" method="POST">
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
                <tr data-id="{{$datum['id']}}">
                  <td><input type="checkbox" /></td>
                  <td>{{$datum['id']}}</td>
                  <td><a href="/merit/edit?id={{$datum['id']}}" >{{$datum['uname']}}</a></td>
                  <td>{{$datum['addr']}}</td>
                  <td>{{$datum['education']}}</td>
                  <td>{{$datum['job']}}</td>
                  <td>{{$datum['money']}}</td>
                  <td><a class="link-edit" href="/merit/edit?id={{$datum['id']}}" >编辑</a><a class="link-remove ajax-remove" href="/merit/del?id={{$datum['id']}}" >删除</a></td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="8">空</td>
                </tr>
              @endif
              </tbody>
            </table>
            <div class="table-foot">
              <a class="btn btn-batch btn-to-recycle disable" href="/merit/batchdel?" >批量删除</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')