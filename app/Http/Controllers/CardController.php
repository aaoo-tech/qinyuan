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
    public function index(Request $request) {
        $_params = $request->all();
        return view('card.index', ['title' => '家族名片']);
    }
}
