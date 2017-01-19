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
                  <th>文章标题</th>
                  <th>访问量</th>
                  <th>更新时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              @if($data)
              @foreach ($data as $datum)
                <tr data-id="{{$datum['id']}}">
                  <td><input type="checkbox" /></td>
                  <td>{{$datum['id']}}</td>
                  <td><a href="/history/recycle?id={{$datum['id']}}" >{{$datum['title']}}</a></td>
                  <td>{{$datum['cnt']}}</td>
                  <td><?php echo date('Y-m-d H:i:s', $datum['create_time']); ?></td>
                  <td><a class="link-restore ajax-remove" href="/history/recycleoption?idlist={{$datum['id']}}&optype=3" >还原</a><a class="link-remove ajax-remove" href="/history/recycleoption?idlist={{$datum['id']}}&optype=4" >删除</a></td>
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
              <div class="left-cont fl">
                <a class="btn btn-batch" href="/history/recycleoption?optype=4&idlist=" >批量删除</a>
                <a class="btn btn-batch" href="/history/recycleoption?optype=3&idlist=" >批量还原</a>
              </div>
              <div class="right-cont">
                <a class="btn btn-all" href="/history/recycleoption?optype=1&idlist=" >还原所有</a>
                <a class="btn btn-all" href="/history/recycleoption?optype=2&idlist=" >删除所有</a>
              </div>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
          $(function() {

            $('.table-foot .btn-batch').on('click', function() {
              var url = $(this).attr('href');
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
              })
              return false
            })


            $('.table-foot .btn-batch').on('click', function() {
              var $tr = $('table tr');
              var n = $tr.find('td').length;
              var $tbody = $('table tbody');
              var idList = [];
              var trList = [];
              $('table tr input[type="checkbox"]').each(function(i,elem){
                if(elem.checked){
                  idList.push($(this).closest('tr').data('id'));
                  trList.push($(this).closest('tr')[0]);
                }
              });
              var url = $(this).attr('href')+idList.toString();
              $.ajax({
                url: url, 
                beforeSend: function() { 
                  $('#loading').addClass('active');
                }
              }).done(function(response) {
                $('#loading').removeClass('active');
                if (response.success == true) {
                  // trList.forEach(function(elem){
                  //   $(elem).remove();
                  // });
                  // if(!$tbody.find('tr').length){
                  //   $tbody.html('<td colspan="'+ n +'">空</td>')
                  // }
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
