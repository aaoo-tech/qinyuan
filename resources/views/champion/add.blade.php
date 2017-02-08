@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="operation fr">
            <div class="btn-set">
              <a class="btn-back" href="#">返回</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="form-holder table-form">
            <form action="/champion/add" method="post">
              {{csrf_field()}}
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">籍贯：</span>
                <input id="ipt-title" name="addr" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">学历：</span>
                <input id="ipt-title" name="education" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">职务：</span>
                <input id="ipt-title" name="job" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">工作单位：</span>
                <input id="ipt-title" name="workplace" type="text" value="" />
              </div>
              <div class="btn-set">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')