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
            <form action="/image/udpatedir" method="post">
              {{csrf_field()}}
<!--               <div class="entry select">
                <span class="label">父目录：</span>
                <select name="pid">
                  
                </select>
              </div> -->
              <div class="entry">
                <span class="label">目录名称：</span>
                <input id="ipt-title" name="fname" type="text" value="{{$data['fname']}}" />
              </div>
              <input name="did" value="{{$data['did']}}" type="hidden" />
              <div class="btn-set">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')