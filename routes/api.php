<?php

use App\Http\Controllers\Api\AccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Auth;

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

Route::apiResource('products', ProductsController::class);

Route::post('auth/access-tokens',[AccessTokenController::class,'store'])
->middleware('guest:sanctum');

Route::delete('auth/access-tokens/{token?}', [AccessTokenController::class, 'destroy'])->middleware('auth:sanctum');


