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
            <form action="/merit/update" method="post">
              {{csrf_field()}}
              <input name="id" value="{{$data['id']}}" type="hidden" />
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="post" value="{{$data['uname']}}" />
              </div>
              <div class="entry">
                <span class="label">籍贯：</span>
                <input id="ipt-title" name="addr" type="post" value="{{$data['addr']}}" />
              </div>
              <div class="entry">
                <span class="label">学历：</span>
                <input id="ipt-title" name="education" type="post" value="{{$data['education']}}" />
              </div>
              <div class="entry">
                <span class="label">职务：</span>
                <input id="ipt-title" name="job" type="post" value="{{$data['job']}}" />
              </div>
              <div class="entry">
                <span class="label">捐款金额：</span>
                <input id="ipt-title" name="money" type="post" value="{{$data['money']}}" />
                <span>（元）</span>
              </div>
              <div class="btn-set">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
            </form>
          </div>
      </div>
    </div>
@include('base.footer')