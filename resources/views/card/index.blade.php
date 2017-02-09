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
              <a class="btn-edit" data-pop="pop-cont-1" href="#">编辑</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-card">
            <div class="card-banner">
              <img src="{{$data['picurl']}}">
            </div>
            <div class="card-logo fl">
              <img src="{{$data['avatar']}}">
            </div>
            <div class="card-info">
              <h1>{{$data['zname']}}</h1>
              <p>参修人数：{{$data['zcnt']}}人</p>
            </div>
          </div>
        </div>
      </div>
      <div class="pop-out">
        <div class="pop-out-cont card-edit pop-cont-1">
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
                <img class="Jcrop-img" src="{{$data['picurl']}}">
              </div>
              <div class="form-holder">
                <form action="/card/picurl" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input class="img-size" type="hidden" name="size">
                  <div class="btn-set fl">
                    <a href="#" class="btn btn-save">保存图片</a>
                  </div>
                  <div class="btn-set fl">
                    <label class="btn btn-choose" for="ipt-bg">重新选择</label>
                    <input id="ipt-bg" type="file" name="picurl" style="display:none" accept="image/gif,image/jpeg,image/jpg,image/png"/>
                  </div>
                </form>
              </div>
            </div>
            <div class="tag-cont clearfix" id="set-logo">
              <h3>族谱头像</h3>
              <div class="img-container" id="logo-box">
                <img class="Jcrop-img" src="{{$data['avatar']}}">
              </div>
              <div class="form-holder">
                <form action="/card/avatar" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input class="img-size" type="hidden" name="size">
                  <div class="btn-set fl">
                    <a href="#" class="btn btn-save">保存图片</a>
                  </div>
                  <div class="btn-set fl">
                    <label class="btn btn-choose" for="ipt-logo">重新选择</label>
                    <input id="ipt-logo" type="file" name="avatar" style="display:none" accept="image/gif,image/jpeg,image/jpg,image/png"/>
                  </div>
                </form>
              </div>
            </div>
            <div class="tag-cont" id="set-name">
              <h3>编辑族谱名称</h3>
              <div class="form-holder">
                <form action="/card/zuname" method="POST">
                  {{csrf_field()}}
                  <div class="entry ipt-name">
                    <span>族谱名称</span>
                    <input name="zuname" value="{{$data['zname']}}"/>
                  </div>
                  <div class="entry">
                    <span>参修人数</span>
                    <input name="zcnt" value="{{$data['zcnt']}}"/>
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

          var inputCoords = function(c){
            var size =  JSON.stringify(c);
            var $input = $('.card-edit .tag-cont.active input.img-size');
            $input.val(size);
          };

          var jcropImg = function(){
            $('#set-bg .Jcrop-img').Jcrop({
              aspectRatio:  640 / 320,
              onChange:     inputCoords
            })

            $('#set-logo .Jcrop-img').Jcrop({
              aspectRatio: 1,
              onChange:     inputCoords
            })
          }

          var updataImg = function(elem,box,func){
            var file = elem.files[0];
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;

            var imageType = /^image\//;
            if ( !imageType.test(file.type) ) {
              return alert('所选择文件不是图片!')
            }

            $box = $(box);
            $box.empty();
            $box.append(img);

            var reader = new FileReader();
            reader.onload = (function(aImg) {
              return function(e) { 
                aImg.src = e.target.result;
                func();
              }; 
            })(img);
            reader.readAsDataURL(file);
          }

          $('.btn-edit').on('click',function(){
            $('.pop-out').addClass('active');
            $('.card-edit').addClass('active');
            jcropImg();
            return false;
          })

          $('#ipt-bg').on('change',function(){
            var elem = this;
            var box = $('#bg-box');
            var cb = function (){
              box.find('img').Jcrop({
                aspectRatio: 640 / 320,
                onChange:     inputCoords
              });
            }
            updataImg(elem,box,cb);
          })

          $('#ipt-logo').on('change',function(){
            var elem = this;
            var box = $('#logo-box');
            var cb = function (){
              box.find('img').Jcrop({
                aspectRatio: 1,
                onChange:     inputCoords
              });
            }
            updataImg(elem,box,cb);
          })

          $('.form-holder .btn-save').on('click',function(){
            var $elem = $(this);
            $elem.closest('form').submit();
            return false
          })

          $('.form-holder .btn-submit').on('click',function(){
            var $elem = $(this);
            var $form = $(this).closest('form');
            var url = $form.attr('action');
            $.ajax({
              url: url,
              data: $form.serialize(),
              beforeSend: function() { 
                $('#loading').addClass('active');
              }
            }).done(function(response) {
              $('#loading').removeClass('active');
              if (response.success == true) {
                // $('.pop-out').removeClass('active');
                location.reload();
              } else {
                
              }
            });
            return false
          })

        });
      })(jQuery)
    </script>
@include('base.footer')

