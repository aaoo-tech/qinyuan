<?php
  // getCurrentControllerName() }}-{{ getCurrentMethodName()
  if(getCurrentMethodName() == 'index'){
    $_base = '/'.getCurrentControllerName();
  }else{
    $_base = '/'.getCurrentControllerName().'/'.getCurrentMethodName();
  }
  $_page = (isset($_GET['page']) && $_GET['page'] > 0)?$_GET['page']:1;
  parse_str($_SERVER['QUERY_STRING'], $_params);
?>
<div class="pagination clearfix">
@if(isset($totalpage) && $totalpage > 10)
  <div class="container fl">
    @if($_page > 1)
      <?php
        $_params['page'] = $_page-1;
        $_query = http_build_query($_params);
      ?>
      <a class="page-prev" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-prev"></i></a>
    @else
      <a class="page-prev" href="#"><i class="iconfont icon-prev"></i></a>
    @endif

    <?php for($i=1; $i <= $totalpage; $i++){ ?>
    <?php
      $_params['page'] = $i;
      $_query = http_build_query($_params);
    ?>
    @if($i == $_page)
      <span class="current">@if($i > 3)...@endif{{$i}}@if($i < $totalpage-3)...@endif</span>
    @elseif($i == 1)
      <?php
        $_params['page'] = 1;
        $_query = http_build_query($_params);
      ?>
      <a class="page-first" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-first"></i></a>
    @elseif($i == $totalpage)
      <?php
        $_params['page'] = $totalpage;
        $_query = http_build_query($_params);
      ?>
      <a class="page-last" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-last"></i></a>
    @elseif($i < $_page+3 && $i < $_page+3)
      <?php
        $_params['page'] = ($i+3 < $totalpage)?$i+3:$totalpage;
        $_query = http_build_query($_params);
      ?>
      @if($i+3 < $totalpage)
      <a href="{{$_base}}?{{$_query}}">{{$i+3}}</a>
      @endif
    @else
    @endif
    <?php } ?>
    @if($_page < $totalpage)
      <?php
        $_params['page'] = $_page+1;
        $_query = http_build_query($_params);
      ?>
      <a class="page-next" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-next"></i></a>
    @else
      <a class="page-next" href="#"><i class="iconfont icon-next"></i></a>
    @endif

    <span>转到</span>
    <select>
      <option>1</option>
    </select>
    <span>页</span>
    <a class="page-jump btn" href="#">跳页</a>
    @if(isset($totalpage)) {{$totalpage}} @else 0 @endif
  </div>
@else
  <div class="container fl">
    @if($_page > 1)
      <?php
        $_params['page'] = $_page-1;
        $_query = http_build_query($_params);
      ?>
      <a class="page-prev" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-prev"></i></a>
    @else
      <a class="page-prev" href="#"><i class="iconfont icon-prev"></i></a>
    @endif

    <?php for($i=1; $i <= $totalpage; $i++){ ?>
    <?php
      $_params['page'] = $i;
      $_query = http_build_query($_params);
    ?>
    @if($i == $_page)
      <span class="current">{{$i}}</span>
    @else
      <a href="{{$_base}}?{{$_query}}">{{$i}}</a>
    @endif
    <?php } ?>
    @if($_page < $totalpage)
      <?php
        $_params['page'] = $_page+1;
        $_query = http_build_query($_params);
      ?>
      <a class="page-next" href="{{$_base}}?{{$_query}}"><i class="iconfont icon-next"></i></a>
    @else
      <a class="page-next" href="#"><i class="iconfont icon-next"></i></a>
    @endif

    <span>转到</span>
    <select>
      <option>1</option>
    </select>
    <span>页</span>
    <a class="page-jump btn" href="#">跳页</a>
    @if(isset($totalpage)) {{$totalpage}} @else 0 @endif
    </div>
@endif
  <div class="sum-info fr">
    <span>共@if(isset($total)) {{$total}} @else 0 @endif位注册用户</span>
  </div>
</div>