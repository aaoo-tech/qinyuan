@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
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
                  <th>姓名</th>
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
                  <td><a href="#" >{{$datum['uname']}}({{$datum['generation']}}代／父亲{{$datum['father']}})</a></td>
                  <td>{{$datum['cnt']}}</td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link-edit" href="/famous/recycleoption?idlist={{$datum['id']}}&optype=3" >还原</a><a class="link-remove" href="/famous/recycleoption?idlist={{$datum['id']}}&optype=4" >删除</a></td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
            <div class="table-foot">
              <div class="left-cont fl">
                <a class="btn" href="#" >批量删除</a>
                <a class="btn" href="#" >批量还原</a>
              </div>
              <div class="right-cont">
                <a class="btn" href="#" >还原所有</a>
                <a class="btn" href="#" >删除所有</a>
              </div>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')