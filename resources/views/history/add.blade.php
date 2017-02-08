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
              <a class="btn-submit btn-add" href="#">提交</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="article-edit">
            <div class="formholder cont-form">
              <form action="/history/create" method="post">
                {{csrf_field()}}
                <div class="article-title">
                  <span class="label">标&nbsp;&nbsp;题：</span>
                  <input id="ipt-title" name="title" type="text" value="" />
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
    </div>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.form.js') }}"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: '#ipt-cont',
        language: 'zh_CN',
        height : 500,
        content_css: '{{ asset("/css/tinymce.css") }}',
        theme: 'modern',
        convert_urls: false,
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak imageupload',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ',
        toolbar2: 'forecolor backcolor | preview imageupload ',
        image_advtab: true,
        imageupload_url: '/upload',
        csrf: '{{csrf_field()}}'
       });
    </script>
    <script type="text/javascript">
      (function($) {
          $(function() {
            $('body').on('click', '.btn-add', function() {
              $('#ipt-cont').val(tinymce.activeEditor.getContent())
              $.ajax({
                url: '/history/create',
                data: $('.cont-form form').serializeObject(),
                type: 'POST',
                beforeSend: function() { 
                  $('#loading').addClass('active');
                }
              }).done(function(response) {
                $('#loading').removeClass('active');
                if(response.success === true){
                  window.location.href = '/history'
                }
              });
              return false;
            });
          });
      })(jQuery);
    </script>
@include('base.footer')