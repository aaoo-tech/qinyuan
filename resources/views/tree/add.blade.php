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
              @if(isset($_GET['pid']))
              <input name="pid" value="{{$_GET['pid']}}" type="hidden">
              @endif
              <div class="entry">
                <span class="label">姓名：</span>
                <input name="uname" type="text" value="" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              @if(isset($_GET['generation']))
              <input name="generation" value="{{$_GET['generation']}}" type="hidden">
              @else
              <div class="entry">
                <span class="label">代数：</span>
                <input name="generation" type="text" value="" data-required="number"/>
                <span class="err-info">必填，请输入大于0的数字</span>
              </div>
              @endif
              <div class="entry">
                <span class="label">父亲姓名：</span>
                <input name="father" type="text" value="" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              <div class="entry">
                <span class="label">母亲姓名：</span>
                <input name="monther" type="text" value="" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              <div class="entry">
                <span class="label">兄弟排行：</span>
                <input name="idx" type="text" value="" data-required="number"/>
                <span class="err-info">必填，请输入大于0的数字</span>
              </div>
              @if(isset($_GET['sex']) && $_GET['sex'] > 1)
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
                <input class="long-ipt" name="birthday" type="text" value="" />
                
              </div>
              <div class="entry">
                <span class="label">去世日期：</span>
                <input class="long-ipt" name="death" type="text" value="" />
                <span class="check-label label">未亡：</span>
                <input class="check-ipt" name="isalive" type="checkbox" />
              </div>
              <div class="entry">
                <span class="label">居住地址：</span>
                <input class="long-ipt" name="addr" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">手机号码：</span>
                <input class="long-ipt" name="mobile" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">个人介绍：</span>
                <textarea name="content" rows="10" cols="50"></textarea>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
<!--               <div class="btn-set fl">
                <a class="btn btn-cancel" href="#">取消</a>
              </div> -->
              
            </form>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')