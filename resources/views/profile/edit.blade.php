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
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="article-edit">
            <div class="article-cont">
              <span class="label fl">正&nbsp;&nbsp;文：</span>
              <div class="formholder cont-form">
                <form action="#" method="post">
                  {{csrf_field()}}
                  <input name="id" value="{{$data['id']}}" type="hidden" />
                  <div class="article-title">
                    <span class="label">标&nbsp;&nbsp;题：</span>
                    <input id="ipt-title" name="title" type="post" value="{{$data['title']}}" />
                  </div>
                  <textarea id="ipt-cont" name="content">
                    {{$data['content']}}
                  </textarea>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: '#ipt-cont',
        language: 'zh_CN',
        height : 500
      });

      // $('.btn-submit').on('click',function(){
      //   $('.family-article form').submit();
      //   return false
      // })
    </script>
@include('base.footer')
<script type="text/javascript">
(function($) {
    $(function() {
      $('body').on('click', '.btn-submit', function() {
        $.ajax({
            url: '/profile/update',
            data: $('.profile-edit form').serializeObject(),
            type: 'POST'
        }).done(function(response) {
            if(response.success === true){
                window.location.href = '/profile'
            }
        });
        return false;
      });
    });
})(jQuery);
</script>