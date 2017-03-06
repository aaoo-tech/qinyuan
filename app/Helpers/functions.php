<?php
/**
 * 获取当前控制器与方法
 *
 * @return array
 */
if(!function_exists('getCurrentAction')) {
    function getCurrentAction() {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = strtolower(str_replace('Controller', '', substr(strrchr($class,'\\'),1)));

        return ['controller' => $class, 'method' => $method];
    }
}


/**
 * 获取当前控制器名
 *
 * @return string
 */
if(!function_exists('getCurrentControllerName')) {
    function getCurrentControllerName() {
        return getCurrentAction()['controller'];
    }
}


/**
 * 获取当前方法名
 *
 * @return string
 */
if(!function_exists('getCurrentMethodName')) {
    function getCurrentMethodName() {
        return getCurrentAction()['method'];
    }
}


/**
 * php curl 发送post请求
 *
 * @return data
 */
if(!function_exists('curlPost')) {
    function curlPost($url, $_params) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$_params);
        curl_setopt($ch,CURLOPT_TIMEOUT_MS,30000);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Expect:',
            'Content-Length: ' . strlen($_params))
        ); 
        $_result = curl_exec($ch);
        curl_close($ch);
        //reject overly long 2 byte sequences, as well as characters above U+10000 and replace with ?
        $_result = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
         '|[\x00-\x7F][\x80-\xBF]+'.
         '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
         '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
         '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
         '?', $_result );
         
        //reject overly long 3 byte sequences and UTF-16 surrogates and replace with ?
        $_result = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]'.
         '|\xED[\xA0-\xBF][\x80-\xBF]/S','?', $_result );
        return json_decode($_result, true);
    }
}


/**
 * 导航
 *
 * @return array
 */
if(!function_exists('navdata')) {
    function navdata() {
        return [
            "card" => ["index" => "家族名片"],
            "profile" => ["index" => "家族简介", "edit" => "编辑"],
            "history" => ["index" => "史料", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索", "add" => "增加"],
            "famous" => ["index" => "名人榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索", "add" => "增加"],
            "champion" => ["index" => "状元榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索", "add" => "增加"],
            "tree" => ["index" => "家族树", "search" => "搜索", "add" => "增加"],
            "image" => ["index" => "影像中心", "upload" => "上传影像", "detail" => "相册详情", "adddir" => "创建相册", "editdir" => "编辑相册", "search" => "搜索"],
            "merit" => ["index" => "功德榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索", "add" => "增加"],
            "user" => ["index" => "用户", "lock" => "锁定", "search" => "搜索"],
            "setting" => ["index" => "设置"]
        ];
    }
}


/**
 * breadcrumb 面包屑
 *
 * @return html
 */
if(!function_exists('breadcrumb')) {
    function breadcrumb() {
        if(getCurrentMethodName() == 'index') {
            echo '<i class="iconfont icon-home"></i><a href="/dashboard">家族中心</a><span>'. navdata()[getCurrentControllerName()]['index'] .'</span>';
        }elseif(getCurrentControllerName() == 'image'){
            if(!empty($_GET['uid'])){
                echo '<i class="iconfont icon-home"></i><a href="/dashboard">家族中</a><a href = "/'. getCurrentControllerName() .'?uid='. $_GET['uid'] .'">'. navdata()[getCurrentControllerName()]['index'] .'</a><span>'. navdata()[getCurrentControllerName()][getCurrentMethodName()] .'</span>';
            }else{
                echo '<i class="iconfont icon-home"></i><a href="/dashboard">家族中心</a><a href = "/'. getCurrentControllerName() .'">'. navdata()[getCurrentControllerName()]['index'] .'</a><span>'. navdata()[getCurrentControllerName()][getCurrentMethodName()] .'</span>';
            }
        }else{
            echo '<i class="iconfont icon-home"></i><a href="/dashboard">家族中心</a><a href = "/'. getCurrentControllerName() .'">'. navdata()[getCurrentControllerName()]['index'] .'</a><span>'. navdata()[getCurrentControllerName()][getCurrentMethodName()] .'</span>';
        }
    }
}

/**
 * 初始化图片
 *
 * @return object
 */
if(!function_exists('initi_img')) {
    function initi_img($type, $srcimg) {
        switch ($type) {
            case 'jpg':
                return imagecreatefromjpeg($srcimg);
                break;
            case 'gif':
                return imagecreatefromgif($srcimg);
                break;
            case 'png':
                return imagecreatefrompng($srcimg);
                break;
            case 'bmp':
                return imagecreatefrombmp($srcimg);
                break;
            default:
                return false;
                break;
        }
    }
}

/**
 * 生成保存图片
 *
 * @return object
 */
if(!function_exists('new_img')) {
    function new_img($type, $dst_r, $path) {
        switch ($type) {
            case 'jpg':
                return imagejpeg($dst_r, $path);
                break;
            case 'gif':
                return imagegif($dst_r, $path);
                break;
            case 'png':
                return imagepng($dst_r, $path);
                break;
            case 'bmp':
                return imagebmp($dst_r, $path);
                break;
            default:
                return false;
                break;
        }
    }
}

/**
 * 剪切图片
 *
 * @return object
 */
if(!function_exists('cut_img')) {
    function cut_img($_params) {
        $img_r = initi_img($_params['type'], $_params['original_image']);
        if($img_r === false){
            return false;
        }
            // $targ_w = 640;
            // $targ_h = 300;
        $dst_r = ImageCreateTrueColor($_params['targ_w'], $_params['targ_h']);
        imagecopyresampled($dst_r, $img_r, 0, 0, $_params['x'], $_params['y'], $_params['targ_w'], $_params['targ_h'], $_params['w'], $_params['h']);
        $t = new_img($_params['type'], $dst_r, $_params['path']);
        imagedestroy($img_r);
        imagedestroy($dst_r);
        return $t;
    }
}