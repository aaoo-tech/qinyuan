<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class ChampionController extends Controller
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
                    'http://120.25.218.156:12001/info/113/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('champion.index', ['title' => '状元榜', 'data' => $_result['data']]);
    }

    public function add() {
        return view('champion.add', ['title' => ' 增加']);
    }

    public function create(Request $request) {
        $_params = $request->all();
        // $file = $request->file('picurl');
        // $entension = $file->getClientOriginalExtension();
        // if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
        //     $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
        //     $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        // }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/112/',
                    json_encode(['token' => session('token'), 'uname' => $_params['uname'], 'addr' => $_params['addr'], 'education' => $_params['education'], 'job' => $_params['job'], 'workplace' => $_params['workplace'], 'avatar' => ''])
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
        // $file = $request->file('picurl');
        // $entension = $file->getClientOriginalExtension();
        // if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
        //     $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
        //     $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        // }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/112/',
                    json_encode(['token' => session('token'), 'uname' => $_params['uname'], 'addr' => $_params['addr'], 'education' => $_params['education'], 'job' => $_params['job'], 'workplace' => $_params['workplace'], 'avatar' => '', 'id' => $_params['id']])
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

    public function del(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/114/',
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
                        'http://120.25.218.156:12001/info/114/',
                        json_encode(['token' => session('token'), 'id' => $id])
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
                    'http://120.25.218.156:12001/info/115/',
                    json_encode(['token' => session('token'), 'keyword' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        return view('champion.index', ['title' => '状元榜', 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
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
                    'http://120.25.218.156:12001/info/135/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('champion.recycle', ['title' => '回收站', 'data' => $_result['data']]);
    }

    public function recycleoption(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/136/',
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
                    'http://120.25.218.156:12001/info/140/',
                    json_encode(['token' => session('token'), 'id' => $_params['id']])
                );
        // var_dump($_result);
        return view('champion.edit', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }
}
