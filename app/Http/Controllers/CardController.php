<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\AliyunOss;

use \Cache;

class CardController extends Controller
{
    // public function index(Request $request) {
    //     $_params = $request->all();
    //     // Session::set('lifetime', 1);
    //     // session(['key' => 'value']);
    //     Cache::put('code', '23333', 10);
    //     // var_dump($request->session()->all());
    //     $res = AliyunOss::ossUploadFile(['filename' => 'test_logo_3.png', 'filepath' => base_path().'/app/Helpers/oss/test_logo.png']);
    //     var_dump($res);
    //     return view('card.index', ['title' => '家族名片']);
    // }

    public function test(Request $request) {
        $_params = $request->all();
        $file = $request->file('myfile');
        // $clientName = $file->getClientOriginalName();
        $entension = $file->getClientOriginalExtension();
        // var_dump($file->getMaxFilesize());
        // var_dump($file->getMimeType());
        if ($request->hasFile('myfile') && $request->file('myfile')->isValid()) {
            $_result = $request->file('myfile')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            var_dump($_result);
            // $res = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
            // var_dump($res);
        }
        return response()->json([
                'success' => false,
                'message' => '',
                'data' => array(),
            ]);
    }

    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'ztype' => '1'])
                );
        // var_dump($_result);
        return view('card.index', ['title' => '家族名片']);
    }

    public function picurl(Request $request) {
        $_params = $request->all();
        $file = $request->file('picurl');
        $entension = $file->getClientOriginalExtension();
        if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
            $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/102/',
                    json_encode(['token' => session('token'), 'zid' => session('zid'), 'picurl' => $_pic['info']['url']])
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

    public function avatar(Request $request) {
        $_params = $request->all();
        $file = $request->file('avatar');
        $entension = $file->getClientOriginalExtension();
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $_result = $request->file('avatar')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/102/',
                    json_encode(['token' => session('token'), 'zid' => session('zid'), 'avatar' => $_pic['info']['url']])
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
