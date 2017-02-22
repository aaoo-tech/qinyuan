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
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => 17059, 'genetation' => '2'])
                );
        $generation = [];
        foreach ($_result['data'] as $val) {
            if(!in_array($val['generation'], $generation)){
                $generation[] = $val['generation'];
            }
        }

        sort($generation);

        $result = [];
        for($i=0; $i<count($_result['data']); $i++){
            if($_result['data'][$i]['sex'] !=2 && $_result['data'][$i]['sex'] !=3){
                $result[$i] = $_result['data'][$i];
                $result[$i]['mate'] = [];
                $result[$i]['child'] = false;
                $result[$i]['pidx'] = 0;
                // $_tmp[$result[$i]['uid']] = [];
                foreach ($_result['data'] as $value) {
                    if($value['pid'] == $_result['data'][$i]['uid'] && $value['sex'] ==2 || $value['sex'] ==3){
                        array_push($result[$i]['mate'], $value);
                    }
                    if($value['uid'] == $result[$i]['pid']&& $value['sex'] !=2 && $value['sex'] !=3){
                        $result[$i]['pidx'] = $value['idx'];
                    }
                    if($value['pid'] == $result[$i]['uid']&& $value['sex'] !=2 && $value['sex'] !=3){
                        $result[$i]['child'] = true;
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

        // 取祖先代数
        $ancestor_g = array_shift($generation);
        foreach ($result as $value) {
            // 取祖先
            if($ancestor_g == $value['generation']){
                $ancestor = $value;
            }
            //取当前代数
            if($value['uid'] == 17059){
                $generation_a = $value['generation'];
            }
        }
        // 父级（包括自己）
        $generation_p = [];
        // 子级（只有二代）
        $generation_c = [];
        foreach ($generation as $val) {
            if($val <= $generation_a){
                $generation_p[$val] = [];
                foreach ($result as $value) {
                    if($val == $value['generation']){
                        array_push($generation_p[$val], $value);
                    }
                }
            }else{
                $i = $val - $generation_a;
                $generation_c[$i] = [];
                foreach ($result as $value) {
                    if($val == $value['generation']){
                        array_push($generation_c[$i], $value);
                    }
                }
            }
        }
        // tree前部分所需数据
        $tree_data_1= $generation_p;
        // tree后部分所需数据
        $tree_data_2 = [];
        foreach($generation_c[1] as $p_4) {
            $t=[];
            $g_4=[$p_4];
            $g_5=[];
            foreach($generation_c[2] as $p_5) {
                if($p_4['uid'] == $p_5['pid']){
                    array_push($g_5, $p_5);
                }
            }
            $t[0]=$g_4;
            $t[1]=$g_5;
            array_push($tree_data_2,$t);
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
            $current = $_data[$generation[2]][0]['uid'];
        }else{
            $current = $_params['fid'];
        }

        return view('tree.index', ['title' => '家族树', 'data' => $_data, 'current' => $current, 'tree_data_1' => $tree_data_1, 'tree_data_2' => $tree_data_2, 'ancestor' => $ancestor]);
    }

    public function search(Request $request) {
        $_params = $request->all();
        $rules = [
            'keyword' => [
                'required',
            ],
            'page' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            if(isset($validator->failed()['keyword'])){
                $_params['keyword'] = ' ';
            }
            if(isset($validator->failed()['page'])){
                $_params['page'] = '1';
            }
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/tree/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'sname' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        var_dump($_result);
        $_result['totalpage'] = (empty($_result['totalpage']))?0:$_result['totalpage'];
        return view('tree.search', ['title' => ' 史料', 'total' => $_result['totalpage'], 'keyword' => $_params['keyword'], 'totalpage' => ceil($_result['totalpage']/10), 'data' => $_result['data']]);
    }
}
