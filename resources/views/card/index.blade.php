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
              <a class="btn-edit" href="#">编辑</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-card" style="background-image: url({{ asset('/img/card-bg.jpg') }})">
            <div class="card-logo fl">
              <img src="{{$data['zurl']}}">
            </div>
            <div class="card-info">
              <h1>{{$data['zuname']}}</h1>
              <p>参修人数：{{$data['zcnt']}}人</p>
            </div>
          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont card-edit">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-title"><h2>编辑名片</h2></div>
          <div class="box-left fl">
            <ul class="set-list tag-list">
              <li><a class="active" data-tag="set-bg" href="#">设置背景</a></li>
              <li><a data-tag="set-logo" href="#">族谱头像</a></li>
              <li><a data-tag="set-name" href="#">族谱名称</a></li>
            </ul>
          </div>
          <div class="box-right">
            <div class="tag-cont clearfix active" id="set-bg">
              <h3>设置背景</h3>
              <div class="img-container" id="bg-box">
                <img class="Jcrop-img" src="{{ asset('/img/card-bg.jpg') }}">
              </div>
              <form action="#">
                {{csrf_field()}}
                <div class="btn-set fl">
                  <a href="#" class="btn btn-save">保存图片</a>
                </div>
                <div class="btn-set fl">
                  <label class="btn btn-choose" for="ipt-bg">重新选择</label>
                  <input id="ipt-bg" type="file" accept="image/*" style="display:none" />
                </div>
              </form>
            </div>
            <div class="tag-cont clearfix" id="set-logo">
              <h3>族谱头像</h3>
              <div class="img-container">
                <img class="Jcrop-img" src="{{ asset('/img/card-logo.png') }}">
              </div>
              <div class="btn-set fl">
                <a href="#" class="btn btn-save">保存图片</a>
              </div>
              <div class="btn-set fl">
                <label class="btn btn-choose" for="ipt-logo">重新选择</label>
                <input id="ipt-logo" type="file" accept="image/*" style="display:none" />
              </div>
            </div>
            <div class="tag-cont" id="set-name">
              <h3>编辑族谱名称</h3>
              <div class="form-holder">
                <form action="/card/avatar" method="POST">
                  <div class="entry ipt-name">
                    <span>族谱名称</span>
                    <input type="zuname" value="{{$data['zuname']}}"/>
                  </div>
                  <div class="entry">
                    <span>参修人数</span>
                    <input type="zcnt"value="{{$data['zcnt']}}"/>
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
    <script type="text/javascript" src="{{ asset('/js/Jcrop/jquery.Jcrop.min.js') }}"></script>
    <script type="text/javascript">
      (function($) {
        $(function() {

          $('.btn-edit').on('click',function(){
            $('.pop-out').addClass('active');
            $('.card-edit').addClass('active');
            $('#set-bg .Jcrop-img').Jcrop({
              aspectRatio: 640 / 320
            });
            $('#set-logo .Jcrop-img').Jcrop({
              aspectRatio: 1
            });
            return false;
          })


          var updataImg = function(elem,box){
            var file = elem.files[0];
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;

            // var imageType = /^image\/jpeg/;
            // if ( imageType.test(file.type) ) {
            // }

            $box = $(box);
            $box.empty();
            $box.append(img);

            var reader = new FileReader();
            reader.onload = (function(aImg) {
              return function(e) { 
                aImg.src = e.target.result; 
              }; 
            })(img);
            reader.readAsDataURL(file);
          }

          $('#ipt-bg').on('change',function(){
            var elem = this;
            var box = $('#bg-box')
            updataImg(elem,box);
            // function jcropImg($box){
            //   $box.find('img').Jcrop({
            //     aspectRatio: 640 / 320
            //   });
            // }
          })

        });
      })(jQuery)
    </script>
@include('base.footer')
<!-- 
 <form method="POST" action="/card/avatar" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="avatar" />
    <input type="submit" name="submit" value="Submit" />
</form>  -->