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
            <div class="form-holder form-search fr">
              <form action="/tree/search" method="POST">
                {{csrf_field()}}
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if(isset($keyword)){{$keyword}}@endif" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          var back_data = <?php echo json_encode($back_data) ?>;
          var tree_data_1 = <?php echo json_encode($tree_data_1) ?>;
          var tree_data_2 = <?php echo json_encode($tree_data_2) ?>;
          // console.log('tree_data_1',tree_data_1);
          // console.log('tree_data_2',tree_data_2);
          // console.log('back_data',back_data);
          var a = <?php echo json_encode($ancestor) ?>;
          console.log('ancestor',a);
        </script>
        <div class="main-body">
          <div class="family-tree">
            <div class="container clearfix">
              @if($ancestor)
              <ul class="tree-ancestor">
                @foreach ($ancestor as $a)
                  <li class="gen-info">{{$a['generation']}}代</li>
                  <li data-uid="{{$a['uid']}}" class="person @if($a['sex'] == 0) p-woman @elseif($a['sex'] == 1)p-man @endif">
                    <p class="p-pic">
                      <img src="@if(!!$a['avatar']){{$a['avatar']}} @elseif($a['sex'] == 0) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                    </p>
                    <p class="p-name">{{$a['uname']}}</p>
                    <p class="p-sort">行{{$a['idx']}}</p>
                  </li>
                @endforeach
              </ul>
              @endif
              <div class="tree-part-1">
                @if($tree_data_1)
                  @foreach ($tree_data_1 as $g => $list)
                    <div class="tree-section clearfix">
                    <ul class="tree-g{{$g}}">
                      <li class="border"></li>
                      <li class="gen-info">{{$g}}代</li>
                      @foreach ($list as $p)
                      <li data-uid="{{$p['uid']}}" class="person @if($p['sex'] == 0)p-woman @elseif($p['sex'] == 1)p-man @endif @if($current == $p['uid'])current @endif @if($p['child'] === true) active @endif">
                        <p class="p-pic">
                          <img src="@if(!!$p['avatar']){{$p['avatar']}} @elseif($p['sex'] == 0) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                        </p>
                        <p class="p-name">{{$p['uname']}}</p>
                        <p class="p-sort">行{{$p['idx']}}</p>
                      </li>
                      @if(count($p['mate']) > 0)
                        @foreach ($p['mate'] as $m)
                          <li data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif" >
                            <p class="p-pic">
                              <img src="@if(!!$m['avatar']){{$m['avatar']}} @elseif($m['sex'] == 2) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                            </p>
                            <p class="p-name">{{$m['uname']}}</p>
                            <p class="p-sort">配偶</p>
                          </li>
                        @endforeach
                      @endif
                      @if($p['child'] === true && $current == $p['uid'])
                        <li class="gen-info gen-naxt-info">{{$p['generation']+1}}代</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endforeach
                @endif
              </div>
              @if($tree_data_2)
              <div class="tree-part-2">
                <span class="border"></span>
                @foreach ($tree_data_2 as $list)
                <div class="tree-section clearfix">
                  <ul class="tree-g4 clearfix">
                    @foreach ($list[0] as $p)
                    <li class="person @if($p['sex'] == 0) p-woman @elseif($p['sex'] == 1) p-man @endif @if($current == $p['uid']) current @endif @if($p['child'] === true) active @endif" data-uid="{{$p['uid']}}">
                      <p class="p-pic">
                        <img src="@if(!!$p['avatar']){{$p['avatar']}} @elseif($p['sex'] == 0) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                      </p>
                      <p class="p-name">{{$p['uname']}}</p>
                      <p class="p-sort">行{{$p['idx']}}</p>
                    </li>
                    @if(count($p['mate']) > 0)
                      @foreach ($p['mate'] as $m)
                      <li data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif">
                        <p class="p-pic">
                          <img src="@if(!!$m['avatar']){{$m['avatar']}} @elseif($m['sex'] == 2) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                        </p>
                        <p class="p-name">{{$m['uname']}}</p>
                        <p class="p-sort">配偶</p>
                      </li>
                      @endforeach
                    @endif
                    @if($p['child'] === true)
                      <li class="gen-info gen-naxt-info">{{$p['generation']+1}}代</li>
                    @endif
                    @endforeach
                  </ul>
                  @if($list[1])
                  <ul class="tree-g5 clearfix">
                    <li class="border"></li>
                    @foreach ($list[1] as $p)
                    <li  data-uid="{{$p['uid']}}" class="person @if($p['sex'] == 0) p-woman @elseif($p['sex'] == 1) p-man @endif @if($current == $p['uid']) current @endif @if($p['child'] === true) active @endif uid-{{$p['uid']}} pid-{{$p['pid']}}">
                      <p class="p-pic">
                        <img src="@if(!!$p['avatar']){{$p['avatar']}} @elseif($p['sex'] == 0) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                      </p>
                      <p class="p-name">{{$p['uname']}}</p>
                      <p class="p-sort">行{{$p['idx']}}</p>
                    </li>
                    @if(count($p['mate']) > 0)
                      @foreach ($p['mate'] as $m)
                      <li  data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif">
                        <p class="p-pic">
                          <img src="@if(!!$m['avatar']){{$m['avatar']}} @elseif($m['sex'] == 2) {{asset('/img/p-woman.png')}} @else {{asset('/img/p-man.png')}}@endif">
                        </p>
                        <p class="p-name">{{$m['uname']}}</p>
                        <p class="p-sort">配偶</p>
                      </li>
                      @endforeach
                    @endif
                    @endforeach
                  </ul>
                  @endif
                </div>
                @endforeach
              </div>
              @endif
              <div class="tree-menu">
                <div class="menu-title"><h3>节点操作</h3></div>
                <ul>
                  <li><a href="/personal/fid=" data-type="user_info">个人资料</a></li>
                  <li><a href="/image?uid=" data-type="user_media">个人影像资料</a></li>
                  <li><a href="/tree/add?sex=&pid=&generation=" data-type="add_mate">添加配偶</a></li>
                  <li><a href="/tree/add?pid=&generation=" data-type="add_bra">添加兄妹</a></li>
                  <li><a href="/tree/add?pid=&generation=" data-type="add_child">添加子女</a></li>
                  <li><a href="/tree/del" data-type="remove_node">删除节点</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="pop-out">
        <div class="pop-out-confirm remove-node">
          <div class="pop-close">
            <a href="#" title="关闭">
              <i class="iconfont icon-close"></i>
            </a>
          </div>
          <div class="box-haader"><h2>删除父节点</h2></div>
          <div class="form-holder">
            <form action="/info/121/">
              {{csrf_field()}}
              <input type="hidden" id="ipt-uid" name="uid" value="" />
              <div class="entry">
                <span class="label">输入登录密码</span>
                <input type="password" name="" value="" />
                <p class="fl red-tip">删除该节点，节点下面的树将会一起删除</p>
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

      var width_p2 = $('.tree-part-2').width();

      var tree_left = 0;
      var current_left = 0;
      // 祖先居中
      (function(){ 
        var $a = $('.tree-ancestor');
        var $p = $a.find('.person');
        var m = width_p2/2 - $p.width()/2 - parseInt($p.css('margin-left'));
        $a.css('margin-left',m);
      }());
      
      // 前3代位移对齐
      $('.tree-part-1 ul').each(function(i,ul){
        var $ul = $(ul);
        $p=$ul.find('.active, .current');
        var p_left = $p.position().left + parseInt($p.css('margin-left'));
        var ul_left = width_p2/2 - p_left - $p.width()/2;
        $ul.css('margin-left',ul_left);
        if (p_left>width_p2/2) {
          tree_left = Math.max(tree_left,p_left-width_p2/2); ;
        }
        $('.family-tree').css('padding-left',tree_left+$p.width()/2);
      });
      // 第4代，仅有一人时位移对齐
      if($('.tree-part-2 .tree-section').length === 1){
        $('.tree-g4').addClass('t-left');
        (function(){ 
          var $s = $('.tree-part-2 .tree-section');
          var s_width = $s.width();
          var p_width = $s.find('.active').width();
          var p_margin = $s.find('.active').css('margin-left');
          var m = s_width/2 - p_width/2 - parseInt(p_margin);
          $s.css('margin-left',m);
        }());
      };
      // 第5代，仅有一人时位移对齐
      $('.tree-g5').each(function(i,ul){
        if($(ul).find('.p-man,.p-woman').length === 1){
          $(ul).closest('.tree-section').find('.tree-g4').addClass('t-left');
        }
      });

      // 辈分代数居中
      $('.tree-part-1 .gen-info').each(function(i,elem){
        var $c = $(elem).closest('ul').find('.active, .current');
        var l = $c.position().left;
        var w = $c.width();
        $(elem).css('left',l+w/4);
      });
      $('.tree-part-2 .gen-info').each(function(i,elem){
        if (i>=0) {
          var $c = $(elem).closest('ul').find('.person:not(.p-wife,.p-husband)');
          var l = $c.position().left;
          var w = $c.width();
          $(elem).css('left',l+w/4);
        }
      });

      // 画横线
      $('.family-tree ul').each(function(i,ul){
        var $ul = $(ul);
        var width_border = $ul.find('li:not(.p-wife,.p-husband)').eq(-1).position().left;
        $ul.find('.border').width(width_border);
      });
      (function(){ 
        var $s = $('.tree-part-2 .tree-section');
        if ($s.length>0){
          var $p = $s.find('.person');
          var w = $p.width();
          var p = parseInt($s.css('padding-left'));
          var m = parseInt($p.css('margin-left'));
          var left_1 = $s.eq(0).find('.person').position().left + w/2 + p + m;
          var left_2 = $s.eq(-1).find('.person').position().left + w/2 + p + m;
          var right = $s.eq(-1).width() + 2*p - left_2;
          var width_boder = width_p2 - left_1 - right;
          $('.tree-part-2 > .border').css({
            'left' : left_1,
            'width' : width_boder,
          })
        }
      }());

      // 画完显示
      $('.family-tree .container').addClass('active')
      $('.family-tree').height($(window).height()-150);
      // console.log();



      // var genWidth = [];
      // $('.family-tree .container').width(5000);
      // $('.gen').each(function(i,gen){
      //   genWidth.push($(gen).find('.persons').width())
      // })
      // genList = $('.gen');
      // for(var i = 0, l = genList.length-1; i<l;i++ ){
      //   var cLeft = 0;
      //   if (i===0||i===l) {
      //     cLeft = genWidth[i]/2;
      //   }else{
      //     cLeft = $(genList[i]).find('.current').position().left+41;
      //   };
      //   var nextWidth = genWidth[i+1]/2;
      //   if(cLeft<nextWidth){
      //     for(var x=0;x<=i;x++){
      //       var marginLeft = parseInt($($('.persons')[x]).css('margin-left'));
      //       $($('.persons')[x]).css('margin-left',marginLeft+nextWidth-cLeft);
      //     }
      //   }else{
      //     $(genList[i+1]).find('.persons').css('margin-left',cLeft-nextWidth)
      //   }
      // }

      // var maxWidth = 0;
      // $('.persons').each(function(i,p){
      //   var w = $(p).width() + parseInt($(p).css('margin-left'));
      //   var genInfo = $(p).parent().find('.gen-info');
      //   genInfo.css('left', w - $(p).width()/2);
      //   maxWidth = Math.max(maxWidth,w);
      // })
      

      var _person;
      var selectMenu = function(t,p){
        switch(t){
          case 'user_info':
            var url = $(p).data('info-url')
            window.location.href = url
            break;
          case 'user_media':
            var url = $(p).data('media-url')
            window.location.href = url
            break;
          case 'add_mate':
            alert('添加配偶')
            break;
          case 'add_bra':
            alert('添加兄弟')
            break;
          case 'add_child':
            alert('添加子女')
            break;
          case 'remove_node':
            var uid = $(p).data(uid);
            $('ipt-uid').val(uid);
            $('.pop-out').addClass('active');
            break;
        }
        $('.family-tree .tree-menu').hide();
      };

      $('.family-tree .tree-menu a').on('click',function(){
        var type = $(this).data('type');
        selectMenu(type,_person);
        return false;
      })

      var showMenu = function(p){
        var $menu = $('.family-tree .tree-menu')
        var $container = $('.family-tree .container');
        var pTop = $(p).offset().top - $container.offset().top + $container.scrollTop();
        var pLeft = $(p).offset().left - $container.offset().left+ $container.scrollLeft();
         _person = p;
        $menu.css({
          top: pTop + 30,
          left: pLeft + 75
        }).show();
      }

      $('.person').each(function(i,p){
        p.oncontextmenu = function(e) {
          e.preventDefault();
          e.stopPropagation();
          showMenu(p);
        }
      });

      $('.family-tree .container')[0].oncontextmenu = function(e) {
        e.preventDefault();
        e.stopPropagation();
      }

      var lastTouchEnd = 0;
      $('.person').on('click',function(e) {
        e.stopPropagation();
        
        var $elem = $(this);
        var now = (new Date()).getTime();
        if (now - lastTouchEnd <= 300) {
          var url = '/tree?fid='+$elem.data('uid');
          window.location.replace(url);
        }
        lastTouchEnd = now;
      });


      $('.family-tree .container').on('click',function (){
        $('.family-tree .tree-menu').hide();
      });
    </script>
@include('base.footer')