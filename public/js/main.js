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
      $(this).removeClass('active');
    })

    // $('.pop-out .pop-out-cont').on('click',function(e){
    //   e.stopPropagation();
    // })


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