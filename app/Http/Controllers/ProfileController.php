<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $_params = $request->all();
        return view('profile.index', ['title' => '家族简介']);
    }

    public function edit(Request $request) {
        $_params = $request->all();
        return view('base.edit', ['title' => '编辑']);
    }
}
