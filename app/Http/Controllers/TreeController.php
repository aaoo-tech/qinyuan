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
        if(count($_result['data']) <= 0){
            return view('tree.index', ['title' => '家族树', 'data' => [], 'current' => [], 'tree_data_1' => [], 'tree_data_2' => [], 'ancestor' => [], 'back_data' => []]);
        }
        // $_t['pid'] = 16080;
        // $_t['uid'] = 16082;
        // $_t['generation'] = 165;
        // $_t['idx'] = 3;
        // $_t['sex'] = 1;
        // $_t['uname'] = '友全';
        // $_t['pidx'] = '1';
        // $_t['child'] = true;
        // $_t['mate'] = array();
        // $_t['avatar'] = '';
        // array_push($_result['data'], $_t);
        $generation = [];
        foreach ($_result['data'] as $val) {
            if(!in_array($val['generation'], $generation) && $val['sex'] !=2 && $val['sex'] !=3){
                $generation[] = $val['generation'];
            }
        }
        $back_data = $_result['data'];

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
                    if($value['pid'] == $_result['data'][$i]['uid']){
                        if($value['sex'] ==2 || $value['sex'] ==3){
                            array_push($result[$i]['mate'], $value);
                        }
                    }
                    if($value['uid'] == $result[$i]['pid'] && $value['sex'] !=2 && $value['sex'] !=3){
                        $result[$i]['pidx'] = $value['idx'];
                    }
                    if($value['pid'] == $result[$i]['uid'] && $value['sex'] !=2 && $value['sex'] !=3){
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
        // var_dump($_data);
        $current = '';
        if($_params['fid'] == -1){
            // $current = $_data[$generation[2]][0]['uid'];
            if(count($generation) > 2){
                $current = $_data[$generation[2]][0]['uid'];
                foreach ($_data[$generation[2]] as $value) {
                    if($value['child'] === true){
                        $current = $value['uid'];
                    }
                }
            }else{
                $current = $_data[$generation[count($generation)-1]][0]['uid'];
            }
        }else{
            $current = $_params['fid'];
        }
        $_current_generation = '';
        foreach ($_result['data'] as $value) {
            if($value['uid'] == $current){
                $_current_generation = $value['generation'];
            }
        }
        // var_dump($_data[$generation[count($generation)-1]][0]['uid']);
        // var_dump($_data);
        // var_dump(array_search($_current_generation, $generation));
        if($_data[$generation[0]][0]['pid'] == -1){
            $ancestor = $_data[$generation[0]];
            $tree_data_1 = array_slice($_data, 1, array_search($_current_generation, $generation), true);
        }else{
            $ancestor = [];
            $tree_data_1 = array_slice($_data, 0, array_search($_current_generation, $generation)+1, true);
        }
        $_tree_data_2 = array_slice($_data, array_search($_current_generation, $generation)+1);
        $tree_data_2 = [];
        // if(count($_tree_data_2) > 1){
        //     $_count = count($_tree_data_2);
        // }else{
        //     $_count = 2;
        // }
        if(count($_tree_data_2) > 0){
            // for($i=0; $i<$_count-1; $i++){
                foreach ($_tree_data_2[0] as $key => $value) {
                    $_tmp[0][0] = $value;
                    $_tmp[1] = [];
                    if(count($_tree_data_2) > 1){
                        foreach ($_tree_data_2[1] as $k => $val) {
                            if($value['uid'] == $val['pid']){
                                array_push($_tmp[1], $val);
                            }
                        }
                    }
                    array_push($tree_data_2, $_tmp);
                    unset($_tmp);
                }
            // }
        }
        // var_dump($_data);
        // foreach ($tree_data_2 as $key => $value) {
        //     var_dump($value[1]);
        // }
        // var_dump($tree_data_2);
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
        // var_dump($current);
        // return view('tree.index', ['title' => '家族树', 'data' => $_data, 'current' => $current, 'tree_data' => $current]);
        return view('tree.index', ['title' => '家族树', 'data' => $_data, 'current' => $current, 'tree_data_1' => $tree_data_1, 'tree_data_2' => $tree_data_2, 'ancestor' => $ancestor, 'back_data' => $back_data]);

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
        // var_dump($_params['keyword']);
        $_result = curlPost(
                    'http://120.25.218.156:12001/tree/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'sname' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        $_result['totalpage'] = (empty($_result['totalpage']))?0:$_result['totalpage'];
        return view('tree.search', ['title' => ' 史料', 'total' => $_result['totalpage'], 'keyword' => $_params['keyword'], 'totalpage' => ceil($_result['totalpage']/10), 'data' => $_result['data']]);
    }

    public function add() {
        return view('tree.add', ['title' => '添加']);
    }

    public function create(Request $request) {
        $_params = $request->all();
        $rules = [
            'uname' => [
                'required',
            ],
            'father' => [
                'required',
            ],
            'monther' => [
                'required',
            ],
            'idx' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'message' => '失败',
                    'data' => array(),
                ]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/120/',
                    json_encode(['token' => session('token'), 'generation' => $_params['generation'], 'pid' => $_params['pid'], 'uname' => $_params['uname'], 'father' => $_params['father'], 'monther' => $_params['monther'], 'idx' => $_params['idx'], 'sex' => $_params['sex'], 'birthday' => $_params['birthday'], 'death' => $_params['death'], 'addr' => $_params['addr'], 'content' => $_params['content'], 'mobile' => $_params['mobile']])
                );
        // var_dump($_result);
        if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '失败',
                'data' => array(),
            ]);
    }

    public function del(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/121/',
                    json_encode(['token' => session('token'), 'uid' => $_params['uid'], 'upasswd' => md5(md5($_params['upasswd']).'aiya')])
                );
        if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '失败',
                'data' => $_result,
            ]);
    }

    public function update(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/122/',
                    json_encode(['token' => session('token'), 'uid' => $_params['uid'], 'generation' => $_params['generation'], 'pid' => $_params['pid'], 'uname' => $_params['uname'], 'father' => $_params['father'], 'monther' => $_params['monther'], 'idx' => $_params['idx'], 'sex' => $_params['sex'], 'birthday' => $_params['birthday'], 'death' => $_params['death'], 'addr' => $_params['addr'], 'content' => $_params['content'], 'mobile' => $_params['mobile']])
                );
        if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        }
        return response()->json([
                'success' => false,
                'message' => '失败',
                'data' => $_result,
            ]);
    }
}
