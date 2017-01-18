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
              <a class="btn-edit" href="/profile/edit">编辑</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-summary">
            <iframe class="profile-info" src="/profile/info"></iframe>
<!--             <div class="summary-title">
              <h1>{{$data[0]['title']}}</h1>
            </div> -->
<!--             <div class="summary-cont article">
              <?php echo $data[0]['content']; ?>
            </div> -->
          </div>
        </div>
      </div>
    </div>
@include('base.footer')