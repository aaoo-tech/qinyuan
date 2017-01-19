@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="btn-set fl">
            <a class="btn btn-upload" href="#">上传图片</a>
          </div>
          <div class="operation fr">
            <div class="info fl">
              <span class="album-sum">4</span>张相片
            </div>
            <div class="btn-set fr">
              <a class="btn-add" href="#">批量管理</a>
            </div>

          </div>
        </div>
        <div class="main-body">
          <div class="pic-list clearfix">

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" href="/img/pic.jpg" title="夏子轩家的全家福">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩家的全家福</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" href="/img/pic.jpg" title="夏子轩家的全家福">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩家的全家福</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" href="/img/pic.jpg" title="夏子轩家的全家福">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩家的全家福</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" href="/img/pic.jpg" title="夏子轩家的全家福">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩家的全家福</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" href="/img/pic.jpg" title="夏子轩家的全家福">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩家的全家福</span>
              </a>
            </div>

          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont album-edit pop-cont-1">
          <div class="box-haader"><h2>编辑相册信息</h2></div>
          <div class="form-holder">
            <form action="#">
              {{csrf_field()}}
              <div class="entry">
                <span class="label">相册名称</span>
                <input type="text" name="" value="夏子轩家的全家福" />
                <span class="tip">(相册名称最多8个字)</span>
              </div>
            </form>
          </div>
          <div class="box-footer clearfix">
            <div class="btn-set fr">
              <a class="btn btn-cancel"href="#">取消</a>
            </div>
            <div class="btn-set fr">
              <a class="btn btn-submit" href="#">确定</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
        $(function() {
          $('.album-list').on('mouseover','.album',function(){
            $(this).addClass('active');
          });
          $('.album-list').on('mouseleave','.album',function(){
            $(this).removeClass('active');
            $(this).closest('.album').find('.btn-menu').removeClass('active')
          });
          $('.album-list').on('click','.btn-toggle',function(){
            $(this).closest('.album').find('.btn-menu').toggleClass('active')
            return false;
          });
        });
      })(jQuery)
    </script>
@include('base.footer')