<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']); 

Route::middleware('auth:api')->group(function(){
        Route::get('products', [ProductController::class, 'index']);
        Route::post('products', [ProductController::class, 'store']);

});
