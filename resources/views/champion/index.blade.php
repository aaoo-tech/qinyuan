@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="other fr">
            <div class="toggle fl">
              <a class="btn-best active" href="#">状元榜</a>
              <a class="btn-kind" href="#">功德榜</a>
            </div>
            <div class="btn-set fl">
              <a class="btn-recycling" href="/champion/recycle"><i class="iconfont icon-recycling"></i>回收站</a>
            </div>
            <div class="form-holder add-famous fr">
              <form action="#" method="POST">
                <div class="search-input fl">
                  <i class="iconfont icon-search"></i><input type="text" placeholder="输入姓名"/>
                </div>
                <div class="btn-set fr">
                  <a class="btn-submit" href="#">添加</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="common-table">
            <table>
              <col width="50px"></col>
              <col></col>
              <col></col>
              <col></col>
              <col></col>
              <col></col>
              <col></col>
              <col width="175px"></col>
              <thead>
                <tr>
                  <th></th>
                  <th>排序</th>
                  <th>姓名</th>
                  <th>籍贯</th>
                  <th>学历</th>
                  <th>职务</th>
                  <th>工作单位</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>1</td>
                  <td><a href="#" >夏天</a></td>
                  <td>刘峰小溪</td>
                  <td>本科</td>
                  <td>副院长</td>
                  <td>长沙矿山研究院</td>
                  <td><a class="link-edit" href="#" >编辑</a><a class="link-remove" href="#" >删除</a></td>
                </tr>
              </tbody>
            </table>
            <div class="table-foot">
              <a class="btn" href="#" >批量删除</a>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')