@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="main-body">
          <div class="article-iframe">
            <div class="formholder cont-form">
              <form action="/history/update" method="post">
                {{csrf_field()}}
                <input name="id" value="{{$data['id']}}" type="hidden" />
                <div class="article-title">
                  <span class="label">标&nbsp;&nbsp;题：</span>
                  <input id="ipt-title" name="title" type="post" value="<?php echo $data['title']; ?>" />
                </div>
                <div class="article-cont">
                  <span class="label fl">正&nbsp;&nbsp;文：</span>
                  <textarea id="ipt-cont" name="content">
                    <?php echo $data['content']; ?>
                  </textarea>
                </div>
              </form>
            </div>
          </div>
        
        </div>
      </div>
    </div>
@include('base.footer')