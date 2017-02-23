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
          console.log('tree_data_1',tree_data_1);
          console.log('tree_data_2',tree_data_2);
          console.log('back_data',back_data);
        </script>
        <div class="main-body">
          <div class="family-tree">
            <div class="container clearfix">
              @if($ancestor)
              <div class="tree-ancestor">
                @if($ancestor)
                @foreach ($ancestor as $k => $val)
                  <p>{{$val['generation']}}代</p>
                  <p>{{$val['uname']}}</p>
                @endforeach
                @endif
              </div>
              @endif
              <div class="tree-part-1">
                @if($tree_data_1)
                  @foreach ($tree_data_1 as $g => $list)
                    <div class="tree-section clearfix">
                    <ul class="tree-g{{$g}}">
                      <li class="border"></li>
                      <li class="gen-info">{{$g}}代</li>
                      @foreach ($list as $p)
                      <li  data-uid="{{$p['uid']}}" class="person @if($p['sex'] == 0)p-woman @elseif($p['sex'] == 1)p-man @endif @if($current == $p['uid'])current @endif @if($p['child'] === true) active @endif uid-{{$p['uid']}} pid-{{$p['pid']}}"><p class="p-name">{{$p['uid']}}{{$p['uname']}}</p></li>
                      @if(count($p['mate']) > 0)
                        @foreach ($p['mate'] as $m)
                          <li data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif" ><p class="p-name">{{$m['uname']}}</p></li>
                        @endforeach
                      @endif
                      @if($p['child'] === true)
                        <li class="gen-info gen-naxt-info">{{$p['generation']+1}}代</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="tree-part-2">
                @if($tree_data_2)
                  <span class="border"></span>
                  @foreach ($tree_data_2 as $list)
                  <div class="tree-section clearfix">
                    <ul class="tree-g4 clearfix">
                      @foreach ($list[0] as $p)
                      <li data-uid="{{$p['uid']}}" class="person @if($p['sex'] == 0) p-woman @elseif($p['sex'] == 1) p-man @endif @if($current == $p['uid']) current @endif @if($p['child'] === true) active @endif uid-{{$p['uid']}}"><p class="p-name">{{$p['uid']}}{{$p['uname']}}</p></li>
                      @if(count($p['mate']) > 0)
                        @foreach ($p['mate'] as $m)
                        <li  data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif"><p class="p-name">{{$m['uname']}}</p></li>
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
                      <li  data-uid="{{$p['uid']}}" class="person @if($p['sex'] == 0) p-woman @elseif($p['sex'] == 1) p-man @endif @if($current == $p['uid']) current @endif @if($p['child'] === true) active @endif uid-{{$p['uid']}} pid-{{$p['pid']}}"><p class="p-name">{{$p['uid']}}{{$p['uname']}}</p></li>
                      @if(count($p['mate']) > 0)
                        @foreach ($p['mate'] as $m)
                        <li  data-uid="{{$p['uid']}}" class="person @if($m['sex'] == 2) p-wife @elseif($m['sex'] == 3) p-husband @endif"><p class="p-name">{{$m['uname']}}</p></li>
                        @endforeach
                      @endif
                      @endforeach
                    </ul>
                    @endif
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="tree-menu">
                <div class="menu-title"><h3>节点操作</h3></div>
                <ul>
                  <li><a href="#" data-type="user_info">个人资料</a></li>
                  <li><a href="#" data-type="user_media">个人影像资料</a></li>
                  <li><a href="#" data-type="add_mate">添加配偶</a></li>
                  <li><a href="#" data-type="add_bra">添加兄妹</a></li>
                  <li><a href="#" data-type="add_child">添加子女</a></li>
                  <li><a href="#" data-type="remove_node">删除节点</a></li>
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

      var width_g5 = $('.tree-part-2').width();
      var tree_left = 0;
      $('.tree-part-1 ul').each(function(i,ul){
        var $ul = $(ul);

        $p=$ul.find('.active, .current');
        var p_left = $p.position().left
        var ul_left = width_g5/2 - p_left - $p.width()/2;

        $ul.css('margin-left',ul_left);

        if (p_left>width_g5/2) {
          tree_left = Math.max(tree_left,p_left-width_g5/2); ;
        }
        $('.family-tree').css('padding-left',tree_left+$p.width()/2);

      });

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

      $('.family-tree ul').each(function(i,ul){
        var $ul = $(ul);
        var width_border = $ul.find('li:not(.p-wife,.p-husband)').eq(-1).position().left;
        $ul.find('.border').width(width_border);
      });

      (function(){ 
        var $s = $('.tree-part-2 .tree-section');
        if ($s.length>0){
          var pw = $s.find('.person').width()/2;
          var left_1 = $s.eq(0).find('.person').position().left + pw + 28;
          var left_2 = $s.eq(-1).find('.person').position().left + pw + 28;
          var right = $s.eq(-1).width() - left_2 + 40;
          var width_boder = width_g5 - left_1 - right;
          $('.tree-part-2 > .border').css({
            'left' : left_1,
            'width' : width_boder,
          })
        }
      }());



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
        console.log(lastTouchEnd);
        if (now - lastTouchEnd <= 300) {
          var url = '/tree?fid='+$elem.data('uid');
          window.location.replace(url);
          console.log(url);
        }
        lastTouchEnd = now;
      });


      $('.family-tree .container').on('click',function (){
        $('.family-tree .tree-menu').hide();
      });
    </script>
@include('base.footer')