<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InfoController extends Controller
{
    public function index($type, $id) {
        // $_params = $request->all();
        // var_dump($type);
        // var_dump($id);
        // var_dump(session('token'));
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/130/',
                    json_encode(['token' => session('token'), 'type' => $type, 'id' => $id])
                );
        // var_dump($_result);
        return view('info.index', ['data' => $_result['data'][0]]);
    }
}
