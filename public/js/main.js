(function($) {
  $(function() {

    // $('body').each(function(){
    //   this.addEventListener('',function(e){
        
    //   },false);
    // });

    // $('.btn-pop').on('click',function(){
    //   $('.pop-out').addClass('active');
    //   var pcc = $(this).data('pop');
    //   $('.pop-out .' + pcc).addClass('active');

    //   return false;
    // })

    $('.pop-out .pop-close').on('click',function(){
      $('.pop-out').removeClass('active');
      $('.pop-out > div').removeClass('active');
      return false;
    })

    $('.pop-out .btn-cancel').on('click',function(){
      $('.pop-out').removeClass('active');
      $('.pop-out > div').removeClass('active');
      return false;
    })

    $('.tag-list a').on('click', function(){
      var $elem = $(this);
      var id = $elem.attr('data-tag');
      $('.tag-list a').removeClass('active');
      $('.tag-cont').removeClass('active');
      $elem.addClass('active');
      $('#' + id).addClass('active');
    })

    $('.main-menu .user > a').on('click',function(){
      $('.main-menu .user').toggleClass('active');
      return false;
    })

    // search
    $('.form-search input').on('keypress', function(e) {
      if(e.keyCode == 13) {
        var $elem = $(this);
        var $form = $elem.closest('form');
        var val = $elem.val()
        var url = $form.attr('action')+'?keyword='+val;
        window.location.href = url;
        return false;
      }
    })
    .on('keydown', function(e) {
      if(e.keyCode == 27) {
        $(this).blur();
        return false;
      }
    });

    $('.form-search .btn-search').on('click', function() {
      var $elem = $(this);
      var $form = $elem.closest('form');
      var val = $form.find('.input-search input').val();
      var url = $form.attr('action')+'?keyword='+val;
      window.location.href = url;
      return false;
    })

   // pagination

    var jumpPage = function(){
      var ipt = $('#ipt-page-number').val();
      var max = parseInt($('.max-page').text());
      var url = $('.pagination .page-jump').attr('href');
      if(!isNaN(ipt)&&ipt>=0&&ipt<=max){
        url=url.replace(/page=\d/,'page='+ipt);
        window.location.href = url;
      }else{
        $('#ipt-page-number').addClass('error')
      }
    }

    $('.pagination .page-jump').on('click',function(){
      jumpPage();
      return false
    });

    $('#ipt-page-number').on('keypress', function(e) {
      if(e.keyCode == 13) {
        jumpPage();
        return false;
      }
    })
    .on('keydown', function(e) {
      if(e.keyCode == 27) {
        $(this).val('').blur();
        return false;
      }
    });

    $('#ipt-page-number').on('focus',function(){
      $(this).removeClass('error')
    })

    $('.add-form #ipt-name').on('focus',function(){
      $(this).removeClass('err');
    })

    $('.add-form .btn-submit').on('click',function(){
      var $elem = $(this);
      var $form = $(this).closest('form');
      var url = $form.attr('action');
      var name = $('#ipt-name').val();
      var re_name = /[\u4E00-\u9FA5]{2,4}/;
      if (!re_name.test(name)) {
        $('#ipt-name').addClass('err');
      }else{
        $.ajax({
          url: url,
          data: $form.serialize(),
          beforeSend: function() { 
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
          if (response.success == true) {
            window.location.reload();
          } else {
          }
        });
      }
      return false
    })

    // famous|champion|merit|personal
    $('.table-form input').on('focus',function(){
      $(this).closest('.entry').removeClass('err');
    });
    
    $('.table-form .check-ipt').on('change',function(){
      if($(this)[0].checked){
        $(this).closest('.entry').find('input[type="text"]').each(function(i,elem){
          $(elem).addClass('disabled');
          elem.disabled = true;
        })
      }else{
        $(this).closest('.entry').find('input[type="text"]').each(function(i,elem){
          $(elem).removeClass('disabled');
          elem.disabled = false
        })
      }
    });
    $('.table-form .btn-submit').on('click',function(){
      var $elem = $(this);
      var $form = $(this).closest('form');
      var url = $form.attr('action');
      var re_type = {
        name: /[\u4E00-\u9FA5]{2,4}/,
        number: /\b[1-9]\d*/
      }
      var isErr = false;
      $form.find('input').each(function(i,item){
        var re = $(item).data('required');
        if(!!re){
          var value = $(item).val();
          var $entry = $(item).closest('.entry');
          if(!re_type[re].test(value)){
            isErr = true;
            $entry.addClass('err')
          }
        }
      })
      if(!isErr){
        $.ajax({
          url: url,
          data: $form.serialize(),
          beforeSend: function() {
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
          if (response.success == true) {
            self.location=document.referrer;
          } else {
          }
        });
      }
      return false
    })

    $('td .link-lock').on('click',function(){
      var $elem = $(this);
      var url = $elem.attr('href');
      $.ajax({
        url: url, 
        beforeSend: function() { 
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          // $elem.closest('tr').remove();
          window.location.reload();
        } else {

        }
      });
      return false
    })


    $('td .ajax-remove').on('click',function(){
      var $elem = $(this);
      var $tr = $elem.closest('tr');
      var $tbody = $tr.closest('tbody');
      var n = $tr.find('td').length;
      var url = $elem.attr('href');
      $.ajax({
        url: url, 
        beforeSend: function() { 
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          // $tr.remove();
          // if(!$tbody.find('tr').length){
          //   $tbody.html('<td colspan="'+ n +'">空</td>')
          // }
          window.location.reload();
        } else {

        }
      });
      return false
    })

    $('td .link-info').on('click',function(){
      var url = $(this).attr('href');
      $('.pop-out-window iframe').attr('src',url);
      $('.pop-out')
      .addClass('active')
      // .find('.pop-out-window').addClass('active')

      var frame = $('.pop-out-window iframe').attr('name');
      
      // window.open(url)
      return false
    })

    // 删除管理员
    $('.admin-list .ajax-remove').on('click',function(){
      var $elem = $(this);
      var url = $elem.attr('href');
      var name = $(this).closest('li').find('.admin-name').text();
      _alert('你确定要删除管理员"'+ name +'"吗？',function(){
        $.ajax({
          url: url, 
          beforeSend: function() {
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
          if (response.success == true) {
            window.location.reload();
          } else {
            alert('删除失败');
          }
        });
      });
      return false
    });

    // table底部操作 启用／禁用
    $('.common-table table tr input[type="checkbox"]').on('change', function() {
      var $btn = $('.common-table .table-foot .btn-batch')
      $btn.removeClass('able').addClass('disable');
      var list = $('.common-table table tr input[type="checkbox"]');
      for(var i=0, len=list.length;i<len;i++){
        if(list[i].checked){
          $btn.addClass('able').removeClass('disable');
          return
        }
      }
    })
    $('.common-table .table-foot').on('click','.btn.disable', function() {
      return false;
    });
    // 批量去回收站
    $('.common-table .table-foot').on('click','.btn-to-recycle.able', function() {
      var $tr = $('.common-table table tr');
      var n = $tr.find('td').length;
      var $tbody = $('.common-table table tbody');
      var idList = [];
      var trList = [];
      $('.common-table table tr input[type="checkbox"]').each(function(i,elem){
        if(elem.checked){
          idList.push($(this).closest('tr').data('id'));
          trList.push($(this).closest('tr'));
        }
      });
      var url = $(this).attr('href');
      idList.forEach(function(id){
        url += 'ids[]='+id + '&'
      });
      $.ajax({
        url: url, 
        beforeSend: function() { 
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          window.location.reload();
        } else {

        }
      });
      return false;
    });

    // 回收站－批量 还原/删除
    $('.table-foot').on('click','.btn-batch-change.able', function() {
      var _href = $(this).attr('href');
      var message = ''
      if($(this).hasClass('btn-remove')){
        message = '确定要删除所选文件吗？';
      }else{
        message = '确定要还原所选文件吗？';
      }
      _alert(message,function(){
        var $tr = $('.common-table tr');
        var n = $tr.find('td').length;
        var $tbody = $('.common-table tbody');
        var idList = [];
        $('.common-table tr input[type="checkbox"]').each(function(i,elem){
          if(elem.checked){
            idList.push($(this).closest('tr').data('id'));
          }
        });
        var url = _href+idList.toString();
        $.ajax({
          url: url, 
          beforeSend: function() { 
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
          if (response.success == true) {
            window.location.reload();
          } else {
            alert('发生错误');
          }
        });
        return false;
      })
      return false;
    });

    // 回收站, 还原或删除所有
    $('.table-foot .btn-all.able').on('click', function() {
      var _href = $(this).attr('href');
      if($(this).hasClass('btn-remove')){
        message = '确定要删除所有文件吗？';
      }else{
        message = '确定要还原所有文件吗？';
      }
      _alert(message,function(){
        $.ajax({
          url: _href, 
          beforeSend: function() { 
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
          if (response.success == true) {
            window.location.reload();
          } else {
            alert('发生错误');
          }
        })
        return false
      });
      return false
    })


    $('.card-edit .submit').on('click',function(){
      var $elem = $(this);
      var $form = $(this).closest('form');
      var url = $form.attr('action');
      $.ajax({
        url: url,
        data: $form.serialize(),
        beforeSend: function() {
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          window.location.reload();
        } else {

        }
      });
      return false
    })

    // 影像中心，菜单显隐
    $('.album-list').on('mouseover','.album',function(){
      $(this).addClass('active');
    });
    $('.album-list').on('mouseleave','.album',function(){
      $(this).removeClass('active');
      $(this).closest('.album').find('.btn-menu').removeClass('active')
    });
    $('.album-list').on('click','.btn-toggle',function(){
      $(this).closest('.album').find('.btn-menu').toggleClass('active')
      return false;
    });
    // 影像中心，删除提示
    $('.album .btn-remove').on('click',function(){
      var $album = $(this).closest('.album');
      var url = $(this).attr('href');
      var massage = '你确定要删除相册《' + $album.find('.album-title').text() +'》吗？';
      _alert(massage,function(){
        $.ajax({
          url: url
        }).done(function() {
          window.location.reload();
        })
      });
      return false;
    });

    // 影像中心，创建相册
    $('.image-index .sub-menu .btn-add').on('click',function(){
      $('.pop-out').addClass('active');
      $('.pop-out .album-add').addClass('active');
      return false;
    });
    $('.image-index .album-add .btn-submit').on('click',function(){
      var $form = $(this).closest('.album-add').find('form');
      var url = $form.attr('action');
      $.ajax({
        url: url,
        data: $form.serialize(),
        beforeSend: function() {
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          var uid = '';
          var key = window.location.search;
          if(!!key.indexOf('uid')){
            uid = '&uid=' + response.data.uid;
          }
          console.log(response);
          window.location.href = '/image/detail?did='+response.data.did+uid;
          // _alert('相册创建成功是否要进入该相册？',function(){
          //    window.location.href = '/image/detail?did='+response.data.did+uid;
          // });
          return false;

        } else {
          $form.find('.err').addClass('active');
        }
      });
      return false
    });
    $('.image-index .album-add .ipt-name').on('focus',function(){
      $(this).closest('.album-add').find('form').find('.err').removeClass('active');
    })

    // 影像中心，编辑框
    $('.album .btn-edit').on('click',function(){
      var $album = $(this).closest('.album');
      var did = $(this).data('did');
      var title = $album.find('.album-title').text();
      $('#ipt-album-id').val(did);
      $('#ipt-title').val(title);
      $('.pop-out').addClass('active');
      $('.pop-out .album-edit').addClass('active');
      return false;
    });
    $('.album-edit .btn-submit').on('click',function(){
      var $form = $(this).closest('.album-edit').find('form');
      var url = $form.attr('action');
      $.ajax({
        url: url,
        data: $form.serialize(),
        beforeSend: function() {
          $('#loading').addClass('active');
        }
      }).done(function(response) {
        $('#loading').removeClass('active');
        if (response.success == true) {
          window.location.reload();
        } else {

        }
      });
      return false
    })

    // 影像中心，相册详情,批量管理
    $('.image-detail .btn-show').on('click',function(){
      $('body').addClass('image-edit');
      $('.batch-show').show();
      $('.batch-hidden').hide();
      return false
    })
    $('.image-detail .btn-hidden').on('click',function(){
      $('body').removeClass('image-edit');
      $('.batch-show').hide();
      $('.batch-hidden').show();
      return false
    });
    $('.image-detail .btn-edit').on('click',function(){
      var num = parseInt($('.batch-info .num').text()) ;
      if (num===0) {
        alert('请选择相片')
      }else{
        $('.pop-out').addClass('active');
        $('.pop-out .pic-edit').addClass('active');
      }
      return false;
    });
    $('.image-detail .btn-upload').on('click',function(){
      $('.pop-out').addClass('active');
      $('.pop-out .pic-add').addClass('active');
      return false;
    });
    

    // 影像中心，相册详情,批量改名
    $('.image-detail .btn-edit').on('click',function(){
      var ids = '';
      var idList = [];
      $('.image-detail .album-list input[type="checkbox"]').each(function(i,elem){
        if(elem.checked){
          idList.push($(this).closest('.pic').data('id'));
        }
      });

      idList.forEach(function(id){
        ids += 'fids[]='+ id + '&'
      });
      
      $('.pic-edit #ipt-pic-id').val(ids);
      return false;
    });
    $('.pop-out .pic-edit .btn-submit').on('click',function(){
      var $form = $('.pop-out .pic-edit form');
        var url = $form.attr('action');
        $.ajax({
          url: url,
          data: $('.pic-edit #ipt-pic-id').val() + $form.serialize(),
          beforeSend: function() {
            $('#loading').addClass('active');
          }
        }).done(function(response) {
          $('#loading').removeClass('active');
            location.reload()
        });
        return false
    })

    // 影像中心，相册详情,批量删除
    $('.image-detail .btn-remove').on('click',function(){
      var url = '/image/delfile?';
      var idList = [];
      $('.image-detail .album-list input[type="checkbox"]').each(function(i,elem){
        if(elem.checked){
          idList.push($(this).closest('.pic').data('id'));
        }
      });
      var num = $('.batch-info .num').text();
      if (parseInt(num)===0) {
        alert('请选择相片')
      }else{
        _alert('共选择'+ num +'张相片，确认要删除选中相片吗？',function(){
          idList.forEach(function(id){
            url += 'fids[]='+ id + '&'
          });
          $.ajax({
            url: url, 
            beforeSend: function() { 
              $('#loading').addClass('active');
            }
          }).done(function(response) {
            $('#loading').removeClass('active');
            if (response.success == true) {
              window.location.reload();
            } else {

            }
          });
        });
      }
      return false;
    });

    $('.image-detail .album-list .pic-checkbox').on('click',function(){
      setTimeout(function(){
        $('.batch-info .num').text($('.image-detail .pic input:checked').length);
      },100)
    });



    // logout
    function _alert(massage,doFunc){
      var $container = $('#pop-out-alert');
      $container.addClass('active');
      $container.find('.alert-tip').text(massage);
      $container.find('.btn-submit').on('click',doFunc);
      $container.find('.btn-cancel').on('click',function(){
        $container.removeClass('active');
      });
      return false;
    };


    $('.btn-logout').on('click',function(){
      _alert('你确定要退出亲缘后台吗？',function(){
        $.ajax({
          url: '/logout',
        }).done(function() {
          window.location.reload();
        })
      });
      $('.main-menu .user').removeClass('active');
      return false;
    });

  });
})(jQuery)