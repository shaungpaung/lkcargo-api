<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemtypeController;
use App\Http\Controllers\ExchangerateController;
use App\Http\Controllers\TransportChargesController;
use App\Http\Controllers\OtherChargesController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CustomerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [UserController::class, 'login'])->name('route');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('itemtypes', ItemtypeController::class);
    Route::apiResource('exchangerates', ExchangerateController::class);
    Route::apiResource('othercharges', OtherchargesController::class);
    Route::apiResource('transportcharges', TransportChargesController::class);
    Route::apiResource('pricings', PricingController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::post('/resetPassword', [UserController::class, 'resetPassword']);
    Route::post('/changePassword', [UserController::class, 'changePassword']);
    Route::post('/logout', [UserController::class, 'logout']);
});
