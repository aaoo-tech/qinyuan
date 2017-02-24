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
            <a class="btn btn-upload btn-pop"  data-pop="pop-cont-1" href="/image/upload?did={{$_GET['did']}}">上传图片</a>
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

          @if($data)
            @foreach ($data as $datum)
            @if($datum['ftype'] == 1)
              <div class="album">
                <a class="album-name" href="/image/detail?did={{$datum['fid']}}" title="{{$datum['desc']}}">
                  <img src="{{$datum['fname']}}">
                  <span>{{$datum['desc']}}</span>
                </a>
                <span class="pic-sum">{{$datum['cnt']}}</span>
                <ul class="album-info">
                  <li>创建人：{{$datum['uname']}}</li>
                  <li>创建时间：<?php echo date('Y-m-d', $datum['update_time']); ?></li>
                </ul>
                <div class="btn-menu">
                  <a class="btn-toggle" href=""><i class="iconfont icon-down"></i></a>
                  <ul class="fr">
                    <li><a class="btn-pop" data-pop="pop-cont-1" href="#" ><i class="iconfont icon-edit"></i>编辑</a></li>
                    <li><a class="btn-pop" data-pop="pop-cont-2" href="#"><i class="iconfont icon-remove"></i>删除</a></li>
                  </ul>
                </div>
              </div>
            @else
              <div class="pic">
                <label for="pic-1"></label>
                <input type="checkbox" style="display:none" id="pic-1"/>
                <a class="pic-name" target="_blank" href="{{$datum['fname']}}" title="{{$datum['desc']}}">
                  <img src="{{$datum['fname']}}">
                  <span>{{$datum['desc']}} {{$datum['fid']}}</span>
                </a>
              </div>
            @endif
            @endforeach
          @else
          @endif
          @include('base.pagination')

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