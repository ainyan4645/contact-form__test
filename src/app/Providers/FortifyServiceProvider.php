<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 会員登録処理
        Fortify::createUsersUsing(CreateNewUser::class);

        // 登録ページ
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログインページ
        Fortify::loginView(function () {
                return view('auth.login');
            });

        // ログイン後は管理画面へ
        Fortify::authenticateUsing(function ($request) {
            // ログイン処理に LoginRequest を適用
            app(LoginRequest::class)->validateResolved();
            // ユーザ取得
            $user = User::where('email', $request->email)->first();
            // パスワードチェック
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null; // 認証失敗時
        });
    }
}
