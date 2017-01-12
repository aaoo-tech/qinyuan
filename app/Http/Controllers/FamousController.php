<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FamousController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('famous.index', ['title' => ' 名人榜']);
    }

    public function recycle() {
        return view('famous.recycle', ['title' => '回收站']);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        return view('base.edit', ['title' => '编辑']);
    }
}
