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
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($_params))
        ); 
        $_result = curl_exec($ch);
        curl_close($ch);
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
            "history" => ["index" => "史料", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索"],
            "famous" => ["index" => "名人榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索"],
            "champion" => ["index" => "状元榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索"],
            "tree" => ["index" => "家族树"],
            "image" => ["index" => "影像中心", "detail" => "相册详情"],
            "merit" => ["index" => "功德榜", "recycle" => "回收站", "edit" => "编辑", "search" => "搜索"],
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
            echo '<a href="/dashboard"><i class="iconfont icon-home"></i>家族中心</a><span>'. navdata()[getCurrentControllerName()]['index'] .'</span>';
        }else{
            echo '<a href="/dashboard"><i class="iconfont icon-home"></i>家族中心</a><a href = "/'. getCurrentControllerName() .'">'. navdata()[getCurrentControllerName()]['index'] .'</a><span>'. navdata()[getCurrentControllerName()][getCurrentMethodName()] .'</span>';
        }
    }
}
