<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest:manager')->group(function () {
    Route::get('manager/login', [App\Http\Controllers\Managers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('manager.login');

    Route::post('manager/login', [App\Http\Controllers\Managers\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:manager')->group(function () {
    Route::get('manager/dashboard', function(){
        return view('manager.dashboard');
    });

    Route::post('manager/logout', [App\Http\Controllers\Managers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('manager.logout');
});
