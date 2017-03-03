@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="btn-set batch-hidden fl">
            <a class="btn btn-upload" href="/image/upload?did={{$_GET['did']}}">上传图片</a>
          </div>
          <div class="btn-set batch-btn-set batch-show fl">
            <a class="fl btn batch-show btn-edit" href="#">编辑描述</a>
            <a class="fl btn batch-show btn-remove" href="#">批量删除</a>
          </div>

          <div class="batch-info batch-show fl">已选择<span class="num"> 0 </span>张</div>
          <div class="operation fr">
            <div class="info fl">
              <span class="album-sum">共{{$total}}张相片</span>
            </div>
            <div class="btn-set fr">
              <a class="btn-show batch-hidden btn-add" href="#">批量管理</a>
              <a class="btn-hidden batch-show btn-add" href="#">管理完成</a>
            </div>

          </div>
        </div>
        <div class="main-body">
          <div class="album-list clearfix">
          @if($data)
            @foreach ($data as $datum)
            @if($datum['ftype'] == 1)
              <div class="album">
                <a class="album-link" href="/image/detail?did={{$datum['fid']}}" title="{{$datum['desc']}}">
                  <span class="pic-bg" style="background-image: url(@if($datum['fname']){{$datum['fname']}}@else{{asset('/img/album-bg.png')}}@endif)">
                  <span class="album-title">{{$datum['desc']}}</span>
                </a>
                <span class="pic-sum">{{$datum['cnt']}}</span>
                <ul class="album-info">
                  <li>创建人：{{$datum['uname']}}</li>
                  <li>创建时间：<?php echo date('Y-m-d', $datum['update_time']); ?></li>
                </ul>
                <div class="btn-menu">
                  <a class="btn-toggle" href=""><i class="iconfont icon-down"></i></a>
                  <ul class="fr">
                    <li><a class="btn-pop" data-pop="pop-cont-1" href="#"><i class="iconfont icon-edit"></i>编辑</a></li>
                    <li><a class="btn-remove" data-pop="pop-cont-2" href="#"><i class="iconfont icon-remove"></i>删除</a></li>
                  </ul>
                </div>
              </div>
            @else
              <div class="pic" data-id="{{$datum['fid']}}">
                <input type="checkbox" style="display:none" id="pic-{{$datum['fid']}}"/>
                <label class="pic-checkbox" for="pic-{{$datum['fid']}}"></label>
                <a class="pic-link fancybox" data-fancybox-group="gallery" href="{{$datum['fname']}}" title="{{$datum['desc']}}">
                  <span class="pic-bg" style="background-image: url({{$datum['fname']}})"></span>
                  <img src="{{$datum['fname']}}" style="display: none")>
                  <span class="pic-title">{{$datum['desc']}}</span>
                </a>
              </div>
            @endif
            @endforeach
          @else
          @endif
          </div>
          @include('base.pagination')
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
            <form action="/image/uploadfile" class="dropzone" id="my-dropzone">
              {{csrf_field()}}
              <input name="did" value="{{$_GET['did']}}" type="hidden" />
              <div class="form-foot">
                <div class="entry-name fl">
                  <span class="label">统一添加照片描述</span>
                  <input type="text" name="desc" maxlength="20" value="" />
                  <span class="tip">(描述最多20个字)</span>
                </div>
                <div class="btn-set fr">
                  <a class="btn btn-submit" href="#" id="ipt-upload">保存</a>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="pop-out-confirm pic-edit">
          <input type="hidden" id="ipt-pic-id" name="did" />
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>编辑所选相片名称</h2></div>
          <div class="form-holder">
            <form action="/image/updatefile" method="post">
              {{csrf_field()}}
              <div class="entry">
                <span class="label">相片名称</span>
                <input id="ipt-title" type="text" name="desc"/>
                <span class="tip">(相片名称最多8个字)</span>
              </div>
            </form>
          </div>
          <div class="box-footer clearfix">
            <div class="btn-set fr">
              <a class="btn btn-cancel" href="#">取消</a>
            </div>
            <div class="btn-set fr">
              <a class="btn btn-submit" href="#">确定</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-buttons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/js/fancyBox/source/jquery.fancybox.css') }}" />
    <script type="text/javascript" src="{{ asset('/js/fancyBox/lib/jquery.mousewheel.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-buttons.js') }}"></script>
    <script type="text/javascript">
      (function($) {
        $(function() {
          $('.fancybox').fancybox();
          Dropzone.options.myDropzone = {

            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue: false,
            dictDefaultMessage: '点击选择文件或拖拽文件到该区域上传',
            maxFiles: 10,
            parallelUploads: 10,

            init: function() {
              var submitButton = document.querySelector("#ipt-upload")
                  myDropzone = this; // closure

              submitButton.addEventListener("click", function() {
                myDropzone.processQueue(); // Tell Dropzone to process all queued files.
              });

              // You might want to show the submit button only when 
              // files are dropped here:
              this.on("addedfile", function() {
                // Show submit button here and/or inform user to click it.
              });

            }
          };
          // $('.dropzone').dropzone({
          //     dictDefaultMessage: '点击选择文件或拖拽文件到该区域上传'
          // });
        });
      })(jQuery)
    </script>
@include('base.footer')