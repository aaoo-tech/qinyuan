<?php
  // getCurrentControllerName() }}-{{ getCurrentMethodName()
  if(getCurrentMethodName() == 'index'){
    $_base = '/'.getCurrentControllerName();
  }else{
    $_base = '/'.getCurrentControllerName().'/'.getCurrentMethodName();
  }
  $_page = (isset($_GET['page']) && $_GET['page'] > 0)?$_GET['page']:1;
  // echo $_base;
  echo $_page;
?>
<div class="pagination clearfix">
@if(isset($totalpage) && $totalpage != 0)
  <div class="container fl">

    <a class="page-first" href=""><i class="iconfont icon-first"></i></a>
    <a class="page-prev" href="{{$_base}}?page={{$_page-1}}"><i class="iconfont icon-prev"></i></a>
    <?php for($i=1; $i <= $totalpage; $i++){ ?>
    @if($i == $_page)
    <span class="current">{{$i}}</span>
    @else
    <a href="{{$_base}}?page={{$i}}">{{$i}}</a>
    @endif
    <?php } ?>
    <a class="page-next" href="{{$_base}}?page={{$_page+1}}"><i class="iconfont icon-next"></i></a>
    <a class="page-last" href="#"><i class="iconfont icon-last"></i></a>

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
{{$_SERVER['QUERY_STRING']}}