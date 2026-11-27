@extends('layouts.master')

@section('title', 'Manajemen Pengguna | Toast.district')

@section('content')

<style>
    .admin-section {
        padding: 50px 0 80px;
        background-color: var(--cream);
        min-height: calc(100vh - 160px);
    }

    .admin-card {
        background: #FFFDF9;
        border: 1px solid #E3D6C5;
        border-radius: 20px;
        box-shadow: 0 10px 28px rgba(56, 39, 31, 0.05);
    }

    .table-toast thead th {
        background-color: #F3EAE0;
        color: var(--dark-brown);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid #E0D2C0;
        padding: 14px 16px;
    }

    .table-toast tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #F0E7DB;
        font-size: 14px;
    }

    .role-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .role-owner { background-color: #38271F; color: #F8F3EA; }
    .role-kasir { background-color: #F5E3D6; color: #9A5738; }
    .role-pelanggan { background-color: #E8E5D8; color: #596342; }

    .toast-input {
        background-color: #FAF6F0;
        border: 1px solid #DFD2C2;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 14px;
    }

    .toast-input:focus {
        background-color: #ffffff;
        border-color: var(--brown);
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.15);
    }
</style>

<section class="admin-section">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <span class="text-uppercase fw-semibold" style="font-size: 12px; letter-spacing: 2px; color: var(--brown);">
                    Panel Kontrol Owner
                </span>
                <h2 class="fw-bold mb-1" style="color: var(--dark-brown);">Manajemen Akun Pengguna</h2>
                <p class="text-muted mb-0" style="font-size: 14px;">
                    Kelola hak akses akun Owner, Kasir outlet, dan Pelanggan terdaftar.
                </p>
            </div>

            <button type="button" class="btn btn-toast px-4 py-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus me-1"></i> Tambah Pengguna
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4" style="font-size: 14px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-4" style="font-size: 14px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="admin-card p-3 p-md-4 mb-4">
            <form action="{{ route('owner.users.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control toast-input" placeholder="Cari nama, email, atau nomor HP...">
                </div>
                <div class="col-md-4">
                    <select name="role" class="form-select toast-input">
                        <option value="">Semua Role</option>
                        <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="kasir" {{ request('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-toast w-100">Filter</button>
                    @if (request()->hasAny(['search', 'role']))
                        <a href="{{ route('owner.users.index') }}" class="btn btn-toast-outline">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="admin-card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-toast mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td style="max-width: 220px;">{{ $user->alamat }}</td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                            Edit
                                        </button>

                                        @if ($user->id !== Auth::id())
                                            <form action="{{ route('owner.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0" style="background-color: #FFFDF9;">
                                        <div class="modal-header border-bottom" style="border-color: #EAE0D2 !important;">
                                            <h5 class="modal-title fw-bold">Edit Akun Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('owner.users.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium" style="font-size: 13px;">Nama Lengkap</label>
                                                    <input type="text" name="nama" value="{{ $user->nama }}" class="form-control toast-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium" style="font-size: 13px;">Email</label>
                                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control toast-input" required>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-sm-6">
                                                        <label class="form-label fw-medium" style="font-size: 13px;">No. HP</label>
                                                        <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="form-control toast-input" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label fw-medium" style="font-size: 13px;">Role Akun</label>
                                                        <select name="role" class="form-select toast-input" required>
                                                            <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                                                            <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                                            <option value="pelanggan" {{ $user->role == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium" style="font-size: 13px;">Alamat</label>
                                                    <textarea name="alamat" rows="2" class="form-control toast-input" required>{{ $user->alamat }}</textarea>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-medium" style="font-size: 13px;">Password Baru <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                                    <input type="password" name="password" class="form-control toast-input" placeholder="Minimal 6 karakter">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top" style="border-color: #EAE0D2 !important;">
                                                <button type="button" class="btn btn-toast-outline" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-toast">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0" style="background-color: #FFFDF9;">
            <div class="modal-header border-bottom" style="border-color: #EAE0D2 !important;">
                <h5 class="modal-title fw-bold">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('owner.users.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 13px;">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control toast-input" placeholder="Nama kasir / pelanggan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 13px;">Email</label>
                        <input type="email" name="email" class="form-control toast-input" placeholder="email@toastdistrict.com" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-medium" style="font-size: 13px;">No. HP</label>
                            <input type="text" name="no_hp" class="form-control toast-input" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-medium" style="font-size: 13px;">Role Akun</label>
                            <select name="role" class="form-select toast-input" required>
                                <option value="kasir">Kasir</option>
                                <option value="pelanggan">Pelanggan</option>
                                <option value="owner">Owner</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 13px;">Alamat</label>
                        <textarea name="alamat" rows="2" class="form-control toast-input" placeholder="Alamat lengkap" required></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-medium" style="font-size: 13px;">Password</label>
                        <input type="password" name="password" class="form-control toast-input" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                <div class="modal-footer border-top" style="border-color: #EAE0D2 !important;">
                    <button type="button" class="btn btn-toast-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-toast">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection