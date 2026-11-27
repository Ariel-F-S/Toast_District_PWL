<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('owner.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('owner.users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('owner.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('owner.users.destroy');
});

Route::get('/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth', 'role:owner'])->name('dashboard');