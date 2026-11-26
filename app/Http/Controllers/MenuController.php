<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('welcome', compact('menus'));
    }

    public function menu()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function sponsorship()
    {
        return view('sponsorship');
    }
}