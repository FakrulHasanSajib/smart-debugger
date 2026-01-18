<?php

use Illuminate\Support\Facades\Route;
use FakrulHasan\SmartDebugger\Http\Controllers\DashboardController;

Route::group(['prefix' => 'smart-debugger', 'middleware' => ['web']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('smart-debugger.dashboard');
});
