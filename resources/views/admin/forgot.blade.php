@include('base.header')
    <div class="page-wrapper">
      <div class="forgot-header clearfix">
        <div class="container">
          <div class="forgot-logo fl">
            <img src="{{ asset('/img/reset-logo.png') }}">
          </div>
          <h1 class="fl">密码设置</h1>
            <div class="fr">
              <a class="btn-pop pop-login" data-pop="pop-cont-1" href="/admin">登录</a>
            </div>
          </div>
        </div>
      <div class="forgot-sub-title">
        <div class="container">
          <h2>找回密码</h2>
        </div>
      </div>
      <div class="forgot-main">
        <ul class="tag-list clearfix">
          <li><span class="active"><i>1</i>确认账号</span></li>
          <li><span ><i>2</i>安全验证</span></li>
          <li><span ><i>3</i>重置密码</span></li>
        </ul>
        <div class="steps">
          <div class="tag-cont active" id="step-1">
            <div class="form-holder">
              <form action="/forgot_one" method="post">
                {{ csrf_field() }}
                <div class="entry entry-phone">
                  <input type="text" maxlength="11" name="mobile" placeholder="请输入您的手机号码" />
                  <span class="error-info">返回的错误信息</span>
                </div>
                <div class="entry entry-captcha">
                  <input type="text" name="captcha" placeholder="请输入验证码" />
                  <div class="captcha">
                    <a href="#">
                      <img src="{{captcha_src()}}" alt="captcha" id="captcha" onclick='this.src=this.src+"?"+Math.random()' />
                      <!-- <img src="{{ asset('/img/captcha.png') }}"> -->
                      <span onclick='document.getElementById("captcha").src=document.getElementById("captcha").src+"?"+Math.random()'>换一张</span>
                    </a>
                  </div>
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit btn-ajax" href="#">下一步</a>
                </div>
              </form>
            </div>
          </div>
          <div class="tag-cont" id="step-2">
            <p class="tip">为了你的账号安全，请完成身份验证</p>
            <div class="info-box">
              <h3>手机验证</h3>
              <p>
                <span>手机号：</span>
                <span class="mobile">139******34</span>
              </p>
            </div>
            <div class="form-holder">
              <div class="form-title">
                <h3>验证码</h3>
              </div>
              <form action="/forgot_two" type="post">
                <div class="entry clearfix">
                  <input class="fl" type="text" name="authcode" placeholder="请输入手机验证码" />
                  <div class="captcha">
                    <a class="get-captcha" href="/sendcode">发送验证码</a>
                    <span class="get-captcha" style="display:none" href="#">重新发送(<i data-second='10'>10</i>)</span>
                    <span>验证码已发送</span>
                  </div>
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit" href="#">下一步</a>
                </div>
              </form>
            </div>
          </div>
          <div class="tag-cont" id="step-3">
            <div class="form-holder forgot-form">
              <form action="/forgot_three" type="post">
                <div class="entry entry-pw clearfix">
                  <label class="fl">新密码</label>
                  <input class="fl" maxlength="16" type="password" name="newpassword" placeholder="请您输入新密码" />
                  <span class="error-info">请您填写形式正确的密码(6-16位的数字、字母)</span>
                </div>
                <div class="entry entry-repw clearfix">
                  <label class="fl">确认新密码</label>
                  <input class="fl" maxlength="16" type="password" name="repassword" placeholder="再次输入新密码" />
                  <span class="error-info ">两次密码不同</span>
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit" href="#">下一步</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<!--       <div class="pop-out">
        <div class="pop-out-cont pop-cont-1 login-container">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="form-holder login-form ">
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
              </div>
              <div class="btn-set">
                <a class="btn-submit btn" href="/dashboard">登录</a>
              </div>
            </form>
          </div>
        </div>
      </div> -->
    </div>
    <script type="text/javascript">
      (function($) {
        $(function() {

          $('#step-1 .btn-submit').on('click',function(){
            var phone = $('.entry-phone input').val();
            // var captcha = $('.entry-captcha input').val().toLowerCase();
            // var re = /^1\d{10}$/
            if (re.test(phone)) {
              // if (captcha!='phvq') {
              //   $('.entry-captcha input').addClass('error');
              // }else{
              //   $('#step-1').removeClass('active');
              //   $('#step-2').addClass('active');
              //   $('.tag-list li span').removeClass('active');
              //   $('.tag-list li span').eq(1).addClass('active');
              // };
            }else{
              $('.entry-phone input').addClass('error');
              $('#step-1 .error-info').addClass('active');
              return false;
            }
            // return false;
            var $elem = $(this);
            var $form = $(this).closest('form');
            var url = $form.attr('action');
            $.ajax({
              url: url,
              data: $form.serialize(),
              beforeSend: function() { 
                $('#loading').addClass('active');
              }
            }).done(function(response) {
              $('#loading').removeClass('active');
              if (response.success == true) {
                $('#step-1').removeClass('active');
                $('#step-2').addClass('active');
                // console.log($('#step-1 form input[name="mobile"]').val());
                $('#step-2 .mobile').text($('#step-1 form input[name="mobile"]').val());
                $('.tag-list li span').removeClass('active');
                $('.tag-list li span').eq(1).addClass('active');
              } else {
              }
            });
            return false
          })

          $('#step-2 .btn-submit').on('click',function(){
            $('#step-2').removeClass('active');
            $('#step-3').addClass('active');
            $('.tag-list li span').removeClass('active');
            $('.tag-list li span').eq(2).addClass('active');
            return false;
          })

          $('#step-2 a.get-captcha').on('click',function(){
            var $a = $(this);
            var $span = $('#step-2 span.get-captcha')
            var $i = $span.find('i');
            var second = $i.attr('data-second')-0;
            var s = second;
            $a.hide();
            $span.show();
            var timer = setInterval(function(){
              $i.text(s);
              if (s === 0) {
                clearInterval(timer);
                $i.text(second);
                $span.hide();
                $a.show();
                return 
              };
              s = s - 1;
              $i.text(s);
            },1000)
            var $elem = $(this);
            var $form = $(this).closest('form');
            var url = $(this).attr('href');
            // console.log($('#step-2 .mobile').text());
            $.ajax({
              url: url,
              data: 'mobile='+$('#step-2 .mobile').text(),
              beforeSend: function() { 
                $('#loading').addClass('active');
              }
            }).done(function(response) {
              $('#loading').removeClass('active');
            });
            return false
          })

          $('#step-3 .btn-submit').on('click',function(){
            var pw = $('.entry-pw input').val();
            var repw = $('.entry-repw input').val();
            var re = /^[0-9a-zA-Z_#]{6,16}$/
            if (re.test(pw)) {
              if (pw!==repw) {
                $('.entry-repw input').addClass('error');
                $('.entry-repw .error-info').addClass('active');
              }
            }else{
              $('.entry-pw input').addClass('error');
              $('.entry-pw .error-info').addClass('active');
            };
            var $elem = $(this);
            var $form = $(this).closest('form');
            var url = $form.attr('action');
            // console.log($('#step-2 .mobile').text());
            $.ajax({
              url: url,
              data: $form.serialize()+'&mobile='+$('#step-2 .mobile').text()+'&authcode='+$('#step-2 form input[name="authcode"]').val(),
              beforeSend: function() { 
                $('#loading').addClass('active');
              }
            }).done(function(response) {
              $('#loading').removeClass('active');
              if (response.success == true) {
                window.location.href = "/admin";
              }else{
                window.location.href = "/forgot";
              }
            });
            return false;
          })

          $('input').on('focus',function(){
            $('input').removeClass('error');
            $('.error-info').removeClass('active');
          })

          // $('forgot-main form btn-ajax').on('click',function(){
          //   var $elem = $(this);
          //   var $form = $(this).closest('form');
          //   var url = $form.attr('action');
          //   $.ajax({
          //     url: url, 
          //     beforeSend: function() { 
                
          //     }
          //   }).done(function(response) {
              
          //     // response = $.parseJSON(response);
          //     if (response.success == true) {

          //     } else {

          //     }
          //   });
          // });

        });
      })(jQuery);
    </script>
@include('base.footer')