<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $menus = Menu::all();
    return view('welcome', compact('menus'));
});

Route::get('/menu', function () {
    $menus = Menu::all();
    return view('menu', compact('menus'));
});

Route::get('/sponsorship', function () {
    return view('sponsorship');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');