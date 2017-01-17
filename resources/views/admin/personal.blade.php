@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <span>个人资料</span>
            {{$data['uid']}}
            {{$data['uname']}}
            {{$data['mobile']}}
            {{$data['father']}}
            {{$data['monther']}}
            {{$data['avatar']}}
            {{$data['addr']}}
            {{$data['profession']}}
            {{$data['birthday']}}
            {{$data['death']}}
            {{$data['birther']}}
            {{$data['seniority']}}
            {{$data['sex']}}
            {{$data['generation']}}
            {{$data['idx']}}
            {{$data['isalive']}}
          </div>
        </div>
      </div>
    </div>
@include('base.footer')