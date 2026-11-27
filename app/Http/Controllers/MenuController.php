<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $profile = BusinessProfile::first();$menus = Menu::where('status_tersedia', true)->take(4)->get();

        return view('welcome', compact('profile', 'menus'));
    }

    public function menu()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function sponsorship()
    {
        $profile = BusinessProfile::first();
        return view('sponsorship', compact('profile'));
    }
}