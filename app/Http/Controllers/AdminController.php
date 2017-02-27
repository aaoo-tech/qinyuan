<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\AliyunOss;

class AdminController extends Controller
{
    public function index(Request $request) {
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'ztype' => '1'])
                );
        if($_result['ok'] === true) {
            return redirect()->action('AdminController@dashboard');
        }
        $_params = $request->all();
        return view('admin.index', ['title' => '亲缘后台管理系统']);
    }

    public function dashboard() {
        return view('admin.dashboard', ['title' => '仪表盘']);
    }

    public function personal(Request $request) {
        $_params = $request->all();
        $rules = [
            'fid' => [
                'required',
            ],
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails()) {
            $_params['fid'] = session('uid');
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/123/',
                    json_encode(['token' => session('token'), 'fid' => $_params['fid']])
                );
        // var_dump($_result);
        return view('admin.personal', ['title' => '个人资料', 'data' => isset($_result['data'][0])?$_result['data'][0]:$_result['data']]);
    }

    public function help() {
        return view('admin.help', ['title' => '帮助中心']);
    }

    public function message() {
        return view('admin.message', ['title' => '通知']);
    }

    public function forgot() {
        return view('admin.forgot', ['title' => '找回密码']);
    }

    public function forgot_one(Request $request) {
        $_params = $request->all();
        // $_result = curlPost(
        //             'http://120.25.218.156:12001/user/105/',
        //             json_encode(['token' => session('token'), 'uid' => session('uid'), 'mobile' => ''])
        //         );
        // $rules = ['captcha' => 'required|captcha'];
        $rules = [
            'mobile' => [
                'required',
            ],
            'captcha' => [
                'required',
                'captcha',
            ],
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails())
        {
            return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->all(),
                    'data' => array(),
                ]);
        }
        else
        {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        // return view('admin.forgot', ['title' => '通知']);
    }

    public function forgot_two(Request $request) {
        $_params = $request->all();
        $rules = [
            'mobile' => [
                'required',
                'regex:/^1[3|4|5|7|8]\d{9}$/',
            ],
            'authcode' => [
                'required',
            ],
        ];
        $messages = [
            'required' => '此项必须填写',
            'regex' => '请正确填写该项',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            return false;
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/110/',
                    json_encode(['mobile' => $_params['mobile'], 'authcode' => $_params['authcode']])
                );
        if($_result['ok'] === true){
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '',
                'data' => $_result,
            ]);
    }

    public function sendcode(Request $request) {
        $_params = $request->all();
        $rules = [
            'mobile' => [
                'required',
            ],
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/105/',
                    json_encode(['mobile' => $_params['mobile']])
                );
        if($_result['ok'] === true){
            // Cache::put('code_'.$_params['mobile'], $_code, 5);
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '',
                'data' => $_result,
            ]);
    }

    public function verify_code(Request $request) {
        // var_dump(Cache::get('code_13547852147'));
        $rules = [
            'mobile' => [
                'required',
                'regex:/^1[3|4|5|7|8]\d{9}$/',
            ],
            'authcode' => [
                'required',
            ],
        ];
        $messages = [
            'required' => '此项必须填写',
            'regex' => '请正确填写该项',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            return false;
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/110/',
                    json_encode(['mobile' => $_params['mobile'], 'authcode' => $_params['authcode']])
                );
        if($_result['ok'] === true){
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '',
                'data' => $_result,
            ]);
    }

    public function forgot_three(Request $request) {
        $_params = $request->all();
        $rules = [
            'mobile' => [
                'required',
            ],
            'newpassword' => [
                'required',
                'same:repassword'
            ],
             'authcode' => [
                'required',
            ],
            'repassword' => 'required',
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->all(),
                    'data' => array(),
                ]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/109/',
                    json_encode(['mobile' => $_params['mobile'], 'newpasswd' => md5(md5($_params['newpassword']).'aiya'), 'authcode' => $_params['authcode']])
                );
        if($_result['ok'] === true){
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '',
                'data' => $_result,
            ]);
    }

    public function login(Request $request) {
        $_params = $request->all();
        // ['uname' => '13000000000', 'upasswd' => md5(md5('123123').'aiya')]
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/100/',
                    json_encode(['uname' => $_params['uname'], 'upasswd' => md5(md5($_params['upasswd']).'aiya')])
                );
        if($_result['ok'] === true) {
            $_customer = curlPost(
                        'http://120.25.218.156:12001/info/123/',
                        json_encode(['token' => $_result['data'][0]['token'], 'fid' => $_result['data'][0]['uid']])
                    );
            $_result['data'][0]['uname'] = isset($_customer['data'][0]['uname'])?$_customer['data'][0]['uname']:'匿名';
            session($_result['data'][0]);
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => array(),
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '账号密码错误',
                'data' => $_result,
            ]);
    }

    public function logout(Request $request) {
        // $_result = curlPost(
        //             'http://120.25.218.156:12001/user/101/',
        //             json_encode(['token' => session('token')])
        //         );
        // var_dump($_result);
        $request->session()->flush();
        if (!$request->session()->has('token')) {
            return redirect()->action('AdminController@index');
        }
    }

    public function upload(Request $request) {
        $_params = $request->all();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $mimeType = $file->getMimeType();
            $entension = $file->getClientOriginalExtension();
            $_result = $request->file('file')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        }
        return response()->json([
                'error' => false,
                'path' => 'http://img.aiyaapp.com/jiapu/'.basename($_pic['info']['url'])
            ]);
    }
}
