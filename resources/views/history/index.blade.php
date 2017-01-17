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
            <div class="btn-set fl">
              <a class="btn-recycling" href="/history/recycle"><i class="iconfont icon-recycling"></i>回收站</a>
            </div>
            <div class="btn-set fr">
              <a class="btn-add btn-pop" href="#">添加</a>
            </div>
            <div class="form-holder form-search fr">
              {{csrf_field()}}
              <form action="#" method="POST">
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if (isset($keyword)) {{$keyword}} @endif" placeholder="输入文章标题"/>
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
              <col width="175px"></col>
              <thead>
                <tr>
                  <th></th>
                  <th>排序</th>
                  <th>文章标题</th>
                  <th>访问量</th>
                  <th>更新时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              @if($data)
              @foreach ($data as $datum)
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>{{$datum['id']}}</td>
                  <td><a href="/history/edit?id={{$datum['id']}}" >{{$datum['title']}}</a></td>
                  <td>123</td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link-edit" href="/history/edit?id={{$datum['id']}}" >编辑</a><a class="link-remove" href="/history/del?id={{$datum['id']}}" >删除</a></td>
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