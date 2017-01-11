@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span><i class="iconfont icon-set"></i>设置</span>
          </div>
        </div>
        <div class="main-body">
          
          <div class="admin-set">
            <div class="form-holder add-form clearfix">
              <div class="form-title">
                <h3>添加管理员</h3>
              </div>
              <form action="#" tpye="post">
                <div class="entry fl">
                  <label>手机号</label>
                  <input type="text" placeholder="输入待添加管理员手机号" />
                </div>
                <div class="entry fl">
                  <label>用户名</label>
                  <input type="text" placeholder="输入姓名" />
                </div>
                <div class="btn-set fl">
                  <a class="btn-add btn" href="#">添加</a>
                </div>
              </form>
            </div>

            <div class="admin-list">
              <div class="list-title">
                <h3>管理员(<span>3<span>)</h3>
              </div>
              <ul>
                <li>
                  <span class="admin-name">张仲景</span>
                  <span>账号：</span>
                  <span class="admin-account">13933331234</span>
                </li>
                <li>
                  <span class="admin-name">张玉</span>
                  <span>账号：</span>
                  <span class="admin-account">13933331234</span>
                  <a class="btn-remove" href="#">删除</a>
                </li>
                <li>
                  <span class="admin-name">张雪</span>
                  <span>账号：</span>
                  <span class="admin-account">13933331234</span>
                  <a class="btn-remove" href="#">删除</a>
                </li>
              </ul>
            </div>
          </div>


        </div>
      </div>
    </div>
@include('base.footer')