<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 問い合わせフォーム */
Route::get('/', [ContactController::class, 'contact']);

Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);



/* 会員登録 */
Route::get('/register', function() {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.post'); // 名前はGETと被らないように変更


/* ログイン */
Route::get('/login', function() {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login');


/* 管理画面(会員のみ) */
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin');

// ログアウト
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
// Route::post('/logout', function () {
//     auth()->logout();
//     return redirect()->route('login');
// })->middleware('auth')->name('logout');


/* 管理ページ */
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('contacts.destroy');
/*
Route::middleware('auth')->group(function () {
Route::get('/admin', [AuthController::class, 'admin']);
});
*/