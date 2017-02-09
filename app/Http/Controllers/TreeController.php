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
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => -1, 'genetation' => '1'])
                );
        $generation = [];
        foreach ($_result['data'] as $val) {
            if(!in_array($val['generation'], $generation)){
                $generation[] = $val['generation'];
            }
        }
        var_dump($_result);
        sort($generation);

        $_g_p = [];
        foreach ($generation as $val) {
            $_g_p[$val] = [];
            foreach ($_result['data'] as $value) {
                if($val == $value['generation']){
                    array_push($_g_p[$val], $value);
                }
            }
        }
        // var_dump($_g_p);

        // usort($_g_p, function($a, $b) {
        //     if ($a['idx'] == $b['idx'])
        //         return 0;
        //     return ($a['idx'] > $b['idx']) ? -1 : 1;
        // });
        // var_dump($_g_p);
        // for($i=0; $i<count($_result['data']); $i++){
        //     if($_result['data'][$i]['pid'] = )
        // }
        return view('tree.index', ['title' => '家族名片']);
    }

    public function search(Request $request) {

    }
}
