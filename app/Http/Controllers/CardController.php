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

    // public function test(Request $request) {
    //     $_params = $request->all();
    //     $file = $request->file('myfile');
    //     // $clientName = $file->getClientOriginalName();
    //     $entension = $file->getClientOriginalExtension();
    //     // var_dump($file->getMaxFilesize());
    //     // var_dump($file->getMimeType());
    //     if ($request->hasFile('myfile') && $request->file('myfile')->isValid()) {
    //         $_result = $request->file('myfile')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
    //         // var_dump($_result);
    //         // $res = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
    //         // var_dump($res);
    //     }
    //     return response()->json([
    //             'success' => false,
    //             'message' => '',
    //             'data' => array(),
    //         ]);
    // }

    public function index(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/142/',
                    json_encode(['token' => session('token'), 'zid' => session('zid')])
                );
        // var_dump($_result);
        return view('card.index', ['title' => '家族名片', 'data' => $_result['data'][0]]);
    }

    public function picurl(Request $request) {
        $_params = $request->all();
        $_size = json_decode($_params['size'], true);
        // var_dump($_params);
        if ($request->hasFile('picurl') && $request->file('picurl')->isValid()) {
            $file = $request->file('picurl');
            $mimeType = $file->getMimeType();
            $entension = $file->getClientOriginalExtension();
            $_result = $request->file('picurl')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            // $targ_w = 640;
            // $targ_h = 300;
            // $jpeg_quality = 90;
            // var_dump($_size);
            if(!empty($_params['size'])){
                $_image_size = getimagesize($_result->getpathName());
                $_x_scale = $_image_size[0]/400;
                $_scale = $_image_size[0]/$_image_size[1];
                $_y_scale = $_image_size[1]/(400/$_scale);
                $t = cut_img(['type' => $entension, 'original_image' => $_result->getpathName(), 'path' => 'storage/uploads/cut-'.$_result->getfileName(), 'x' => $_size['x']*$_x_scale, 'y' => $_size['y']*$_y_scale, 'w' => $_size['w']*$_x_scale, 'h' => $_size['h']*$_y_scale, 'targ_w' => $_size['w']*$_x_scale, 'targ_h' => $_size['h']*$_y_scale]);
                if($t === false){
                    return response()->json([
                            'success' => false,
                            'message' => '图片剪切失败',
                            'data' => array(),
                        ]);
                }
                $_pic = AliyunOss::ossUploadFile(['filename' => 'cut-'.$_result->getfileName(), 'filepath' => 'storage/uploads/cut-'.$_result->getfileName()]);
            }else{
                $_pic = AliyunOss::ossUploadFile(['filename' => 'cut-'.$_result->getfileName(), 'filepath' => $_result->getpathName()]);
            }
        }else{
            return response()->json([
                    'success' => false,
                    'message' => '上传图片失败',
                    'data' => array(),
                ]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/101/',
                    json_encode(['token' => session('token'), 'zid' => session('zid'), 'picurl' => 'http://img.aiyaapp.com/jiapu/'.basename($_pic['info']['url'])])
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
                'message' => '修改失败',
                'data' => $_result,
            ]);
    }

    public function avatar(Request $request) {
        $_params = $request->all();
        $_size = json_decode($_params['size'], true);
        $file = $request->file('avatar');
        $entension = $file->getClientOriginalExtension();
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $_result = $request->file('avatar')->move('storage/uploads', md5(uniqid($file->getfileName(), true)).'.'.$entension);
            // $_pic = AliyunOss::ossUploadFile(['filename' => $_result->getfileName(), 'filepath' => $_result->getpathName()]);
            if(!empty($_params['size'])){
                $_image_size = getimagesize($_result->getpathName());
                $_x_scale = $_image_size[0]/300;
                $_scale = $_image_size[0]/$_image_size[1];
                $_y_scale = $_image_size[1]/(300/$_scale);
                $t = cut_img(['type' => $entension, 'original_image' => $_result->getpathName(), 'path' => 'storage/uploads/cut-'.$_result->getfileName(), 'x' => $_size['x']*$_x_scale, 'y' => $_size['y']*$_y_scale, 'w' => $_size['w']*$_x_scale, 'h' => $_size['h']*$_y_scale, 'targ_w' => $_size['w']*$_x_scale, 'targ_h' => $_size['h']*$_y_scale]);
                if($t === false){
                    return response()->json([
                            'success' => false,
                            'message' => '图片剪切失败',
                            'data' => array(),
                        ]);
                }
                $_pic = AliyunOss::ossUploadFile(['filename' => 'cut-'.$_result->getfileName(), 'filepath' => 'storage/uploads/cut-'.$_result->getfileName()]);
            }else{
                $_pic = AliyunOss::ossUploadFile(['filename' => 'cut-'.$_result->getfileName(), 'filepath' => $_result->getpathName()]);
            }
        }else{
            return response()->json([
                    'success' => false,
                    'message' => '上传图片失败',
                    'data' => array(),
                ]);
        }
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/102/',
                    json_encode(['token' => session('token'), 'zid' => session('zid'), 'avatar' => 'http://img.aiyaapp.com/jiapu/'.basename($_pic['info']['url'])])
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
                'message' => '修改失败',
                'data' => array(),
            ]);
    }

    public function zuname(Request $request) {
        $_params = $request->all();
        $_result = curlPost(
                    'http://120.25.218.156:12001/info/103/',
                    json_encode(['token' => session('token'), 'zid' => session('zid'), 'zuname' => $_params['zuname'], 'zcnt' => $_params['zcnt']])
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
                'message' => '修改失败',
                'data' => $_result,
            ]);
    }
}
