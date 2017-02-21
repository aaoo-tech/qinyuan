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
              <form action="#" method="POST">
                {{csrf_field()}}
                <div class="fl">
                  <a class="btn-search" href="#" >
                    <i class="iconfont icon-search"></i>
                  </a>
                </div>
                <div class="input-search fr">
                  <input type="text" name="keyword" value="@if (isset($keyword)) {{$keyword}} @endif" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-tree">
            <div class="container">
            @if($data)
              <div class="tree-part-1">
              @foreach ($data as $k => $datum)
                <div class="tree-section clearfix">
                  <ul class="tree-g{{$k}}">
                    <li class="border"></li>
                    <li class="gen-info">{{$k}}代</li>
                    @foreach ($datum as $val)
                    <li class="person @if($val['sex'] == 0) p-woman @elseif($val['sex'] == 1) p-man @endif @if($current == $val['uid']) current @endif" >
                      <p class="p-name">{{$val['uname']}}</p>
                    </li>
                    @if(count($val['mate']) > 0)
                    @foreach ($val['mate'] as $value)
                    <li class="person @if($val['sex'] == 2) p-wife @elseif($val['sex'] == 3) p-husband @endif" >
                      <p class="p-name">{{$value['uname']}}</p>
                    </li>
                    @endforeach
                    @endif
                    @endforeach
                  </ul>
                </div>
              @endforeach
              </div>
            @else
            @endif
              <div class="tree-part-1">
                <div class="tree-section clearfix">
                  <ul class="tree-g1">
                    <li class="border"></li>
                    <li class="gen-info">101代</li>
                    <li class="person p-man" ><p class="p-name">张1</p></li>
                    <li class="person p-man" ><p class="p-name">张1</p></li>
                    <li class="person p-wife" ><p class="p-name">妻1</p></li>
                    <li class="person p-wife" ><p class="p-name">妻1</p></li>
                    <li class="person p-wife" ><p class="p-name">妻1</p></li>
                    <li class="person p-man" ><p class="p-name">张1</p></li>
                    <li class="person p-man active" ><p class="p-name">张1</p></li>
                  </ul>
                </div>
                <div class="tree-section clearfix">
                  <ul class="tree-g2">
                    <li class="border"></li>
                    <li class="gen-info">102代</li>
                    <li class="person p-man" ><p class="p-name">张2</p></li>
                    <li class="person p-man" ><p class="p-name">张2</p></li>
                    <li class="person p-wife" ><p class="p-name">妻2</p></li>
                    <li class="person p-wife" ><p class="p-name">妻2</p></li>
                    <li class="person p-man active" ><p class="p-name">张2</p></li>
                    <li class="person p-wife" ><p class="p-name">妻2</p></li>
                    <li class="person p-man" ><p class="p-name">张2</p></li>
                  </ul>
                </div>
                <div class="tree-section clearfix">
                  <ul class="tree-g3">
                    <li class="border"></li>
                    <li class="gen-info">103代</li>
                    <li class="person p-man" ><p class="p-name">张3</p></li>
                    <li class="person p-man active" ><p class="p-name">张3</p></li>
                    <li class="person p-wife" ><p class="p-name">妻3</p></li>
                    <li class="person p-wife" ><p class="p-name">妻3</p></li>
                    <li class="person p-wife" ><p class="p-name">妻3</p></li>
                    <li class="person p-man" ><p class="p-name">张3</p></li>
                    <li class="person p-wife" ><p class="p-name">妻3</p></li>
                  </ul>
                </div>
              </div>
              <div class="tree-part-2">
                <span class="border"></span>
                <div class="tree-section">
                  <ul class="tree-g4 clearfix">
                    <li class="gen-info">104代</li>
                    <li class="gen-info gen-naxt-info">105代</li>
                    <li class="person p-man active" ><p class="p-name">张4</p></li>
                    <li class="person p-wife" ><p class="p-name">妻4</p></li>
                    <li class="person p-wife" ><p class="p-name">妻4</p></li>
                    <li class="person p-wife" ><p class="p-name">妻4</p></li>
                  </ul>
                  <ul class="tree-g5 clearfix">
                    <li class="border"></li>
                    <li class="person p-man" ><p class="p-name">张5</p></li>
                  </ul>
                </div>
                <div class="tree-section">
                  <ul class="tree-g4 clearfix">
                    <li class="gen-info">104代</li>
                    <li class="gen-info gen-naxt-info">105代</li>
                    <li class="person p-man active" ><p class="p-name">张4</p></li>
                    <li class="person p-wife" ><p class="p-name">妻4</p></li>
                  </ul>
                  <ul class="tree-g5 clearfix">
                    <li class="border"></li>
                    <li class="person p-man" ><p class="p-name">张5</p></li>
                    <li class="person p-wife" ><p class="p-name">妻5</p></li>
                    <li class="person p-man" ><p class="p-name">张5</p></li>
                    <li class="person p-wife" ><p class="p-name">妻5</p></li>
                    <li class="person p-man" ><p class="p-name">张5</p></li>
                  </ul>
                </div>
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
        var $p = $ul.find('.active');
        var p_left = $p.position().left
        var ul_left = width_g5/2 - p_left - $p.width()/2;
        $ul.css('margin-left',ul_left);
        if (p_left>width_g5/2) {
          tree_left = Math.max(tree_left,p_left-width_g5/2); ;
        }
        $('.family-tree').css('padding-left',tree_left+$p.width()/2);
      });

      $('.family-tree ul').each(function(i,ul){
        var $ul = $(ul);
        var width_border = $ul.find('li:not(.p-wife,.p-husband)').eq(-1).position().left;
        $ul.find('.border').width(width_border);
      });

      (function(){ 
        var $s = $('.tree-part-2 .tree-section');
        var pw = $s.eq(0).find('.active').width()/4;
        var a = $s.eq(0).find('.active').position().left;
        var b = $s.eq(-1).find('.active').position().left;
        var ww = $s.eq(-1).width();
        var width_boder = width_g5 - a + b - ww - 2*pw;
        $('.tree-part-2 > .border').css({
          'margin-left' :a + pw,
          'width' :width_boder,
        })
      }());

      $('.gen-info').each(function(i,elem){
        var $c = $(elem).closest('ul').find('.active');
        console.log($c)
        var l = $c.position().left;
        var w = $c.width();
        $(elem).css('left',l+w/4);
      })


      



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
      //     cLeft = $(genList[i]).find('.active').position().left+41;
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

      $('.family-tree .container').on('click',function (){
        $('.family-tree .tree-menu').hide();
      });
    </script>
