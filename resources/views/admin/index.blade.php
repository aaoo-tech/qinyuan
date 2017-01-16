<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{ $title }}</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/rest.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
      <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_um3wp2d6bax20529.css">
      <script type="text/javascript" src="{{ asset('/js/jquery-2.1.4.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/js/utility.js') }}"></script>
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
              {{csrf_field()}}
              <div class="entry clearfix">
                <span class="label">用户名</span>
                <input class="fr" type="text" name="uname" placeholder="手机号"/>
              </div>
              <div class="entry clearfix">
                <span class="label">密&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                <input class="fr" type="password" name="upasswd"/>
              </div>
              <div class="entry clearfix">
                <input class="checkbox" id="isAuto" type="checkbox" name="isAuto"/>
                <label for="isAuto">记住密码</label>
                <div class="link fr">
                  <a href="/forgot_one">忘记密码?</a>
                </div>
              </div>
              <div class="btn-set">
                <a class="btn-submit btn" href="#">登录</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="page-footer">
      </footer>
    </div>
  </body>
</html>
<script type="text/javascript">
(function($) {
    $(function() {
      $('body').on('click', '.login-container .btn-submit', function() {
        $.ajax({
            url: '/login',
            data: $('.login-container form').serializeObject(),
            type: 'POST'
        }).done(function(response) {
          console.log(response);
            if(response.success === true){
                window.location.href = '/dashboard'
            }
        });
        return false;
      });
    });
})(jQuery);
</script>>