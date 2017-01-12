        <footer class="page-footer">
            <script type="text/javascript">
            (function($) {
              $(function() {

                var navList = ['dashboard','user','setting'];
                var n = 0;
                var path = location.pathname.split('/');
                for(var i in navList){
                  path.forEach(function(item){
                    if (navList[i] === item) {
                      $('.main-nav li').eq(i).find('a').addClass('active')
                    };
                  });
                }

                $('.btn-pop').on('click',function(){
                  $('.pop-out').addClass('active');
                })

                $('.pop-out').on('click',function(){
                  $(this).removeClass('active');
                })

                $('.pop-out .pop-out-cont').on('click',function(e){
                  e.stopPropagation();
                })

                $('.tag-list a').on('click', function(){
                  var $elem = $(this);
                  var id = $elem.attr('data-tag');
                  $('.tag-list a').removeClass('active');
                  $('.tag-cont').removeClass('active');
                  $elem.addClass('active');
                  $('#' + id).addClass('active');
                })

                $('.main-menu .user > a').on('click',function(){
                  $('.main-menu .user').toggleClass('active');
                  return false;
                })
              });
            })(jQuery)
          </script>
        </footer>
    </body>
</html>