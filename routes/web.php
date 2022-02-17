<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

/////////////              ADMIN ROUTE START                ///////////

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //////////               Product Related Route Started            //////////

    Route::get('/admin/product/all', [ProductController::class, 'allProduct'])->name('product.all');
    Route::get('/admin/product/add', [ProductController::class, 'addProduct'])->name('product.add');
    Route::post('/admin/product/store', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::post('/admin/product/update', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

    //////////               Product Related Route Ended             //////////

    //////////               User Manage Route Started             //////////

    Route::get('/admin/member/all', [AdminController::class, 'allMember'])->name('member.all');
    Route::get('/admin/member/show/{id}', [AdminController::class, 'showMember'])->name('member.show');
    Route::get('/admin/member/edit/{id}', [AdminController::class, 'editMember'])->name('member.edit');
    Route::post('/admin/member/update/{id}', [AdminController::class, 'updateMember'])->name('member.update');
    Route::get('/admin/member/delete/{id}', [AdminController::class, 'deleteMember'])->name('member.delete');
    Route::get('/admin/member/active', [AdminController::class, 'activeMember'])->name('member.active');
    Route::get('/admin/member/inactive', [AdminController::class, 'inactiveMember'])->name('member.inactive');
    Route::get('/admin/member/blocked', [AdminController::class, 'blockedMember'])->name('member.blocked');
    Route::get('/admin/member/expired', [AdminController::class, 'expiredMember'])->name('member.expired');

    Route::get('/admin/member/is-active/{id}', [AdminController::class, 'isActive'])->name('member.is-active');
    Route::get('/admin/member/is-inactive/{id}', [AdminController::class, 'isInActive'])->name('member.is-inactive');
    Route::get('/admin/member/is-blocked/{id}', [AdminController::class, 'isBlocked'])->name('member.is-blocked');

    //////////               User Manage Route Ended             //////////
});

/////////////              ADMIN ROUTE END                ///////////

Route::group(['middleware' => 'member_auth'], function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
    Route::get('/logout', [MemberController::class, 'logout'])->name('member.logout');
    Route::get('/fund/transfer', [MemberController::class, 'transferFund'])->name('fund.transfer');
    Route::get('/fund/add', [MemberController::class, 'addFundReq'])->name('fund.transfer');
    Route::get('/fund/withdraw', [MemberController::class, 'withdrawFund'])->name('fund.transfer');
});
