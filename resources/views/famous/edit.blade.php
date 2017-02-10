@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
<!--           <div class="operation fr">
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div> -->
        </div>
        <div class="main-body">
          <div class="form-holder table-form">
            <form action="/famous/update" method="post">
              {{csrf_field()}}
              <input name="id" value="{{$data['id']}}" type="hidden" />
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="text" value="{{$data['uname']}}" />
              </div>
              <div class="entry">
                <span class="label">父亲：</span>
                <input id="ipt-title" name="father" type="text" value="{{$data['father']}}" />
              </div>
              <div class="entry">
                <span class="label">第几代：</span>
                <input id="ipt-title" name="generation" type="text" placeholder="请输入数字" value="{{$data['generation']}}" />
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