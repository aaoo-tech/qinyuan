<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>家族简介</title>
</head>
<body>
  {{$data['title']}}
  {{$data['content']}}
</body>
</html>






<!-- @include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="main-body">
          <div class="article-edit">
            <div class="formholder cont-form">
              <form action="#" method="post">
                {{csrf_field()}}
                <input name="id" value="{{$data['id']}}" type="hidden" />
                <div class="article-title">
                  <span class="label">标&nbsp;&nbsp;题：</span>
                  <input id="ipt-title" name="title" type="post" value="<?php echo $data['title'];?>" />
                </div>
                <div class="article-cont">

                    <?php echo $data['content']; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('base.footer') -->