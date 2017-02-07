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
        if(isset($_result['data'])){
            foreach ($_result['data'] as $value) {
                if($value['islock'] == 0) {
                    $result[] = $value;
                }
            }
        }
        return view('user.index', ['title' => '用户中心', 'total' => count($result), 'totalpage' => ceil(count($result)/10), 'data' => $result]);
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
        return view('user.lock', ['title' => '用户锁定', 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/10), 'data' => $_result['data']]);
    }

    public function locked(Request $request) {
        $_params = $request->all();
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
                'data' => array(),
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
            if(isset($validator->failed()['keyword'])){
                $_params['keyword'] = '';
            }
            if(isset($validator->failed()['page'])){
                $_params['page'] = '1';
            }
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/128/',
                    json_encode(['token' => session('token'), 'uname' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('user.index', ['title' => ' 史料', 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/10), 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
    }
}
