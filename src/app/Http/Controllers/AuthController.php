<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function admin()
    {
        return view('admin');
    }

        // 会員登録機能
    public function register(request $request)
    {
        return view('auth.register');
    }

}
