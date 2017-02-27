@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            @if(!empty($_GET['fid']))
            <i class="iconfont icon-home"></i><a href="/dashboard">家族中心</a><a href="/tree?fid={{$_GET['fid']}}">家族树</a>
            @endif
            <span>个人资料</span>
          </div>
          <div class="operation fr">
            <div class="btn-set fl">
              <a class="btn-recycling" href="/image?fid="><i class="iconfont icon-img"></i>影像资料</a>
            </div>
            <div class="btn-set fr">
              <a class="btn-edit" href="#">编辑</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          @if($data)
<!--             {{$data['uid']}}
            {{$data['profession']}}
            {{$data['birther']}}
            {{$data['generation']}}
            {{$data['seniority']}} -->
          <div class="personal-info info-show">
            <div class="p-avatar">
              <img src="@if(!!$data['avatar']){{$data['avatar']}} @else {{asset('/img/p-man.png')}}@endif" >
            </div>
            <dl>
              <dt>姓名：</dt>
              <dd>{{$data['uname']}}</dd>
              <dt>姓别：</dt>
              <dd>
              @if($data['sex']==0)
                女
              @elseif($data['sex']==1)
                男
              @elseif($data['sex']==2)
                妻子
              @elseif($data['sex']==3)
                丈夫
              @endif
              </dd>
              <dt>出生日期：</dt>
              <dd>{{$data['birthday']}}</dd>
              <dt>去世日期：</dt>
              <dd>
              @if($data['isalive']==1)
                未亡
              @else
                {{$data['death']}}
              @endif
              </dd>
              <dt>父亲姓名：</dt>
              <dd>{{$data['father']}}</dd>
              <dt>母亲姓名：</dt>
              <dd>{{$data['monther']}}</dd>
              <dt>家中排行：</dt>
              <dd>行{{$data['idx']}}</dd>
              <dt>手机号：</dt>
              <dd>{{$data['mobile']}}</dd>
              <dt>居住地址：</dt>
              <dd>{{$data['addr']}}</dd>
              <dt>个人介绍：</dt>
              <dd></dd>
            </dl>
          </div>
          @else
          <div class="personal-info info-show">
            <div class="p-avatar">
            </div>
            <dl>
              <dt>姓名：</dt><dd>xxx</dd>
              <dt>姓别：</dt><dd>男</dd>
              <dt>出生日期：</dt><dd>xxx年xx月xx日</dd>
              <dt>去世日期：</dt><dd>xxx年xx月xx日</dd>
              <dt>父亲姓名：</dt><dd>xxx</dd>
              <dt>母亲姓名：</dt><dd>xxx</dd>
              <dt>家中排行：</dt><dd>行11</dd>
              <dt>手机号：</dt><dd>13933331234</dd>
              <dt>居住地址：</dt><dd>xxxxxxxxx</dd>
              <dt>个人介绍：</dt><dd></dd>
            </dl>
          </div>
          @endif
          <div class="personal-info info-edit" style="display: none">
            <form action="/tree/create" method="post">
              {{csrf_field()}}
<!--               @if(!empty($_GET['pid']) && !empty($_GET['generation']))
              <input name="pid" value="{{$_GET['pid']}}" type="hidden">
              <input name="generation" value="{{$_GET['generation']}}" type="hidden">
              @endif -->
              <div class="p-avatar">
                <img class="fl" src="@if(!!$data['avatar']){{$data['avatar']}} @else {{asset('/img/p-man.png')}}@endif" >
                <label class="btn btn-choose" for="ipt-bg">重新选择</label>
                <input id="ipt-bg" type="file" name="picurl" style="display:none" accept="image/gif,image/jpeg,image/jpg,image/png"/>
              </div>
              <dl>
                <dt>姓名：</dt>
                <dd><input type="text" name="uname" value="{{$data['uname']}}"></dd>
                <dt>姓别：</dt>
                <dd>
                  <select name="sex">
                    <option value="1" @if($data['sex']==1) selected @endif>男</option>
                    <option value="0" @if($data['sex']==0) selected @endif>女</option>
                    <option value="2" @if($data['sex']==2) selected @endif>妻子</option>
                    <option value="3" @if($data['sex']==3) selected @endif>丈夫</option>
                  </select>
                </dd>
                <dt>出生日期：</dt>
                <dd><input type="text" name="birthday" value="{{$data['birthday']}}"></dd>
                <dt>去世日期：</dt>
                <dd>
                  <input type="text" name="death" value="{{$data['death']}}">
                  <span class="alive">未亡</span>
                  <input id="ipt-isalive" @if($data['isalive']==1) checked @endif type="checkbox" name="isalive" />
                </dd>
                <dt>父亲姓名：</dt>
                <dd><input type="text" name="father" value="{{$data['father']}}"></dd>
                <dt>母亲姓名：</dt>
                <dd><input type="text" name="monther" value="{{$data['monther']}}"></dd>
                <dt>家中排行：</dt>
                <dd><input type="text" name="idx" value="行{{$data['idx']}}"></dd>
                <dt>手机号： </dt>
                <dd><input type="text" name="mobile" value="{{$data['mobile']}}"></dd>
                <dt>居住地址：</dt>
                <dd><input type="text" name="addr" class="addr" value="{{$data['addr']}}"></dd>
                <dt>个人介绍：</dt>
                <dd><textarea name="content" value="{{$data['idx']}}"></textarea></dd>
              </dl>
              <div class="btn-set fl">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-cancel" href="#">取消</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('.operation .btn-edit').on('click',function(){
        $('body').addClass('personal-edit');
        $('.info-show').hide();
        $('.info-edit').show();
      })

    </script>
@include('base.footer')