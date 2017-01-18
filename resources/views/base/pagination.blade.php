<div class="pagination clearfix">
  <div class="container fl">
    <a class="page-first" href="#"><i class="iconfont icon-first"></i></a>
    <a class="page-prev" href="#"><i class="iconfont icon-prev"></i></a>
    <span class="current">1</span>
    <a class="page-next" href="#"><i class="iconfont icon-next"></i></a>
    <a class="page-last" href="#"><i class="iconfont icon-last"></i></a>
    <span>转到</span>
    <select>
      <option>1</option>
    </select>
    <span>页</span>
    <a class="page-jump btn" href="#">跳页</a>
    @if(isset($totalpage)) {{$totalpage}} @else 0 @endif
  </div>
  <div class="sum-info fr">
    <span>共@if(isset($total)) {{$total}} @else 0 @endif位注册用户</span>
  </div>
</div>