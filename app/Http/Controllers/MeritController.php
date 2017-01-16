<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class MeritController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/117/',
                    json_encode(['token' => session('token'), 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('merit.index', ['title' => '功德榜', 'data' => $_result['data']]);
    }

    public function add(Request $request) {
        $_params = $request->all();
        $file = $request->file('picurl');
        $entension = $file->getClientOriginalExtension();
        if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
            $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/116/',
                    json_encode(['token' => session('token'), 'uname' => '张三', 'addr' => '湖北', 'education' => '本科', 'job' => '暂无', 'money' => '10000', 'avatar' => $_pic['info']['url']])
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
                    'http://120.25.218.156:12001/info/118/',
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
                        'http://120.25.218.156:12001/info/118/',
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
                    'http://120.25.218.156:12001/info/119/',
                    json_encode(['token' => session('token'), 'keyword' => $_params['keyword'], 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('merit.index', ['title' => '功德榜', 'data' => $_result['data'], 'keyword' => $_params['keyword']]);
    }

    public function recycle() {
        return view('merit.recycle', ['title' => '回收站']);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        return view('merit.edit', ['title' => '编辑']);
    }
}
