<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class FamousController extends Controller
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
                    'http://120.25.218.156:12001/info/109/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('famous.index', ['title' => ' 名人榜', 'data' => $_result['data']]);
    }

    public function add(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/108/',
                    json_encode(['token' => session('token'), 'uname' => '755', 'generation' => '1', 'father' => '1'])
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
                'data' => $_result,
            ]);
    }

    public function update(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/108/',
                    json_encode(['token' => session('token'), 'uname' => $_params['uname'], 'generation' => $_params['generation'], 'father' => $_params['father'], 'id' => $_params['id']])
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
                'data' => $_result,
            ]);
    }

    public function del(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/110/',
                    json_encode(['token' => session('token'), 'id' => $_params['id']])
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

    public function batchdel(Request $request) {
        $_params = $request->all();
        $i = 0;
        foreach ($_params['ids'] as $id) {
            $_result = curlPost(
                        'http://120.25.218.156:12001/info/110/',
                        json_encode(['token' => session('token'), 'id' => $_params['id']])
                    );
            if($_result['ok'] === true) {
                $i++;
            }
        }
        return response()->json([
                'success' => true,
                'message' => '',
                'data' => $i,
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
                    'http://120.25.218.156:12001/info/111/',
                    json_encode(['token' => session('token'), 'keyword' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        return view('famous.index', ['title' => ' 名人榜', 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
    }

    public function recycle(Request $request) {
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
                    'http://120.25.218.156:12001/info/133/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        return view('famous.recycle', ['title' => '回收站', 'data' => $_result['data']]);
    }

    public function recycleoption(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/134/',
                    json_encode(['token' => session('token'), 'optype' => $_params['optype'], 'idlist' => $_params['idlist']])
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

    public function edit(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/139/',
                    json_encode(['token' => session('token'), 'id' => $_params['id']])
                );
        var_dump($_result);
        return view('famous.edit', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }
}
