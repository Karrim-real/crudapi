<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/allorders', [OrderController::class, 'index']);
Route::get('v1/order/{id}', [OrderController::class, 'show']);
Route::get('v1/orderfulfill', [OrderController::class, 'fulfilledOrder']);
Route::post('v1/createorder', [OrderController::class, 'create']);
Route::put('v1/updateorder/{id}', [OrderController::class, 'update']);
Route::delete('v1/del-order/{id}', [OrderController::class, 'destroy']);
