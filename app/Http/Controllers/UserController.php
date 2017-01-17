<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/126/',
                    json_encode(['token' => session('token'), 'pageno' => '1', 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('user.index', ['title' => '用户中心']);
    }

    public function lock(Request $request) {
        $_params = $request->all();
        return view('user.lock', ['title' => '用户锁定']);
    }
}
