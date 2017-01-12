@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
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
                  <th>捐款金额（元）</th>
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
                  <td>10000</td>
                  <td><a class="link-edit" href="#" >编辑</a><a class="link-remove" href="#" >删除</a></td>
                </tr>
              </tbody>
            </table>
            <div class="table-foot">
              <div class="left-cont fl">
                <a class="btn" href="#" >批量删除</a>
                <a class="btn" href="#" >批量还原</a>
              </div>
              <div class="right-cont">
                <a class="btn" href="#" >还原所有</a>
                <a class="btn" href="#" >删除所有</a>
              </div>
            </div>
          </div>
          @include('base.pagination')
        </div>
      </div>
    </div>
@include('base.footer')