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
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        return view('history.index', ['title' => ' 史料', 'pagecount' => ceil(count($_result['data'])/2), 'data' => $_result['data']]);
    }

    public function add(Request $request) {
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
                    json_encode(['token' => session('token'), 'title' => '9', 'urlist' => $_urlist, 'content' => '9'])
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
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['keyword'] = '';
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/107/',
                    json_encode(['token' => session('token'), 'keyword' => $_params['keyword'], 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('history.index', ['title' => ' 史料', 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
    }

    public function recycle() {
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/131/',
                    json_encode(['token' => session('token'), 'pageno' => '1', 'pagenum' => '10'])
                );
        var_dump($_result);
        return view('history.recycle', ['title' => '回收站', 'data' => $_result['data']]);
    }

    public function recycleoption(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/132/',
                    json_encode(['token' => session('token'), 'optype' => '1', 'idlist' => '1,2,3'])
                );
    }

    public function edit(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/130/',
                    json_encode(['token' => session('token'), 'type' => '2', 'id' => $_params['id']])
                );
        var_dump($_result);
        return view('history.edit', ['title' => '编辑']);
    }
}
