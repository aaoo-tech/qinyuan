@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
<!--           <div class="operation fr">
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div> -->
        </div>
        <div class="main-body">
          <div class="form-holder table-form">
            <form action="/famous/create" method="post">
              {{csrf_field()}}
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">父亲：</span>
                <input id="ipt-title" name="father" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">第几代：</span>
                <input id="ipt-title" name="generation" type="text" placeholder="请输入数字" value="" />
              </div>
              <div class="btn-set">
                <a class="btn btn-submit" href="#">保存</a>
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