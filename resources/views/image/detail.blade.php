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
            <a class="btn btn-upload btn-pop"  data-pop="pop-cont-1" href="#">上传图片</a>
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
              <a class="pic-name" target="_blank" href="/img/pic.jpg" title="夏子轩广东南国鼎峰装饰江苏区总设计师">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩广东南国鼎峰装饰江苏区总设计师</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" target="_blank" href="/img/pic.jpg" title="国际注册高级室内设计师">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>国际注册高级室内设计师</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" target="_blank" href="/img/pic.jpg" title="广东南国鼎峰装饰江苏区总设计师资深收费设计师">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>广东南国鼎峰装饰江苏区总设计师资深收费设计师</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" target="_blank" href="/img/pic.jpg" title="夏子轩">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩</span>
              </a>
            </div>

            <div class="pic">
              <label for="pic-1"></label>
              <input type="checkbox" style="display:none" id="pic-1"/>
              <a class="pic-name" target="_blank" href="/img/pic.jpg" title="夏子轩">
                <img src="{{ asset('/img/pic.jpg') }}">
                <span>夏子轩</span>
              </a>
            </div>

          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont pic-add pop-cont-1">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>上传相片</h2></div>
          <div class="form-holder">
            <form action="#">
              {{csrf_field()}}
              <div class="preview">
                <!-- <img src=""> -->
              </div>
              <div class="entry-pic">
                <label class="btn-choose" for="ipt-pic"><i class="iconfont icon-add"></i></label>
                <input id="ipt-pic" type="file" name="picurl" style="display:none" accept="image/gif,image/jpeg,image/jpg,image/png"/>
              </div>
              <div class="entry-name fl">
                <span class="label">统一添加照片描述</span>
                <input type="text" name="" maxlength="20" value="" />
                <span class="tip">(描述最多20个字)</span>
              </div>
              <div class="btn-set fr">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
            </form>
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