@include('base.footer')


<!--               <div class="gen clearfix">
                <div class="gen-info">
                  <span>1代(天)</span>
                </div>
                <div class="persons fl">
                  <div class="person p-man active" data-uid="x" data-media-url='/image' data-info-url='/personal'>
                    <p class="p-pic"></p>
                    <p class="p-name active">张天可</p>
                    <p class="p-sort">(行3)</p>
                  </div>
                </div>
              </div>
              <div class="gen clearfix">
                <div class="gen-info">
                  <span>2代(端)</span>
                </div>
                <div class="persons fl">
                  <div class="person p-man active" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端德</p>
                    <p class="p-sort">(行1)</p>
                  </div>
                  <div class="person p-woman" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端落</p>
                    <p class="p-sort">(行2)</p>
                  </div>
                  <div class="person p-man" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端可</p>
                    <p class="p-sort">(行3)</p>
                  </div>
                </div>
              </div>
              <div class="gen clearfix">
                <div class="gen-info">
                  <span>3代(端)</span>
                </div>
                <div class="persons fl">
                  <div class="person p-man" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端落</p>
                    <p class="p-sort">(行1)</p>
                  </div>
                  <div class="person p-man" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端可</p>
                    <p class="p-sort">(行2)</p>
                  </div>
                  <div class="person p-woman" data-uid="x">
                    <p class="p-pic "></p>
                    <p class="p-name">张端雪</p>
                    <p class="p-sort">(行3)</p>
                  </div>
                  <div class="person p-woman active" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端雨</p>
                    <p class="p-sort">(行4)</p>
                  </div>
                  <div class="person p-man" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">张端安</p>
                    <p class="p-sort">(行5)</p>
                  </div>
                  <div class="person p-man" data-uid="x">
                    <p class="p-pic">
                      <img src="{{ asset('/img/tr1.jpg') }}">
                    </p>
                    <p class="p-name ">张端平</p>
                    <p class="p-sort">(行6)</p>
                  </div>
                  <div class="person p-wife p-woman" data-uid="x">
                    <p class="p-pic"></p>
                    <p class="p-name">李秀芳</p>
                    <p class="p-sort">(配偶)</p>
                  </div>
                </div>
              </div> -->