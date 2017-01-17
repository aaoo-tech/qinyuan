(function($) {
  $(function() {

    var navList = ['dashboard','user','setting'];
    var n = 0;
    var path = location.pathname.split('/');
    for(var i in navList){
      path.forEach(function(item){
        if (navList[i] === item) {
          $('.main-nav li').eq(i).find('a').addClass('active')
        };
      });
    }

    $('.btn-pop').on('click',function(){
      $('.pop-out').addClass('active');
      return false;
    })

    $('.pop-out .pop-close').on('click',function(){
      $('.pop-out').removeClass('active');
      return false;
    })

    $('.pop-out .btn-cancel').on('click',function(){
      $('.pop-out').removeClass('active');
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


    // $('.form-search input').on('keypress', function(e) {
    //   if(e.keyCode == 13) {
    //     $(this).trigger('blur');
    //   }
    // })
    // .on('keydown', function(e) {
    //   if(e.keyCode == 27) {
    //   }
    // })


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
          $elem.closest('tr').remove();
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
          $tr.remove();
          if(!$tbody.find('tr').length){
            $tbody.html('<td colspan="'+ n +'">空</td>')
          }
        } else {
        }
      });
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