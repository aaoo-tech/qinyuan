<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TreeController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/tree/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => '15555', 'genetation' => '1'])
                );
        // var_dump($_result);
        return view('tree.index', ['title' => '家族名片']);
    }

    public function search(Request $request) {

    }
}
