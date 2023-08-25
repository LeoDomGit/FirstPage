<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
Route::get('/',[UserController::class,'index']);
Route::post('/addLoaiTaiKhoan',[UserController::class,'TaoLoaiTaiKhoan']);
Route::post('/editLoaiTaiKhoan',[UserController::class,'editLoaiTaiKhoan']);
Route::post('/deleteLoaiTaiKhoan',[UserController::class,'deleteLoaiTaiKhoan']);
// ====================================
Route::post('/createUser',[UserController::class,'createUser']);

// Route::get('/sendmail',[UserController::class,'sendMail']);
Route::get('/login',[UserController::class,'Login']);
Route::post('/checkLogin',[UserController::class,'checkLogin']);
Route::get('/register', [UserController::class,'DangKy']);


