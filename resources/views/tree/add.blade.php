@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
        </div>
        <div class="main-body">
          <div class="form-holder table-form">
            <form action="/tree/create" method="post">
              {{csrf_field()}}
              @if(!empty($_GET['pid']) && !empty($_GET['generation']))
              <input name="pid" value="{{$_GET['pid']}}" type="hidden">
              <input name="generation" value="{{$_GET['generation']}}" type="hidden">
              @endif
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">父亲姓名：</span>
                <input id="ipt-title" name="father" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">母亲姓名：</span>
                <input id="ipt-title" name="monther" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">兄弟排行：</span>
                <input id="ipt-title" name="idx" type="text" value="" />
              </div>
              @if(!empty($_GET['sex']) && $_GET['sex'] > 1)
              <input name="sex" value="{{$_GET['sex']}}" type="hidden">
              @else
              <div class="entry">
                <span class="label">性别：</span>
                <select name="sex">
                  <option value="0">女</option>
                  <option value="1">男</option>
                </select>
              </div>
              @endif
              <div class="entry">
                <span class="label">出生日期：</span>
                <input id="ipt-title" name="birthday" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">去世日期：</span>
                <input id="ipt-title" name="death" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">居住地址：</span>
                <input id="ipt-title" name="addr" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">手机号码：</span>
                <input id="ipt-title" name="mobile" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">个人介绍：</span>
                <textarea name="content" rows="10" cols="50"></textarea>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-cancel" href="#">取消</a>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')