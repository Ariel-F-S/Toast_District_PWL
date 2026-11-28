@extends('layouts.master')

@section('title', 'Kelola Menu & Stok | Toast.district')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--dark-brown);">Kelola Menu & Stok</h2>
            <p class="text-muted mb-0" style="font-size: 14px;">Atur daftar roti toast, harga jual, foto produk, dan ketersediaan stok harian.</p>
        </div>
        <button type="button" class="btn btn-toast px-4 py-2" data-bs-toggle="modal" data-bs-target="#addMenuModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Menu
        </button>
    </div>

    <!-- Alert Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <ul class="mb-0 ps-3" style="font-size: 13.5px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter & Pencarian -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background-color: #FFFDF9; border: 1px solid #E3D6C5 !important;">
        <div class="card-body p-3">
            <form action="{{ route('owner.menus.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-3" placeholder="Cari nama menu toast...">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-select rounded-3">
                        <option value="all">Semua Kategori</option>
                        <option value="manis" {{ request('kategori') === 'manis' ? 'selected' : '' }}>Sweet Toast (Manis)</option>
                        <option value="asin" {{ request('kategori') === 'asin' ? 'selected' : '' }}>Salted Toast (Asin)</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-toast w-100">Filter</button>
                    @if(request('search') || (request('kategori') && request('kategori') !== 'all'))
                        <a href="{{ route('owner.menus.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Menu -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: #FFFDF9; border: 1px solid #E3D6C5 !important;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F4ECE1; color: var(--dark-brown);">
                    <tr>
                        <th class="ps-4 py-3" style="width: 75px;">Foto</th>
                        <th class="py-3">Nama Menu</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3">Stok</th>
                        <th class="py-3">Status</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                        @php
                            $imgUrl = $menu->gambar
                                ? (str_starts_with($menu->gambar, 'menus/') ? asset('storage/' . $menu->gambar) : asset($menu->gambar))
                                : null;
                        @endphp
                        <tr>
                            <td class="ps-4 py-3">
                                @if ($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $menu->nama_menu }}" class="rounded-3 object-fit-cover" style="width: 54px; height: 54px; border: 1px solid #E3D6C5;">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px; background-color: #F4ECE1; color: var(--brown);">
                                        <i class="bi bi-image fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold" style="color: var(--dark-brown);">{{ $menu->nama_menu }}</div>
                                <small class="text-muted d-block text-truncate" style="max-width: 260px;">
                                    {{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}
                                </small>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-1" style="background-color: #EFE4D4; color: var(--dark-brown);">
                                    {{ $menu->kategori === 'manis' ? 'Sweet' : 'Salted' }}
                                </span>
                            </td>
                            <td class="fw-semibold" style="color: var(--dark-brown);">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>
                            <td class="fw-bold">{{ $menu->stok }} pcs</td>
                            <td>
                                @if ($menu->stok == 0)
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Habis</span>
                                @elseif ($menu->stok <= 5)
                                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3">Menipis</span>
                                @else
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">Tersedia</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editMenuModal{{ $menu->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit / Restock
                                </button>
                                <form action="{{ route('owner.menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu {{ $menu->nama_menu }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Menu -->
                        <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0">
                                    <form action="{{ route('owner.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header border-bottom-0 pb-0">
                                            <h5 class="modal-title fw-bold" style="color: var(--dark-brown);">Edit & Restock Menu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Nama Menu</label>
                                                <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control rounded-3" required>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-semibold">Kategori</label>
                                                    <select name="kategori" class="form-select rounded-3" required>
                                                        <option value="manis" {{ $menu->kategori === 'manis' ? 'selected' : '' }}>Sweet (Manis)</option>
                                                        <option value="asin" {{ $menu->kategori === 'asin' ? 'selected' : '' }}>Salted (Asin)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-semibold">Harga (Rp)</label>
                                                    <input type="number" name="harga" value="{{ $menu->harga }}" min="0" class="form-control rounded-3" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-semibold">Stok (pcs)</label>
                                                    <input type="number" name="stok" value="{{ $menu->stok }}" min="0" class="form-control rounded-3" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Deskripsi</label>
                                                <textarea name="deskripsi" rows="2" class="form-control rounded-3">{{ $menu->deskripsi }}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-semibold">Ganti Foto Produk (Opsional)</label>
                                                <input type="file" name="gambar" accept="image/*" class="form-control rounded-3">
                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 pt-0">
                                            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-toast px-4">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                Belum ada data menu. Klik tombol <strong>Tambah Menu</strong> untuk mulai menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('owner.menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" style="color: var(--dark-brown);">Tambah Menu Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control rounded-3" placeholder="Contoh: Choco Crunchy Toast" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select rounded-3" required>
                                <option value="manis">Sweet (Manis)</option>
                                <option value="asin">Salted (Asin)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Harga (Rp)</label>
                            <input type="number" name="harga" min="0" class="form-control rounded-3" placeholder="10000" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Stok Awal</label>
                            <input type="number" name="stok" min="0" value="20" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="form-control rounded-3" placeholder="Isian roti panggang..."></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Foto Produk</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control rounded-3">
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-toast px-4">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection