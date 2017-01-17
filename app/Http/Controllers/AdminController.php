<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(Request $request) {
        if(session('uid') > 0) {
            return redirect()->action('AdminController@dashboard');
        }
        $_params = $request->all();
        return view('admin.index', ['title' => '亲缘后台管理系统']);
    }

    public function dashboard() {
        return view('admin.dashboard', ['title' => '仪表盘']);
    }

    public function personal() {
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/123/',
                    json_encode(['token' => session('token'), 'fid' => session('uid')])
                );
        // var_dump($_result);
        return view('admin.personal', ['title' => '个人资料', 'data' => $_result['data'][0]]);
    }

    public function help() {
        return view('admin.help', ['title' => '帮助中心']);
    }

    public function message() {
        return view('admin.message', ['title' => '通知']);
    }

    public function forgot_one() {
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/105/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'mobile' => ''])
                );
        return view('admin.forgot', ['title' => '通知']);
    }

    public function forgot_two() {
        return view('admin.forgot', ['title' => '通知']);
    }

    public function forgot_three() {
        return view('admin.forgot', ['title' => '通知']);
    }

    public function login(Request $request) {
        $_params = $request->all();
        // ['uname' => '13000000000', 'upasswd' => md5(md5('123123').'aiya')]
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/100/',
                    json_encode(['uname' => $_params['uname'], 'upasswd' => md5(md5($_params['upasswd']).'aiya')])
                );
        $_customer = curlPost(
                    'http://120.25.218.156:12001/info/123/',
                    json_encode(['token' => $_result['data'][0]['token'], 'fid' => $_result['data'][0]['uid']])
                );
        $_result['data'][0]['uname'] = isset($_customer['data'][0]['uname'])?$_customer['data'][0]['uname']:'匿名';
        if($_result['ok'] === true) {
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
                'data' => array(),
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
}
