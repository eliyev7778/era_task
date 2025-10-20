<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\App\Http\Controllers\AuthenticationController;



Route::post('admin/register', [AuthenticationController::class, 'register']);
Route::post('admin/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AuthenticationController::class, 'logout']);
});
