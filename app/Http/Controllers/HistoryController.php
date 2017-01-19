<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class HistoryController extends Controller
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
                    'http://120.25.218.156:12001/info/105/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'pageno' => $_params['page'], 'pagenum' => '3'])
                );
        // var_dump($_result);
        return view('history.index', ['title' => ' 史料', 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/3), 'data' => $_result['data']]);
    }

    public function add() {
        return view('history.add', ['title' => ' 增加']);
    }

    public function create(Request $request) {
        $_params = $request->all();
        $files = $request->file('picurl');
        $_urlist = '';
        // foreach ($files as $file) {
        // $entension = $file->getClientOriginalExtension();
        //     if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
        //         $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
        //         $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        //         $_urlist .= $_pic['info']['url'];
        //     }
        // }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/104/',
                    json_encode(['token' => session('token'), 'title' => $_params['title'], 'urlist' => $_urlist, 'content' => $_params['content']])
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
                'message' => '修改失败',
                'data' => array(),
            ]);
    }

    public function del(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/106/',
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
                        'http://120.25.218.156:12001/info/106/',
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
                    'http://120.25.218.156:12001/info/107/',
                    json_encode(['token' => session('token'), 'keyword' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '3'])
                );
        // var_dump($_result);
        return view('history.index', ['title' => ' 史料', 'total' => $_result['totalpage'], 'keyword' => $_params['keyword'], 'totalpage' => ceil($_result['totalpage']/3), 'data' => $_result['data']]);
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
                    'http://120.25.218.156:12001/info/131/',
                    json_encode(['token' => session('token'), 'pageno' => $_params['page'], 'pagenum' => '3'])
                );
        return view('history.recycle', ['title' => '回收站', 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/3), 'data' => $_result['data']]);
    }

    public function recycleoption(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/132/',
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
                    'http://120.25.218.156:12001/info/130/',
                    json_encode(['token' => session('token'), 'type' => '2', 'id' => $_params['id']])
                );
        // var_dump($_result);
        return view('history.edit', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }

    public function info(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/130/',
                    json_encode(['token' => session('token'), 'type' => '2', 'id' => $_params['id']])
                );
        // var_dump($_result);
        return view('history.info', ['title' => '详情', 'data' => $_result['data'][0]]);
    }

    public function update(Request $request) {
        $_params = $request->all();
        $files = $request->file('picurl');
        $_urlist = '';
        // foreach ($files as $file) {
        // $entension = $file->getClientOriginalExtension();
        //     if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
        //         $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
        //         $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        //         $_urlist .= $_pic['info']['url'];
        //     }
        // }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/104/',
                    json_encode(['token' => session('token'), 'title' => $_params['title'], 'urlist' => $_urlist, 'content' => $_params['content'], 'id' => $_params['id']])
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
                'message' => '修改失败',
                'data' => array(),
            ]);
    }
}
