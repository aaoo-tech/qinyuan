<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ChampionController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('champion.index', ['title' => ' 状元榜']);
    }

    public function recycle() {
        return view('champion.recycle', ['title' => '回收站']);
    }
}
