<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HistoryController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('history.index', ['title' => ' 史料']);
    }

    public function recycle() {
        return view('history.recycle', ['title' => '回收站']);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        return view('base.edit', ['title' => '编辑']);
    }
}
