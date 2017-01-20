<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InfoController extends Controller
{
    public function index($type, $id) {
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/130/',
                    json_encode(['token' => md5('123456'), 'type' => $type, 'id' => $id])
                );
        if($_result['ok'] === true) {
            return view('info.index', ['title' => $type==1?'家族简介':'史料','data' => $_result['data'][0]]);
        }
        return view('info.index', ['title' => $type==1?'家族简介':'史料']);
    }
}
