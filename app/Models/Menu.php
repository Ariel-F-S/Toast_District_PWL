<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Jika nama tabel di database kamu 'menus', baris ini boleh ada atau dihapus.
    // Jika nama tabelnya berbeda (misal 'tb_menu' atau 'produk'), tulis nama tabel aslinya di sini:
    protected $table = 'menus';

    protected $guarded = [];
}