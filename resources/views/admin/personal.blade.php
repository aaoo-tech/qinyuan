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
            @if(!empty($_GET['fid']))
            <div class="btn-set fl">
              <a class="btn-recycling" href="/image?fid={{$_GET['fid']}}"><i class="iconfont icon-img"></i>影像资料</a>
            </div>
            @endif
            <div class="btn-set fr">
              <a class="btn-edit" href="#">编辑</a>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          var a = <?php echo json_encode($data) ?>;
          console.log('data',a);
        </script>
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
              @if(!empty($data['death']))
                {{$data['death']}}
              @else
                未亡
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
              <dd>{{$data['describe']}}</dd>
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
          @if($data)
          <div class="personal-info table-form info-edit clearfix" style="display: none">
            <form action="/tree/update" method="post">
              {{csrf_field()}}
              <input name="uid" value="{{$data['uid']}}" type="hidden">
              <input name="pid" value="{{$data['pid']}}" type="hidden">
              <input name="generation" value="{{$data['generation']}}" type="hidden">
<!--               @if(!empty($_GET['pid']) && !empty($_GET['generation']))
              <input name="pid" value="{{$_GET['pid']}}" type="hidden">
              <input name="generation" value="{{$_GET['generation']}}" type="hidden">
              @endif -->
              <div class="p-avatar">
                <img class="fl" src="@if(!!$data['avatar']){{$data['avatar']}} @else {{asset('/img/p-man.png')}}@endif" >
<!--                 <label class="btn btn-choose" for="ipt-bg">重新选择</label>
                <input id="ipt-bg" type="file" name="picurl" style="display:none" accept="image/gif,image/jpeg,image/jpg,image/png"/> -->
              </div>
              <div class="entry">
                <span class="label">姓名：</span>
                <input id="ipt-title" name="uname" type="text" value="{{$data['uname']}}" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              <div class="entry">
                <span class="label">性别：</span>
                  @if($data['sex'] > 1)
                    <select name="sex">
                      <option value="2" @if($data['sex']==2) selected @endif>妻子</option>
                      <option value="3" @if($data['sex']==3) selected @endif>丈夫</option>
                    </select>
                  @else
                    <select name="sex">
                      <option value="1" @if($data['sex']==1) selected @endif>男</option>
                      <option value="0" @if($data['sex']==0) selected @endif>女</option>
                    </select>
                  @endif
              </div>
              <div class="entry">
                <span class="label">父亲姓名：</span>
                <input id="ipt-title" name="father" type="text" value="{{$data['father']}}" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              <div class="entry">
                <span class="label">母亲姓名：</span>
                <input id="ipt-title" name="monther" type="text" value="{{$data['monther']}}" data-required="name"/>
                <span class="err-info">必填，请输入正确的姓名（1-4个中文汉字）</span>
              </div>
              <div class="entry">
                <span class="label">兄弟排行：</span>
                <input id="ipt-title" name="idx" type="text" value="{{$data['idx']}}" data-required="number"/>
                <span class="err-info">必填，请输入大于0的数字</span>
              </div>
              <div class="entry">
                <span class="label">出生日期：</span>
                <input id="ipt-title" name="birthday" type="text" value="{{$data['birthday']}}" />
              </div>
              <div class="entry">
                <span class="label">去世日期：</span>
                <input id="ipt-title" name="death" type="text" value="{{$data['death']}}" />
              </div>
              <div class="entry">
                <span class="label">居住地址：</span>
                <input id="ipt-title" name="addr" type="text" value="{{$data['addr']}}" />
              </div>
              <div class="entry">
                <span class="label">手机号码：</span>
                <input id="ipt-title" name="mobile" type="text" value="{{$data['mobile']}}" />
              </div>
              <div class="entry">
                <span class="label">个人介绍：</span>
                <textarea name="content" rows="10" cols="50">{{$data['describe']}}</textarea>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-submit" href="#">保存</a>
              </div>
              <div class="btn-set fl">
                <a class="btn btn-cancel" href="#">取消</a>
              </div>
            </form>
          </div>
          @endif
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('.operation .btn-edit').on('click',function(){
        $('.admin-personal').addClass('personal-edit');
        $('.info-show').hide();
        $('.info-edit').show();
        return false
      })
      $('.info-edit .btn-cancel').on('click',function(){
        $('.admin-personal').removeClass('personal-edit');
        $('.info-show').show();
        $('.info-edit').hide();
        return false
      })

    </script>
@include('base.footer')