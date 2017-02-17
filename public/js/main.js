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

    $('.add-form .btn-submit').on('click',function(){
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

    // famous|champion|merit edit

    $('.table-form .btn-submit').on('click',function(){
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
          self.location=document.referrer;
        } else {
        }
      });
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


    $('li .ajax-remove').on('click',function(){
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
          window.location.reload();
        } else {

        }
      });
      return false
    })

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
    })
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

    // 还原或删除所有
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
    }


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