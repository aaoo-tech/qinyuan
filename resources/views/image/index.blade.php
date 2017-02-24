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
            <div class="info fl">
              <span class="album-sum">7</span>个相册
            </div>
            <div class="btn-set fr">
              <a class="btn-add btn-pop" data-pop="pop-cont-3"  href="/image/adddir">创建相册</a>
            </div>
            <div class="form-holder form-search fr">
              <form action="#" method="POST">
                <div class="fl">
                  <a class="btn-search" href="/image/search" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if(isset($keyword)){{$keyword}}@endif" placeholder="输入相册名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="album-list clearfix">
          @if($data)
            @foreach ($data as $datum)
            @if($datum['dtype'] == 1)
              <div class="album">
                <a class="album-name" href="/image/detail?did={{$datum['fid']}}" title="{{$datum['fname']}}">
                  <img src="{{$datum['picurl']}}">
                  <span>{{$datum['fname']}}</span>
                </a>
                <span class="pic-sum">{{$datum['cnt']}}</span>
                <ul class="album-info">
                  <li>创建人：{{$datum['uname']}}</li>
                  <li>创建时间：<?php echo date('Y-m-d', $datum['update_time']); ?></li>
                </ul>
                <div class="btn-menu">
                  <a class="btn-toggle" href=""><i class="iconfont icon-down"></i></a>
                  <ul class="fr">
                    <li><a class="btn-pop" data-pop="pop-cont-1" href="/image/editdir?did={{$datum['fid']}}" ><i class="iconfont icon-edit"></i>编辑</a></li>
                    <li><a class="btn-pop" data-pop="pop-cont-2" href="/image/deldir?did={{$datum['fid']}}"><i class="iconfont icon-remove"></i>删除</a></li>
                  </ul>
                </div>
              </div>
            @else
              <div class="pic">
                <label for="pic-1"></label>
                <input type="checkbox" style="display:none" id="pic-1"/>
                <a class="pic-name" target="_blank" href="{{$datum['picurl']}}" title="{{$datum['fname']}}">
                  <img src="{{$datum['picurl']}}">
                  <span>{{$datum['fname']}}</span>
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

        <div class="pop-out-confirm album-edit pop-cont-1">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>编辑相册信息</h2></div>
          <div class="form-holder">
            <form action="#">
              {{csrf_field()}}
              <inpu type="hidden" id="ipt-album-id">
              <div class="entry">
                <span class="label">相册名称</span>
                <input type="text" name="fname" value="夏子轩家的全家福" />
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

        <div class="pop-out-confirm album-remove pop-cont-2">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>删除确认</h2></div>
          <div class="box-cont">
            <p>确定要删除相册《夏子轩家的全家福》吗？</p>
          </div>
          <div class="box-footer clearfix">
            <div class="btn-set fr">
              <a class="btn btn-cancel"href="#">否</a>
            </div>
            <div class="btn-set fr">
              <a class="btn btn-submit" href="#">是</a>
            </div>
          </div>
        </div>

        <div class="pop-out-confirm album-add pop-cont-3">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>创建成功</h2></div>
          <div class="box-cont">
            <p>相册创建成功，是否马上上传照片到此相册？</p>
          </div>
          <div class="box-footer clearfix">
            <div class="btn-set fr">
              <a class="btn btn-cancel"href="#">否</a>
            </div>
            <div class="btn-set fr">
              <a class="btn btn-submit" href="#">是</a>
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