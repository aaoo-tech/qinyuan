<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="renderer" content="webkit">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>404 - 亲缘</title>
      <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_ds1jqxkqnneqxgvi.css">
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/rest.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
      <script type="text/javascript" src="{{ asset('/js/jquery-2.1.4.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/js/jquery.cookie.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/js/utility.js') }}"></script>
    </head>
    <body class="error">
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        500
      </div>
    </div>
    <script type="text/javascript">
      (function($) {
          $(function() {
            window.location.href = "/dashboard";
          });
      })(jQuery);
    </script>
  </body>
</html>