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
              <col width="80px"></col>
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
                  <th>工作单位</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              @if($data)
              @foreach ($data as $datum)
                <tr data-id="{{$datum['id']}}">
                  <td><input type="checkbox" /></td>
                  <td>{{$datum['id']}}</td>
                  <td><a href="#" >{{$datum['uname']}}</a></td>
                  <td>{{$datum['addr']}}</td>
                  <td>{{$datum['education']}}</td>
                  <td>{{$datum['job']}}</td>
                  <td>{{$datum['workplace']}}</td>
                  <td><a class="link-restore ajax-remove" href="/champion/recycleoption?idlist={{$datum['id']}}&optype=3" >还原</a><a class="link-remove ajax-remove" href="/champion/recycleoption?idlist={{$datum['id']}}&optype=4" >删除</a></td>
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
              <div class="left-cont fl">
                <a class="btn btn-batch btn-batch-change btn-remove disable" href="/champion/recycleoption?optype=4&idlist=" >批量删除</a>
                <a class="btn btn-batch btn-batch-change btn-restore disable" href="/champion/recycleoption?optype=3&idlist=" >批量还原</a>
              </div>
              @if($data)
              <div class="right-cont">
                <a class="btn btn-all btn-restore able" href="/champion/recycleoption?idlist=&optype=1 " >还原所有</a>
                <a class="btn btn-all btn-remove able" href="/champion/recycleoption?idlist=&optype=2" >删除所有</a>
              </div>
              @else
              <div class="right-cont">
                <a class="btn btn-all disable" href="/champion/recycleoption?idlist=&optype=1" >还原所有</a>
                <a class="btn btn-all disable" href="/champion/recycleoption?idlist=&optype=2" >删除所有</a>
              </div>
              @endif
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')