<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;

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

Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    // CRUD Users
    Route::get('/users', [UserController::class, 'index'])->name('owner.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('owner.users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('owner.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('owner.users.destroy');

    // CRUD Kelola Menu & Stok
    Route::get('/menus', [MenuController::class, 'manage'])->name('owner.menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('owner.menus.store');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('owner.menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('owner.menus.destroy');
});

Route::get('/dashboard', function () {
    $totalPendapatan = DB::table('orders')->where('status_pembayaran', 'lunas')->sum('total_harga');
    $pendapatanTunai = DB::table('orders')->where('status_pembayaran', 'lunas')->where('jenis_pembayaran', 'tunai')->sum('total_harga');
    $pendapatanQris = DB::table('orders')->where('status_pembayaran', 'lunas')->whereIn('jenis_pembayaran', ['qris_dp', 'qris_lunas'])->sum('total_harga');
    $totalPesanan = DB::table('orders')->count();
    $totalUser = User::count();
    $totalMenu = DB::table('menus')->count();
    $recentOrders = DB::table('orders')->latest()->limit(5)->get();

    return view('owner.dashboard', compact(
        'totalPendapatan',
        'pendapatanTunai',
        'pendapatanQris',
        'totalPesanan',
        'totalUser',
        'totalMenu',
        'recentOrders'
    ));
})->middleware(['auth', 'role:owner'])->name('dashboard');