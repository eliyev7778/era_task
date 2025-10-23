<?php

use Illuminate\Support\Facades\Route;
use Modules\Campaign\App\Http\Controllers\CampaignController;
use Modules\Campaign\App\Http\Controllers\HealthController;

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
    Route::post('/campaigns', [CampaignController::class, 'store']);
    Route::post('/campaigns/{id}/queue', [CampaignController::class, 'queue']);
    Route::get('/campaigns/{id}', [CampaignController::class, 'show']);
    Route::get('/campaigns/{id}/status', [CampaignController::class, 'status']);
    Route::get('/campaigns', [CampaignController::class, 'index']);
    Route::post('/campaigns/{id}/test-send', [CampaignController::class, 'testSend']);
    Route::get('/health', [HealthController::class, 'api']);
    Route::get('/health/queue', [HealthController::class, 'queue']);
});

Route::get('v1/unsubscribe/{campaign}/{user}/{signature}', [CampaignController::class, 'unsubscribe'])->name('unsubscribe');
