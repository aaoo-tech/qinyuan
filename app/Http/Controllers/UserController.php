<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('user.index', ['title' => '用户中心']);
    }
}
