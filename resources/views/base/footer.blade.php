      <div id="pop-out-alert">
        <div class="container">
          <div class="box-haader"><span>提示</span></div>
          <div class="box-cont">
            <p class="alert-tip">你确定要执行这项操作吗？</p>
            <div class="btn-set fl">
              <a class="btn btn-submit" href="#">确定</a>
            </div>
            <div class="btn-set fr">
              <a class="btn btn-cancel" href="#">取消</a>
            </div>
          </div>
        </div>
      </div>

      <div id="loading">
        <div class="wheel"></div>
      </div>
      <div id="alert-error">
        <span>操作失败！</span>
      </div>
      <script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
      <script type="text/javascript">
      (function($) {
        $(function() {
          var c = "{{getCurrentControllerName()}}";
          $('.main-nav li a').removeClass('active');
          if(c != 'user' && c != 'setting'){
            $('.main-nav li.admin a').addClass('active');
          }else{
            $('.main-nav li.'+ c +' a').addClass('active');
          }
        });
      })(jQuery);
</script>
  </body>
</html>