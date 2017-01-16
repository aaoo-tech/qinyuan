<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/103/',
                    json_encode(['token' => session('token'), 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('setting.index', ['title' => '设置', 'data' => $_result['data']]);
    }

    public function add(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/102/',
                    json_encode(['token' => session('token'), 'uname' => '张三', 'mobile' => '13697456480'])
                );
        if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '添加管理员用户失败',
                'data' => array(),
            ]);
    }

    public function del(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/104/',
                    json_encode(['token' => session('token'), 'uid' => $_params['uid']])
                );
        if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '删除失败',
                'data' => array(),
            ]);
    }
}
