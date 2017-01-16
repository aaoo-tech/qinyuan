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
            <div class="form-holder search-genealogy fr">
              <form action="#" method="POST">
                <div class="search-input fl">
                  <i class="iconfont icon-search"></i><input type="text" placeholder="输入姓名"/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="family-tree">
            <div class="container">
              <div class="gen clearfix">
                <div class="gen-info">
                  <span>1代(天)</span>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张天德</p>
                  <p class="p-sort">(行2)</p>
                </div>
              </div>
              <div class="gen clearfix">
                <div class="gen-info">
                  <span>2代(端)</span>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张端落</p>
                  <p class="p-sort">(行1)</p>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张端可</p>
                  <p class="p-sort">(行2)</p>
                </div>
                <div class="person p-woman">
                  <p class="p-pic "></p>
                  <p class="p-name">张端雪</p>
                  <p class="p-sort">(行3)</p>
                </div>
                <div class="person p-woman">
                  <p class="p-pic"></p>
                  <p class="p-name">张端雨</p>
                  <p class="p-sort">(行4)</p>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张端安</p>
                  <p class="p-sort">(行5)</p>
                </div>
                <div class="person p-man current">
                  <p class="p-pic">
                    <img src="{{ asset('/img/tr1.jpg') }}">
                  </p>
                  <p class="p-name">张端平</p>
                  <p class="p-sort">(行6)</p>
                </div>
                <div class="person p-wife p-woman">
                  <p class="p-pic"></p>
                  <p class="p-name">李秀芳</p>
                  <p class="p-sort">(配偶)</p>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张端祥</p>
                  <p class="p-sort">(行7)</p>
                </div>
                <div class="person p-woman">
                  <p class="p-pic"></p>
                  <p class="p-name">张端月</p>
                  <p class="p-sort">(行8)</p>
                </div>
              </div>
              <div class="gen clearfix">
                <div class="gen-info">
                  <span>3代(和)</span>
                </div>
                <div class="person p-man">
                  <p class="p-pic">
                    <img src="{{ asset('/img/tr1.jpg') }}">
                  </p>
                  <p class="p-name">张和落</p>
                  <p class="p-sort">(行1)</p>
                </div>
                <div class="person p-man">
                  <p class="p-pic"></p>
                  <p class="p-name">张和可</p>
                  <p class="p-sort">(行2)</p>
                </div>
                <div class="person p-woman">
                  <p class="p-pic "></p>
                  <p class="p-name">张和雪</p>
                  <p class="p-sort">(行3)</p>
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
        <div class="pop-out-cont user-info">
        </div>
        <div class="pop-out-confirm remove-node">
        </div>
      </div>
    </div>
    <script type="text/javascript">
      // var wg1;
      // var wg2;
      // $('.gen').eq(1).find('.person').length * 122 - 40 - $('.gen').eq(1).find('.person').length
      var maxWidth = 0;
      $('.gen').each(function(i,gen){
        maxWidth = Math.max(maxWidth,$(gen).width())
      })
      $('.family-tree .container').width(maxWidth);

      var l = $('.person.current').offset().left - $('.gen').eq(1).offset().left;
      var w = $('.gen').eq(2).width()/2 - $('.person').width()/2 ;
      $('.gen').eq(2).css('left',l - w )

      var _person;
      var selectMenu = function(t,p){
        switch(t)
        {
        case 'user_info':

          break;
        case 'user_media':

          break;
        case 'add_mate':

          break;
        case 'add_bra':

          break;
        case 'add_child':

          break;
        case 'remove_node':

          break;
        return false;
      }
      $('.family-tree .tree-menu a').on('click',function(){
        var type = $(this).data('type');
        selectMenu(type,_person);
      })

      var showMenu = function(p){
        var $menu = $('.family-tree .tree-menu')
        var $container = $('.family-tree .container');
        var pTop = $(p).offset().top - $container.offset().top;
        var pLeft = $(p).offset().left - $container.offset().left;
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
      })

      $('.family-tree .container').on('click',function (){
        $('.family-tree .tree-menu').hide();
      })



    </script>
@include('base.footer')