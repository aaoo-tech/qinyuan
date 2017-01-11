<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('admin.index', ['title' => '亲缘后台管理系统']);
    }

    public function dashboard() {
        return view('admin.dashboard', ['title' => '仪表盘']);
    }

    public function personal() {
        return view('admin.personal', ['title' => '个人资料']);
    }

    public function help() {
        return view('admin.help', ['title' => '帮助中心']);
    }

    public function message() {
        return view('admin.message', ['title' => '通知']);
    }

    public function forgot() {
        return view('admin.forgot', ['title' => '通知']);
    }

    public function logout() {
        return redirect()->action('AdminController@index');
    }
}
