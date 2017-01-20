@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span>个人资料</span>
          </div>
        </div>
        <div class="main-body">
          @if($data)
<!--             {{$data['uid']}}
            {{$data['profession']}}
            {{$data['birther']}}
            {{$data['generation']}}
            {{$data['seniority']}} -->
          <div class="personal-info">
            <div class="p-avatar">
              <img src="{{$data['avatar']}}">
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
          
          <div class="personal-info">
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
              <dt>个人介绍：</dt><dd>1.无论对方说什么，你都回答：你牙齿里有根青菜！如果对方说：胡说，我今天没吃青菜！你就惊讶地说：原来是昨天的！以此类推 2.还是刚才的话题。如果别人这样说你，可以说：你...无论对方说什么，你都回答：你牙齿里有根青菜！如果对方说：胡说，我今天没吃青菜！你就惊讶地说：原来是昨天的！以此类推 2.还是刚才的话题。如果别人这样说你，可以说：你...无论对方说什么，你都回答：你牙齿里有根青 菜！如果对方说：胡说，我今天没吃青菜！你就惊讶地说：原来是昨天的！以此类推 2.还是刚才的话题。如果别人这样说你，可以说：你...无论对方说什么，你都回答：你牙齿里有根青菜！如果对方说：胡说，我今天没吃青菜！你就惊讶地说：原来是昨天的！以此类推 2.还是刚才的话题。如果别人这样说你，可以说：你...无论对方说什么，你都回答：你牙齿里有根青菜！如果对方说：胡说，我今天没吃青菜！你就惊讶地说：原来是昨天的！以此类推 2.还是刚才的话题。如果别人这样说你，可以说：你...</dd>
            </dl>
          </div>
          @endif
        </div>
      </div>
    </div>
@include('base.footer')