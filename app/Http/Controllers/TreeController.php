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
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => session('uid'), 'genetation' => '2'])
                );
        $generation = [];
        foreach ($_result['data'] as $val) {
            if(!in_array($val['generation'], $generation)){
                $generation[] = $val['generation'];
            }
        }
        // var_dump($_result);
        sort($generation);
        $result = [];
        for($i=0; $i<count($_result['data']); $i++){
            if($_result['data'][$i]['sex'] !=2 && $_result['data'][$i]['sex'] !=3){
                $result[$i] = $_result['data'][$i];
                $result[$i]['mate'] = [];
                foreach ($_result['data'] as $value) {
                    if($value['pid'] == $_result['data'][$i]['uid'] && $value['sex'] ==2 || $value['sex'] ==3){
                        array_push($result[$i]['mate'], $value);
                    }
                }
            }
        }
        // var_dump($result);

        $_generation_p = [];
        foreach ($generation as $val) {
            $_generation_p[$val] = [];
            // $_mate = [];
            foreach ($result as $value) {
                if($value['sex'] == 2 || $value['sex'] == 3){
                    array_push($_mate, $value);
                }
                if($val == $value['generation'] && $value['sex'] != 2 && $value['sex'] != 3){
                    array_push($_generation_p[$val], $value);
                }
            }
        }
        // var_dump($_generation_p);

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
