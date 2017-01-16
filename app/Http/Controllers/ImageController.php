<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/111/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'fid' => '1'])
                );
        var_dump($_result);
        return view('image.index', ['title' => '家族名片']);
    }

    public function createdir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'fid' => '1'])
                );
    }

    public function deldir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/101/',
                    json_encode(['token' => session('token'), 'id' => $_params['id'], 'did' => $_params['did']])
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

    public function udpatedir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/102/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => '1', 'ftype' => '1', 'fname' => '233', 'jurisdiction' => '1'])
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

    public function uploadfile(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/103/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'owner' => '1', 'did' => '1', 'url' => 'http', 'desc' => '123', 'jurisdiction' => '1'])
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
                'message' => '上传失败',
                'data' => array(),
            ]);
    }

    public function detail(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/104/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'did' => '1', 'type' => '0', 'pageno' => '1', 'pagenum' => '10'])
                );
        return view('image.detail', ['title' => '相册名称', 'data' => $_result['data']]);
    }

    public function delfile(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/105/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => '1'])
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

    public function video(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/110/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'fid' => '1', 'pageno' => '1', 'pagenum' => '10'])
                );
    }
}
