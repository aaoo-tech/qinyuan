@include('base.header')
    <div class="page-wrapper">
      <div class="forgot-header clearfix">
        <div class="container">
          <div class="forgot-logo fl">
            <img src="{{ asset('/img/reset-logo.png') }}">
          </div>
          <h1 class="fl">密码设置</h1>
            <div class="fr">
              <a class="btn-pop pop-login" href="#">登录</a>
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
          <div class="tag-cont" id="step-1">
            <div class="form-holder">
              <form action="#" method="post">
                {{ csrf_field() }}
                <div class="entry">
                  <input class="ipt-phone error" type="text" placeholder="请输入您的手机号码" />
                  <span class="error-info active">返回的错误信息</span>
                </div>
                <div class="entry">
                  <input class="error" type="text" placeholder="请输入验证码" />
                  <div class="captcha">
                    <a href="#">
                      <img src="{{ asset('/img/captcha.png') }}">
                      <span>换一张</span>
                    </a>
                  </div>
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit btn-ajax" href="#">下一步</a>
                </div>
              </form>
            </div>
          </div>
          <div class="tag-cont active" id="step-2">
            <p class="tip">为了你的账号安全，请完成身份验证</p>
            <div class="info-box">
              <h3>手机验证</h3>
              <p>
                <span>手机号：</span>
                <span>139******34</span>
              </p>
            </div>
            <div class="form-holder">
              <div class="form-title">
                <h3>验证码</h3>
              </div>
              <form action="#" type="post">
                <div class="entry clearfix">
                  <input class="fl" type="text" placeholder="请输入手机验证码" />
                  <div class="captcha">
                    <a class="get-captcha" href="#">发送验证码</a>
                    <span class="get-captcha" style="display:none" href="#">重新发送(<i data-second='3'>3</i>)</span>
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
              <form action="#" type="post">
                <div class="entry clearfix">
                  <label class="fl">新密码</label>
                  <input class="fl" type="password" placeholder="请您输入新密码" />
                  <span class="error-info">请您填写密码</span>
                </div>
                <div class="entry clearfix">
                  <label class="fl">确认新密码</label>
                  <input class="fl" type="password" placeholder="再次输入新密码" />
                  <span class="error-info">两次密码不同</span>
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit" href="#">下一步</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont login-container">
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
      </div>
    </div>
@include('base.footer')