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
        $('.page-left .main-nav li a').removeClass('active');
        console.log(c);
        if(c != 'user' && c != 'setting'){
            $('.page-left .main-nav li.admin a').addClass('active');
        }else{
            $('.page-left .main-nav li.'+ c +' a').addClass('active');
        }
    });
})(jQuery);
</script>
  </body>
</html>