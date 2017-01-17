<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $rules = [
            'page' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['page'] = '1';
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/126/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('user.index', ['title' => '用户中心', 'totalpage' => $_result['totalpage'], 'data' => $_result['data']]);
    }

    public function lock(Request $request) {
        $_params = $request->all();
        $rules = [
            'page' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['page'] = '1';
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/127/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        return view('user.lock', ['title' => '用户锁定', 'totalpage' => $_result['totalpage'], 'data' => $_result['data']]);
    }

    public function locked(Request $request) {
        $_params = $request->all();
        var_dump($_params);
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/129/',
                    json_encode(['token' => session('token'), 'uid' => $_params['id'], 'lockflag' => $_params['lockflag']])
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
                'message' => '失败',
                'data' => $_result,
            ]);
    }

    public function search(Request $request) {
        $_params = $request->all();
        $rules = [
            'keyword' => [
                'required',
            ],
            'page' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['keyword'] = '';
        }
        if ($validator->fails()) {
            $_params['page'] = '1';
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/128/',
                    json_encode(['token' => session('token'), 'uname' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        var_dump($_result);
        return view('user.index', ['title' => ' 史料', 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
    }
}
