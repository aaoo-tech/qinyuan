<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('image.index', ['title' => '家族名片']);
    }

    public function detail(Request $request) {
        $_params = $request->all();
        return view('image.detail', ['title' => '相册名称']);
    }
}
