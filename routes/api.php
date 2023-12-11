<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\BrandController;
use  App\Http\Controllers\CategroriesController;

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
Route::get('/products', [ProductController::class,'getProductAPI']);
Route::get('/brands', [BrandController::class,'getBrandAPI']);
Route::get('/categrories', [CategroriesController::class,'getCateAPI']);
Route::get('/products', [ProductController::class,'getProductAPI']);