@include('base.header')
    <div class="page-wrapper">
      <div class="reset-header clearfix">
        <div class="container">
          <div class="reset-logo fl">
            <img src="{{ asset('/img/reset-logo.png') }}">
          </div>
          <h1 class="fl">密码设置</h1>
            <div class="fr">
              <a class="btn-pop pop-login" href="#">登录</a>
            </div>
          </div>
        </div>
      <div class="reset-sub-title">
        <div class="container">
          <h2>找回密码</h2>
        </div>
      </div>
      <div class="reset-main">
        <ul class="tag-list clearfix">
          <li><a class="active" data-tag="step-1" href="#"><i>1</i>确认账号</a></li>
          <li><a class="" data-tag="step-2" href="#"><i>2</i>安全验证</a></li>
          <li><a data-tag="step-3" href="#"><i>3</i>重置密码</a></li>
        </ul>
        <div class="steps">
          <div class="tag-cont active" id="step-1">
            <div class="form-holder">
              <form action="#" type="post">
                <div class="entry">
                  <input class="ipt-phone" type="text" placeholder="请输入您的手机号码" />
                  <span class="error-info">请输入正确的手机号码</span>
                </div>
                <div class="entry">
                  <input type="text" placeholder="请输入验证码" />
                </div>
                <div class="btn-set">
                  <a class="btn btn-submit" href="#">下一步</a>
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
                  <div class="fl">
                    <a href="#">重新发送</a>
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
            <div class="form-holder reset-form">
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
        <div class="login-container pop-out-cont">
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