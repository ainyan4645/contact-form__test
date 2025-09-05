<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

/* 管理ページ */
Route::get('/admin', [ContactController::class, 'admin'])->name('admin.admin');
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
/*
Route::middleware('auth')->group(function () {
Route::get('/admin', [AuthController::class, 'admin']);
});
*/

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});