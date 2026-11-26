<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;

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