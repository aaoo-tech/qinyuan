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
              <a class="btn-edit btn-pop" href="#">编辑</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-card" style="background-image: url({{ asset('/img/card-bg.jpg') }})">
            <div class="card-logo fl">
              <img src="{{ asset('/img/card-logo.png') }}">
            </div>
            <div class="card-info">
              <h1>华夏张氏统谱*景玉宫房谱</h1>
              <p>参修人数：30，0000人</p>
            </div>
          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont card-edit">
          <div class="box-title"><h2>编辑名片</h2></div>
          <div class="box-left fl">
            <ul class="set-list tag-list">
              <li><a class="active" data-tag="set-bg" href="#">设置背景</a></li>
              <li><a data-tag="set-logo" href="#">族谱头像</a></li>
              <li><a data-tag="set-name" href="#">族谱名称</a></li>
            </ul>
          </div>
          <div class="box-right">
            <div class="tag-cont active" id="set-bg">
              <h3>设置背景</h3>
              <div></div>
              <div class="btn-set">
                <a href="#" class="btn-save"></a>
              </div>
              <div class="btn-set">
                <a href="#" class="btn-choose"></a>
              </div>
            </div>
            <div class="tag-cont" id="set-logo">
              <h3>族谱头像</h3>
              <div></div>
            </div>
            <div class="tag-cont" id="set-name">
              <h3>编辑族谱名称</h3>
              <div class="form-holder">
                <form action="#" method="POST">
                  <div class="entry ipt-name">
                    <span>族谱名称</span>
                    <input type="text" value="华夏张氏统谱*景玉宫房谱"/>
                  </div>
                  <div class="entry">
                    <span>参修人数</span>
                    <input type="number"value="30000"/>
                    <span>人</span>
                  </div>
                  <div class="btn-set">
                    <a class="btn-submit btn" href="#">保存</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('base.footer')