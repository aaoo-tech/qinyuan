<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\AliyunOss;

class ImageController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        $rules = [
            'uid' => [
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
            if(isset($validator->failed()['uid'])){
                $_params['uid'] = session('uid');
            }
            if(isset($validator->failed()['page'])){
                $_params['page'] = '1';
            }
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/102/',
                    json_encode(['token' => session('token'), 'uid' => $_params['uid'], 'zid' => session('zid'), 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        $_result['totalpage'] = (empty($_result['totalpage']))?0:$_result['totalpage'];
        return view('image.index', ['title' => '家族名片', 'data' => $_result['data'], 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/10)]);
    }

    public function search(Request $request) {
        $_params = $request->all();
        $rules = [
            'keyword' => [
                'required',
            ],
            'page' => [
                'required',
            ],
            'uid' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            if(isset($validator->failed()['keyword'])){
                $_params['keyword'] = '';
            }
            if(isset($validator->failed()['page'])){
                $_params['page'] = '1';
            }
            if(isset($validator->failed()['uid'])){
                $_params['uid'] = session('uid');
            }
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/143/',
                    json_encode(['token' => session('token'), 'uid' => $_params['uid'], 'zid' => session('zid'), 'did' => 0, 'keyword' => $_params['keyword'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        $_result['totalpage'] = (empty($_result['totalpage']))?0:$_result['totalpage'];
        return view('image.index', ['title' => ' 史料', 'total' => $_result['totalpage'], 'keyword' => $_params['keyword'], 'totalpage' => ceil($_result['totalpage']/10), 'data' => $_result['data']]);
    }

    public function adddir(Request $request) {
        return view('image.adddir', ['title' => ' 增加']);
    }

    public function createdir(Request $request) {
        $_params = $request->all();
        $rules = [
            'uid' => [
                'required',
            ],
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails()) {
            $_params['uid'] = session('uid');
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'owner' => $_params['uid'], 'pid' => '0', 'dirname' => $_params['dirname'], 'type' => $_params['type'], 'jurisdiction' => $_params['jurisdiction']])
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
                'data' => array(),
            ]);
    }

    public function deldir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/101/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'did' => $_params['did']])
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
                'message' => '删除失败',
                'data' => array(),
            ]);
    }

    public function editdir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/111/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'fid' => $_params['did']])
                );
        // var_dump($_result);
        return view('image.editdir', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }

    public function udpatedir(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/102/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => $_params['did'], 'ftype' => '1', 'fname' => $_params['fname']])
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
                'message' => '修改失败',
                'data' => array(),
            ]);
    }

    public function upload(Request $request) {
        return view('image.upload', ['title' => '编辑']);
    }

    public function uploadfile(Request $request) {
        $_params = $request->all();
        $rules = [
            'uid' => [
                'required',
            ],
        ];
        $validator = Validator::make($_params, $rules);
        if ($validator->fails()) {
            $_params['uid'] = session('uid');
        }
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $mimeType = $file->getMimeType();
            $entension = $file->getClientOriginalExtension();
            $_result = $request->file('file')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/103/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'owner' => $_params['uid'], 'did' => $_params['did'], 'desc' => $_params['desc'], 'url' => 'http://img.aiyaapp.com/jiapu/'.basename($_pic['info']['url']), 'jurisdiction' => '2'])
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
                'message' => '上传失败',
                'data' => array(),
            ]);
    }

    public function detail(Request $request) {
        $_params = $request->all();
        $rules = [
            'page' => [
                'required',
            ]
        ];
        $messages = [
            'required' => '必须填写',
        ];
        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            $_params['page'] = '1';
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/dir/104/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'did' => $_params['did'], 'pageno' => $_params['page'], 'pagenum' => '10'])
                );
        // var_dump($_result);
        return view('image.detail', ['title' => '相册名称', 'data' => $_result['data'], 'total' => $_result['totalpage'], 'totalpage' => ceil($_result['totalpage']/10)]);
    }

    public function editfile(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/144/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => $_params['fid']])
                );
        return view('image.editfile', ['title' => '编辑', 'data' => $_result['data'][0]]);
    }

    public function updatefile(Request $request) {
        $_params = $request->all();
        foreach ($_params['fids'] as $val) {
            $_result = curlPost(
                        'http://120.25.218.156:12001/info/145/',
                        json_encode(['token' => session('token'), 'uid' => session('uid'), 'did' => $val, 'desc' => $_params['desc']])
                    );
        }
        // if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        // }
        // return response()->json([
        //         'success' => false,
        //         'message' => '失败',
        //         'data' => array(),
        //     ]);
    }

    public function delfile(Request $request) {
        $_params = $request->all();
        foreach ($_params['fids'] as $val) {
            $_result = curlPost(
                        'http://120.25.218.156:12001/dir/105/',
                        json_encode(['token' => session('token'), 'uid' => session('uid'), 'fid' => $val])
                    );
        }
        // if($_result['ok'] === true) {
            return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $_result,
                ]);
        // }
        // return response()->json([
        //         'success' => false,
        //         'message' => '删除失败',
        //         'data' => array(),
        //     ]);
    }

    public function video(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/center/110/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'fid' => '1', 'pageno' => '1', 'pagenum' => '10'])
                );
    }
}
