(function($) {
  $(function() {

    // $('body').each(function(){
    //   this.addEventListener('',function(e){
        
    //   },false);
    // });

    $('.btn-pop').on('click',function(){
      $('.pop-out').addClass('active');
      var pcc = $(this).data('pop');
      $('.pop-out .' + pcc).addClass('active');

      return false;
    })

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
          window.location.href='/famous';
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
    $('.btn-logout').on('click',function(){
      $('#login-out-alert').addClass('active');
      $('.main-menu .user').removeClass('active');
      return false;
    });

    $('#login-out-alert .btn-cancel').on('click',function(){
      $('#login-out-alert').removeClass('active');
      return false;
    });

    // forgot
    $('#step-2 a.get-captcha').on('click',function(){
      var $a = $(this);
      var $span = $('#step-2 span.get-captcha')
      var $i = $span.find('i');
      var second = $i.attr('data-second')-0;
      var s = second;
      $a.hide();
      $span.show();
      var timer = setInterval(function(){
        $i.text(s);
        if (s === 0) {
          clearInterval(timer);
          $i.text(second);
          $span.hide();
          $a.show();
          return 
        };
        s = s - 1;
        $i.text(s);
      },1000)
    })

    $('forgot-main form btn-ajax').on('click',function(){
      var $elem = $(this);
      var $form = $(this).closest('form');
      var url = $form.attr('action');
      $.ajax({
        url: url, 
        beforeSend: function() { 
          
        }
      }).done(function(response) {
        
        // response = $.parseJSON(response);
        if (response.success == true) {

        } else {

        }
      });
    });






  });
})(jQuery)