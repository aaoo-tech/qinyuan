<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{ $title }}</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/rest.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
      <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_6vmkwx9tjosf9a4i.css">
      <script type="text/javascript" src="{{ asset('/js/jquery-2.1.4.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/js/jquery.cookie.js') }}"></script>
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
              <div class="entry uname clearfix">
                <span class="label">用户名</span>
                <input class="fr" id="txt_uname" type="text" name="uname" maxlength="11" placeholder="手机号"/>
              </div>
              <div class="entry upasswd clearfix">
                <span class="label">密&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                <input class="fr" id="txt_upasswd" type="password" maxlength="16" name="upasswd"/>
              </div>
              <div class="entry clearfix">
                <input class="checkbox" id="isAuto" type="checkbox"/>
                <label for="isAuto">记住密码</label>
                <div class="link fr">
                  <a href="/forgot">忘记密码?</a>
                </div>
              </div>
              <div class="btn-set">
                <a class="btn-submit btn" href="#">登录</a>
              </div>
              <span class="fl error-info">错误信息</span>
            </form>
          </div>
        </div>
      </div>
      <div id="loading">
        <div class="wheel"></div>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript">
  (function($) {
    $(function() {
      if ($.cookie("rmbUser") == "true") {
        $("#isAuto").attr("checked", true);
        $("#txt_uname").val($.cookie("username"));
        $("#txt_upasswd").val($.cookie("password"));
      }
      $('.login-form .btn-submit').on('click',function(){
        var uname = $('.uname input').val();
        var upasswd = $('.upasswd input').val();
        var $error = $('.error-info');
        var isRmb = $("#isAuto")[0].checked;
        var re = /^1\d{10}$/
        if (re.test(uname)) {
          $.ajax({
            url: '/login',
            data: $('.login-form form').serializeObject(),
            type: 'POST',
            beforeSend: function() { 
              $('#loading').addClass('active');
            }
          }).done(function(response) {
            $('#loading').removeClass('active');
            if(response.success === true){
              if (isRmb) {
                var str_username = $("#txt_uname").val();
                var str_password = $("#txt_upasswd").val();
                $.cookie("rmbUser", "true", { expires: 30 });
                $.cookie("username", str_username, { expires: 30 });
                $.cookie("password", str_password, { expires: 30 });
              }
              else {
                $.cookie("rmbUser", "false", { expire: -1 });
                $.cookie("username", "", { expires: -1 });
                $.cookie("password", "", { expires: -1 });
              }
              window.location.reload();
            }else{
              $error.text(response.message).addClass('active')
            }
          });
        } else {
          $('#txt_uname').addClass('error')
        }
        return false;
      })
      $('#txt_uname').on('focus',function(){
        $(this).removeClass('error')
      })

    });
  })(jQuery);
</script>