<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>家族简介</title>
  <style type="text/css">
    ::-webkit-scrollbar {width: 6px;height:6px;}
    ::-webkit-scrollbar-track-piece{background-color: #eee;margin: -2px;}
    ::-webkit-scrollbar-thumb{background: #aaa;min-height: 150px;min-width: 150px;border-radius: 10px;}
    ::-webkit-scrollbar-thumb:vertical:hover{background: #555555}
    ::-webkit-scrollbar-thumb:horizontal:hover{background: #555555}
    body { font-family: Helvetica, Arial, Microsoft Yahei, sans-serif; font-size: 14px; color: #27292C; }
    h1 { text-align: center; }
    h2 { font-size: 18px; }
    .article {  }
    .article p { font-size: 16px; line-height: 24px; }
    .article img { width: 100%; height: auto; }
  </style>
  <script type="text/javascript">
    window.onload=function(){
      parent.frameLoad();
    }
  </script>
</head>
<body>
  <h1><?php echo $data['title'];?></h1>
  <div class="article"><?php echo $data['content'];?></div>
</body>
</html>