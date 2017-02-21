<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class TreeController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $rules = [
            'fid' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['fid'] = -1;
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/tree/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => $_params['fid'], 'genetation' => '2'])
                );
        $generation = [];
        foreach ($_result['data'] as $val) {
            if(!in_array($val['generation'], $generation)){
                $generation[] = $val['generation'];
            }
        }
        // var_dump($_result);
        // $_result['data'][5]['pid'] = 16091;
        sort($generation);
        $result = [];
        for($i=0; $i<count($_result['data']); $i++){
            if($_result['data'][$i]['sex'] !=2 && $_result['data'][$i]['sex'] !=3){
                $result[$i] = $_result['data'][$i];
                $result[$i]['mate'] = [];
                // $result[$i]['child'] = [];
                $result[$i]['pidx'] = 0;
                // $_tmp[$result[$i]['uid']] = [];
                foreach ($_result['data'] as $value) {
                    if($value['pid'] == $_result['data'][$i]['uid'] && $value['sex'] ==2 || $value['sex'] ==3){
                        array_push($result[$i]['mate'], $value);
                    }
                    if($value['uid'] == $result[$i]['pid']&& $value['sex'] !=2 && $value['sex'] !=3){
                        $result[$i]['pidx'] = $value['idx'];
                    }
                }
            }
        }
        foreach ($result as $value) {
            usort($value['mate'], function($a, $b) {
                if ($a['idx'] == $b['idx'])
                    return 0;
                return ($a['idx'] > $b['idx']) ? 1 : -1;
            });
        }
        $_generation_p = [];
        foreach ($generation as $val) {
            $_generation_p[$val] = [];
            foreach ($result as $value) {
                if($val == $value['generation']){
                    array_push($_generation_p[$val], $value);
                }
            }
        }
        // $_generation_p['165'][1]['pid'] = 16091;
        // var_dump($_generation_p);
        // foreach ($_generation_p as $value) {
        //     usort($value, function($a, $b) {
        //         if ($a['idx'] == $b['idx'])
        //             return 0;
        //         return ($a['idx'] > $b['idx']) ? 1 : -1;
        //     });
        // }
        // var_dump($_generation_p);
        foreach ($_generation_p as $key => $value) {
            foreach ($value as $k => $val) {
                $pid[$k] = $val['pid'];
                $idx[$k] = $val['idx'];
                $pidx[$k] = $val['pidx'];
            }
            array_multisort($pid, SORT_ASC, $idx, SORT_ASC, $pidx, SORT_ASC, $value);
            unset($pid);
            unset($idx);
            unset($pidx);
            $_data[$key] = $value;
        }
        if($_params['fid'] == -1){
            $current = $_data[$generation[2]];
        }else{
            $current = $_params['fid'];
        }
        // var_dump($_data);
        // for($i=count($generation)-1; $i>0; $i--){
        //     $d = $_generation_p[$generation[$i]];
        //     foreach ($_generation_p[$generation[$i]] as $key => $value) {
        //         foreach ($_generation_p[$generation[$i-1]] as $k => $val) {
        //             if($value['pid'] == $val['uid']){
        //                 $_generation_p[$generation[$i-1]][$k]['child'][] = $value;
        //                 unset($_generation_p[$generation[$i]][$key]);
        //             }
        //         }
        //     }
        // }
        // foreach (array_filter($_generation_p) as $value) {
        //     foreach ($value as $val) {
        //         $_data[] = $val;
        //     }
        // }
        return view('tree.index', ['title' => '家族树', 'data' => $_data, 'current' => $current]);
    }

    public function search(Request $request) {

    }
}
