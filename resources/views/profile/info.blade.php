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
  </style>
</head>
<body>
  <?php echo $data['title'];?>
  <?php echo $data['content']; ?>
</body>
</html>
