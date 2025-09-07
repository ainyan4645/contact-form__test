<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        // ユーザー作成は Fortify の CreateNewUser に任せる
        $user = app(CreateNewUser::class)->create($request->only([
            'name', 'email', 'password'
        ]));

        // 自動ログインせずにログイン画面へリダイレクト
        return redirect()->route('login');
    }
}
