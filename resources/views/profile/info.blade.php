<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
  <title>家族简介</title>
  <style type="text/css">
    ::-webkit-scrollbar {width: 6px;height:6px;}
    ::-webkit-scrollbar-track-piece{background-color: #eee;margin: -2px;}
    ::-webkit-scrollbar-thumb{background: #aaa;min-height: 150px;min-width: 150px;border-radius: 10px;}
    ::-webkit-scrollbar-thumb:vertical:hover{background: #555555}
    ::-webkit-scrollbar-thumb:horizontal:hover{background: #555555}
    body { font-family: Helvetica, Arial, Microsoft Yahei, sans-serif; font-size: 16px; }
    h1 { margin: 15px 0 10px; text-align: center; font-size: 24px; }
    h2 { margin: 20px 0 10px; font-size: 20px; }
    p { margin: 10px 0; }
    .para { font-size: 16px; line-height: 1.4em; }
    img { width: 100%; height: auto; margin: 10px 0 10px;}
  </style>
</head>
<body>
  <h1><?php echo $data['title'];?></h1>
  <div class="article"><?php echo $data['content'];?></div>
</body>
</html>
