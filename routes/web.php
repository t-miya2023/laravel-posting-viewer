<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class,'index'])->name('welcome');


Route::get('/address/{zip}',[addressController::class,'address']);

Auth::routes();


Route::view('/admin/login', 'admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');
//Route::view('/admin/register', 'admin/register');
//Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
Route::view('/admin/home', 'admin/home')->middleware('auth:admin');
Route::get('verification/verify', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
/*
Route::prefix('admin')->group(function () {
    // パスワードリセットルート
    Route::get('password/reset', 'App\Http\Controllers\Admin\PasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/email', 'App\Http\Controllers\Admin\PasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'App\Http\Controllers\Admin\PasswordController@showResetForm')->name('admin.password.reset.token');
    Route::post('password/reset', 'App\Http\Controllers\Admin\PasswordController@reset');
});
*/

Route::resource('shops', ShopController::class);
Route::resource('shops.reviews', ReviewController::class)->middleware('auth');
// お店のレビュー一覧ページ
Route::get('/shops/{shop}/reviews', [ReviewController::class, 'shopReviews'])->name('shop.reviews');
Route::get('/dashboard/shops/{shop}/reviews', [AdminReviewController::class, 'shopReviews'])->name('dashboard.shop.reviews')->middleware('admin');
// ユーザーのレビュー一覧ページ
Route::get('/users/{user}/reviews',   [ReviewController::class, 'userReviews'])->name('user.reviews')->middleware('auth');


Route::middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('dashboard');

    Route::resource('dashboard/shops', AdminShopController::class)
        ->middleware('admin')
        ->names([
            'index'   => 'dashboard.shops.index',
            'create'  => 'dashboard.shops.create',
            'store'   => 'dashboard.shops.store',
            'show'    => 'dashboard.shops.show',
            'edit'    => 'dashboard.shops.edit',
            'update'  => 'dashboard.shops.update',
            'destroy' => 'dashboard.shops.destroy',
        ]);

    Route::resource('dashboard/users', AdminUserController::class)
        ->middleware('admin')
        ->names([
            'index'   => 'dashboard.users.index',
            'create'  => 'dashboard.users.create',
            'store'   => 'dashboard.users.store',
            'show'    => 'dashboard.users.show',
            'edit'    => 'dashboard.users.edit',
            'update'  => 'dashboard.users.update',
            'destroy' => 'dashboard.users.destroy',
        ]);

    Route::resource('dashboard/genres', GenreController::class)
        ->only([ 'index' , 'create' , 'store' , 'destroy' ])
        ->middleware('admin')
        ->names([
            'index'   => 'dashboard.genres.index',
            'create'  => 'dashboard.genres.create',
            'store'   => 'dashboard.genres.store',
            'destroy' => 'dashboard.genres.destroy',
        ]);

    Route::resource('dashboard/reviews', AdminReviewController::class)
        ->only([ 'index' , 'destroy' ])
        ->middleware('admin')
        ->names([
            'index'   => 'dashboard.reviews.index',
            'destroy' => 'dashboard.reviews.destroy',
        ]);
});

Route::get('/user/{page}',[MypageController::class,'useredit'])->name('mypage.useredit')->middleware('auth');
Route::post('/user/{page}',[MypageController::class,'update'])->name('mypage.update')->middleware('auth');
Route::resource('mypage', MypageController::class)->except([ 'create' ])->middleware('auth');

Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::resource('shops.menus', MenuController::class)->middleware('admin');

Route::prefix('dashboard')->group(function () {
    Route::post('reviews/toggle-status/{id}', [AdminReviewController::class, 'toggleStatus'])->name('reviews.toggle-status');
});