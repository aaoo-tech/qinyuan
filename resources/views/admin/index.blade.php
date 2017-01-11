<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{ $title }}</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/rest.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
      <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_um3wp2d6bax20529.css">
      <script type="text/javascript" src="{{ asset('/js/jquery-2.1.4.js') }}"></script>
  </head>
  <body class="">
    <div class="page-wrapper">
      <div class="login-container clearfix">
        <div class="login-left fl">
          <img src="{{ asset('/img/login.png') }}">
        </div>
        <div class="login-right fr">
          <div class="form-holder login-form">
            <div class="form-title">
              <h2>管理员登录</h2>
            </div>
            <form action="#" method="POST">
              <div class="entry clearfix">
                <span class="label">用户名</span>
                <input class="fr" type="text" name="user" placeholder="手机号"/>
              </div>
              <div class="entry clearfix">
                <span class="label">密&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                <input class="fr" type="password" name="password"/>
              </div>
              <div class="entry clearfix">
                <input class="checkbox" id="isAuto" type="checkbox" name="isAuto"/>
                <label for="isAuto">记住密码</label>
                <div class="link fr">
                  <a href="/forgot">忘记密码?</a>
                </div>
              </div>
              <div class="btn-set">
                <a class="btn-submit btn" href="/dashboard">登录</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="page-footer">
          <script type="text/javascript">
          (function($) {
            $(function() {

              var navList = ['center','users','set'];
              var n = 0;
              var path = location.pathname.split('/');
              for(var i in navList){
                path.forEach(function(item){
                  if (navList[i] === item) {
                    console.log(i);
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
    </div>
  </body>
</html>
