<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/admin/login','admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class,'logout'])->name('admin.logout');
Route::view('/admin/register', 'admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
Route::view('/admin/home', 'admin/home')->middleware('auth:admin');


Route::prefix('admin')->group(function () {
    // パスワードリセットルート
    Route::get('password/reset', 'App\Http\Controllers\Admin\PasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/email', 'App\Http\Controllers\Admin\PasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'App\Http\Controllers\Admin\PasswordController@showResetForm')->name('admin.password.reset.token');
    Route::post('password/reset', 'App\Http\Controllers\Admin\PasswordController@reset');
});
