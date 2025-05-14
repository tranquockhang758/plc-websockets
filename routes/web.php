<?php

use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PLCController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AuthController::class, 'home']);

    Route::get('/sup', [PLCController::class, 'sup']);
    Route::get('/export', [PLCController::class, 'export']);
    Route::post('/sendDataToClient', [PLCController::class, 'sendDataToClient']);
});


Route::post('/data', [PLCController::class, 'getDataFromPython']);
// Trang đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Trang đăng nhập
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// API kiểm tra user/password
Route::post('login', [AuthController::class, 'login']);
// API kiểm tra user/password
Route::post('/create', [AuthController::class, 'create'])->name('create');
Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
