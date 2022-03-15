<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProductController;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::get('/cities/where-country-is/{name}', [MemberController::class, 'cities'])->name('cities');

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
    Route::get('/admin/product/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
    Route::get('/admin/product/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
    Route::get('/admin/product/history', [ProductController::class, 'allProductOrderHistory'])->name('product.order.history');
    Route::get('/admin/product/approve/{id}', [ProductController::class, 'approveProductOrderHistory'])->name('product.order.approve');
    Route::get('/admin/product/delete-history/{id}', [ProductController::class, 'deleteProductOrderHistory'])->name('product.order.delete');

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
    
    Route::get('/admin/withdraw-tax', [FundController::class, 'withdrawTax'])->name('withdraw.tax');
    Route::post('/admin/withdraw-tax-fix', [FundController::class, 'withdrawTaxFix'])->name('withdraw.taxfix');
    Route::post('/admin/withdraw-tax-change', [FundController::class, 'withdrawTaxChange'])->name('withdraw.taxchange');
    
    Route::get('/admin/user-fund', [FundController::class, 'newUserFund'])->name('funds.reg');
    Route::post('/admin/user-fund-fix', [FundController::class, 'newUserFundFix'])->name('funds.regfix');
    Route::post('/admin/user-fund-change', [FundController::class, 'newUserFundChange'])->name('funds.regchange');
    
    Route::get('/admin/referral-income', [FundController::class, 'referralIncome'])->name('referreal.income');
    Route::post('/admin/referral-income-fix', [FundController::class, 'referralIncomeFix'])->name('referreal.incomefix');
    Route::post('/admin/referral-income-change', [FundController::class, 'referralIncomeChange'])->name('referreal.incomechange');

    //////////                        Notice                     //////////    

    Route::get('/admin/notice/dashboard', [AdminController::class, 'dashboardNotice'])->name('notice.dashboard');
    Route::get('/admin/notice/withdraw', [AdminController::class, 'withdrawNotice'])->name('notice.withdraw');
    Route::post('/admin/notice/dashboard-publish', [AdminController::class, 'dashboardNoticePublish'])->name('notice.dashboard.publish');
    Route::post('/admin/notice/withdraw-publish', [AdminController::class, 'withdrawNoticePublish'])->name('notice.withdraw.publish');

    //////////                        Notice End                     //////////

    //////////                           HOME                  /////////////

    Route::get('/admin/home/start', [HomeController::class, 'homeStartSection'])->name('home.start');
    Route::get('/admin/home/about', [HomeController::class, 'homeAboutSection'])->name('home.about');
    Route::get('/admin/home/work', [HomeController::class, 'homeWorkSection'])->name('home.work');
    Route::get('/admin/home/goal', [HomeController::class, 'homeGoalSection'])->name('home.goal');
    Route::get('/admin/home/footer', [HomeController::class, 'homeFooterSection'])->name('home.footer');

    Route::post('/admin/home/submit', [HomeController::class, 'homeStartSubmit'])->name('home.start.submit');

    //////////                          HOME END                  /////////////
});

/////////////              ADMIN ROUTE END                ///////////

/////////////              USER RELATED ROUTE START                ///////////

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
    Route::get('/member/leaderboard', [IncomeController::class, 'leaderBoard'])->name('member.leaderboard');

    ///////////////           USER PROFILE CHANGE         ////////////////

    Route::get('/profile/edit', [MemberController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [MemberController::class, 'updateProfile'])->name('profile.update');

    Route::get('/profile/change-password', [MemberController::class, 'changePassword'])->name('profile.change.password');
    Route::post('/profile/change-password-request', [MemberController::class, 'changePasswordRequest'])->name('profile.change.passwordRequ');

    Route::get('/profile/change-pin', [MemberController::class, 'changePin'])->name('profile.change.pin');
    Route::post('/profile/change-pin-request', [MemberController::class, 'changePinRequest'])->name('profile.change.pinRequ');

    Route::get('/profile/change-profile-picture', [MemberController::class, 'changeProfilePhoto'])->name('profile.change.photo');
    Route::post('/profile/change-profile-picture-request', [MemberController::class, 'changeProfilePhotoRequest'])->name('profile.change.photoRequ');

    ///////////////           END USER PROFILE CHANGE         ////////////////

    Route::get('/product/member/all', [ProductController::class, 'userAllProduct'])->name('product.all.user');
    Route::get('/product/buy/{name}-{id}', [ProductController::class, 'buyProduct'])->name('product.buy');
    Route::post('/product/order', [ProductController::class, 'orderProduct'])->name('product.order');
    Route::get('/history/product-order', [ProductController::class, 'memberProductOrderHistory'])->name('history.product.order');
    Route::get('/history/fund-add-request', [FundController::class, 'fundAddRequestHistory'])->name('history.fund.request');
    Route::get('/history/fund-transfer', [FundController::class, 'fundTransferHistory'])->name('history.fund.transfer');
    Route::get('/history/fund-withdraw-request', [FundController::class, 'fundWithdrawRequestHistory'])->name('history.withdraw.request');
});


/////////////              USER RELATED ROUTE END                ///////////
