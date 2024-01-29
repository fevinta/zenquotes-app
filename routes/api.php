<?php

use App\Http\Controllers\Api\QuotesController;
use App\Http\Controllers\Api\SecureQuotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('secure-quotes/{new?}', [SecureQuotesController::class, 'index']);
    Route::post('secure-quotes/{new?}', [SecureQuotesController::class, 'index']);
});

Route::get('quotes/{new?}', [QuotesController::class, 'index']);
