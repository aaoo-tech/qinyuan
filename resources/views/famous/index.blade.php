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
              <a class="btn-recycling" href="/famous/recycle"><i class="iconfont icon-recycling"></i>回收站</a>
            </div>
            <div class="btn-set fr">
              <a class="btn-add btn-pop" href="/famous/add">添加</a>
            </div>
            <div class="form-holder form-search fr">
              <form action="/famous/search" method="POST">
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
                  <td><a class="" href="/famous/edit?id={{$datum['id']}}" >{{$datum['uname']}}({{$datum['generation']}}代／父亲{{$datum['father']}})</a></td>
                  <td>{{$datum['cnt']}}</td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link-edit" href="/famous/edit?id={{$datum['id']}}" >编辑</a><a class="link-remove ajax-remove" href="/famous/del?id={{$datum['id']}}" >删除</a></td>
                </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="6">空</td>
                </tr>
              @endif
              </tbody>
            </table>
            <div class="table-foot">
              <a class="btn btn-batch" href="/famous/batchdel?" >批量删除</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont famous-edit">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>添加名人</h2></div>
          <div class="form-holder add-form">
            <form action="/info/108/">
              {{csrf_field()}}
              <div class="entry">
                <span class="label">姓&nbsp;&nbsp;名</span>
                <input type="text" name="uname" placeholder="姓名"/>
              </div>
              <div class="entry">
                <span class="label">代&nbsp;&nbsp;数</span>
                <input type="text" name="generation" placeholder="代数"/>
              </div>
              <div class="entry">
                <span class="label">父亲姓名</span>
                <input type="text" name="father" placeholder="父亲姓名"/>
              </div>
              <div class="box-footer clearfix">
                <div class="btn-set fr">
                  <a class="btn btn-submit" href="#">确定</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
        $(function() {
          $('.table-foot .btn-batch').on('click', function() {
            var $tr = $('table tr');
            var n = $tr.find('td').length;
            var $tbody = $('table tbody');
            var idList = [];
            $('table tr input[type="checkbox"]').each(function(i,elem){
              if(elem.checked){
                idList.push($(this).closest('tr').data('id'));
              }
            });
            var url = $(this).attr('href');
            idList.forEach(function(id){
              url += 'ids[]='+id + '&'
            });
            $.ajax({
              url: url, 
              beforeSend: function() { 
                $('#loading').addClass('active');
              }
            }).done(function(response) {
              $('#loading').removeClass('active');
              if (response.success == true) {
                window.location.reload();
              } else {

              }
            });
            return false;
          });
        });
      })(jQuery);
    </script>
@include('base.footer')