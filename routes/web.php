<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategroriesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('checkLogin')->group(function () {
    // ...
    Route::post('/createUser',[UserController::class,'createUser']);
    Route::get('/',[UserController::class,'index']);
    Route::post('/addLoaiTaiKhoan',[UserController::class,'TaoLoaiTaiKhoan']);
    Route::post('/editLoaiTaiKhoan',[UserController::class,'editLoaiTaiKhoan']);
    Route::post('/deleteLoaiTaiKhoan',[UserController::class,'deleteLoaiTaiKhoan']);
    Route::post('/doiEmail',[UserController::class,'doiEmail']);
    Route::post('/switchUser',[UserController::class,'switchUser']);
    Route::post('/deleteUser',[UserController::class,'deleteUser']);
    Route::get('/logout',[UserController::class,'logout']);
    Route::controller(CategroriesController::class)->group(function () {
        Route::get('/loai-sp', 'index');
        Route::post('/loai-sp', 'store');
        Route::post('/sua-loai-sp', 'update');
        Route::post('/xoa-loai-sp', 'destroy');

    });
    // Route::get('/loaiSP',[CategroriesController::class,'index']);

});

Route::get('/login',[UserController::class,'Login']);
Route::post('/checkLogin',[UserController::class,'checkLogin']);


