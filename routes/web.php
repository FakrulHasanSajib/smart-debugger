<?php

use Illuminate\Support\Facades\Route;
use SmartDebugger\Http\Controllers\DebuggerController;

Route::prefix('debugger')->group(function () {
    Route::get('/', [DebuggerController::class, 'index'])->name('debugger.dashboard');
});
