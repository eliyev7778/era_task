<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Segment\App\Http\Controllers\SegmentController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:admin'])->prefix('v1')->name('api.')->group(function () {
    Route::post('segments', [SegmentController::class,'create'])->name('segments.create');
    Route::get('segments/{id}', [SegmentController::class,'show'])->name('segments.show');
    Route::get('segments', [SegmentController::class,'list'])->name('segments.list');
    Route::get('segments/{id}/preview', [SegmentController::class, 'preview']);

});
