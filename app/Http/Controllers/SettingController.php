<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('setting.index', ['title' => '设置']);
    }
}
