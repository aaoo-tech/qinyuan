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
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="article-edit">
            <div class="formholder cont-form">
              <form action="#" method="post">
                {{csrf_field()}}
                <input name="id" value="{{$data['id']}}" type="hidden" />
                <div class="article-title">
                  <span class="label">标&nbsp;&nbsp;题：</span>
                  <input id="ipt-title" name="title" type="post" value="" />
                </div>
                <div class="article-cont">
                  <span class="label fl">正&nbsp;&nbsp;文：</span>
                  <textarea id="ipt-cont" name="content">
                    
                  </textarea>
                </div>
              </form>
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

      $('.btn-submit').on('click',function(){
        $('.family-article form').submit();
        return false
      })
    </script>
@include('base.footer')