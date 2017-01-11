<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MeritController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('merit.index', ['title' => '功德榜']);
    }

    public function recycle() {
        return view('merit.recycle', ['title' => '回收站']);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        return view('base.edit', ['title' => '编辑']);
    }
}
