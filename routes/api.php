<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserInfoController;
use App\Http\Controllers\Api\UserConnectController;
use App\Http\Controllers\Api\SmartRentaController;
use App\Http\Controllers\Api\Media4uController;

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

Route::get('/users', [UserController::class, 'index']);
Route::post('user/register', [UserInfoController::class, 'register']);

Route::middleware('auth.uuid')->prefix('user')->group(function () {
    Route::get('/connect', [UserConnectController::class, 'list']);
    Route::post('/connect', [UserConnectController::class, 'connect']);
});

//Media4u
Route::middleware('auth.sms')->group(function () {
    Route::post('mediafu/receive-status', [Media4uController::class, 'receiveStatus']);
});

// SmartRenta
Route::post('get-user-info', [SmartRentaController::class, 'getDataUserInfo']);