<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('profile.index', ['title' => '家族简介', 'data' => $_result['data']]);
    }

    public function add(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/100/',
                    json_encode(['token' => session('token'), 'title' => '123', 'content' => '456'])
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
                'message' => '添加失败',
                'data' => array(),
            ]);
    }

    public function update(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/100/',
                    json_encode(['token' => session('token'), 'title' => $_params['title'], 'content' => $_params['content'], 'id' => $_params['id']])
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
                'message' => '添加失败',
                'data' => array(),
            ]);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('profile.edit', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }

    public function info(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('profile.info', ['title' => '详情', 'data' => $_result['data'][0]]);
    }
}
