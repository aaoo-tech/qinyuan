@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="other fr">
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-summary">
            
          </div>
        </div>
      </div>
    </div>
@include('base.footer')