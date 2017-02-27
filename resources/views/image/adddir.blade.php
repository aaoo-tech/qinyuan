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
            <form action="/image/createdir" method="post">
              {{csrf_field()}}
<!--               <div class="entry select">
                <span class="label">父目录：</span>
                <select name="pid">
                  
                </select>
              </div> -->
              <div class="entry">
                <span class="label">目录名称：</span>
                <input id="ipt-title" name="dirname" type="text" value="" />
              </div>
              <div class="entry">
                <span class="label">类型：</span>
                <select name="type">
                  <option value="1">家族</option>
                  <option value="2">个人</option>
                </select>
              </div>
              <div class="entry">
                <span class="label">权限：</span>
                <select name="jurisdiction">
                  <option value="1">私密</option>
                  <option value="2">公开</option>
                  <option value="3">上下1代公开</option>
                  <option value="4">上下2代公开</option>
                </select>
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