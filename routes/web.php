<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::get('/register', [MemberController::class, 'create'])->name('register');
Route::post('/register-member', [MemberController::class, 'store'])->name('register.member');
Route::get('/login', [MemberController::class, 'login'])->name('login');
Route::post('/login-member', [MemberController::class, 'auth'])->name('auth');
Route::get('/reset', function () {
    return "testing reset";
})->name('reset');

Route::group(['middleware' => 'admin_auth'], function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::group(['middleware' => 'member_auth'], function(){
    Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');;
    Route::get('/logout', [MemberController::class, 'logout'])->name('member.logout');
});