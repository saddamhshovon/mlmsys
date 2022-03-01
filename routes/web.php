<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\GenerationController;
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

    //////////               Generation Route             //////////
    Route::get('/admin/hands', [AdminController::class, 'hands'])->name('hands');
    Route::post('/admin/hands-fix', [AdminController::class, 'handsFix'])->name('hands.fix');
    Route::post('/admin/hands-change', [AdminController::class, 'handsChange'])->name('hands.change');
    
    Route::get('/admin/generation', [GenerationController::class, 'index'])->name('generation');
    Route::post('/admin/generation-fix', [GenerationController::class, 'create'])->name('generation.fix');
    Route::get('/admin/generation-delete', [GenerationController::class, 'deleteLevels'])->name('generation.delete');
    
    Route::get('/admin/generation/income', [GenerationController::class, 'indexIncome'])->name('generation.income');
    Route::post('/admin/generation/income-save', [GenerationController::class, 'store'])->name('generation.incsave');
    Route::post('/admin/generation/income-update', [GenerationController::class, 'update'])->name('generation.incupdate');

    //////////               Funds Route             //////////
    Route::get('/admin/funds-tax', [FundController::class, 'fundsTax'])->name('funds.tax');
    Route::post('/admin/funds-tax-fix', [FundController::class, 'fundsTaxFix'])->name('funds.taxfix');
    Route::post('/admin/funds-tax-change', [FundController::class, 'fundsTaxChange'])->name('funds.taxchange');
});

/////////////              ADMIN ROUTE END                ///////////

Route::group(['middleware' => 'member_auth'], function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
    Route::get('/logout', [MemberController::class, 'logout'])->name('member.logout');

    Route::get('/fund/transfer', [FundController::class, 'transferFund'])->name('fund.transfer');
    Route::post('/fund/transfer-request', [FundController::class, 'transferFundRequest'])->name('fund.transfer.request');

    Route::get('/fund/add', [FundController::class, 'addFundReq'])->name('fund.add');
    Route::post('/fund/add-request', [FundController::class, 'store'])->name('fund.addreq');

    Route::get('/fund/withdraw', [FundController::class, 'withdrawFund'])->name('fund.withdraw');
    Route::post('/fund/withdraw-request', [FundController::class, 'withdraw'])->name('fund.withdrawreq');
    
    Route::get('/team/tree/{id}', [MemberController::class, 'teamTree'])->name('team.tree');
});
