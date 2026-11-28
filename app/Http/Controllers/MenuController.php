<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // --- BAGIAN HALAMAN PUBLIK (TETAP DIPERTAHANKAN) ---
    public function index()
    {
        $profile = BusinessProfile::first();
        $menus = Menu::where('status_tersedia', true)->take(4)->get();

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

    // --- BAGIAN CRUD KELOLA MENU & STOK (OWNER) ---
    public function manage(Request $request)
    {
        $query = Menu::query();

        if ($request->filled('search')) {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        $menus = $query->latest()->get();

        return view('owner.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:manis,asin',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        // Otomatis set status_tersedia sesuai jumlah stok
        $validated['status_tersedia'] = $validated['stok'] > 0;

        Menu::create($validated);

        return redirect()->route('owner.menus.index')
            ->with('success', 'Menu baru berhasil ditambahkan!');
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:manis,asin',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && str_starts_with($menu->gambar, 'menus/') && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        // Otomatis perbarui status_tersedia saat stok diubah/restock
        $validated['status_tersedia'] = $validated['stok'] > 0;

        $menu->update($validated);

        return redirect()->route('owner.menus.index')
            ->with('success', 'Data menu dan stok berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar && str_starts_with($menu->gambar, 'menus/') && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('owner.menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}