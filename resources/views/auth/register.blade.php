@extends('layouts.master')

@section('title', 'Register | Toast.district')

@section('content')

<style>
    .auth-wrapper {
        min-height: calc(100vh - 160px);
        display: flex;
        align-items: center;
        padding: 60px 0;
        background-color: var(--cream);
    }

    .auth-card {
        background: #FFFDF9;
        border: 1px solid #E3D6C5;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(56, 39, 31, 0.06);
    }

    .auth-side-brand {
        background-color: var(--dark-brown);
        color: var(--cream);
        padding: 48px 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .auth-form-side {
        padding: 44px 42px;
    }

    .toast-input {
        background-color: #FAF6F0;
        border: 1px solid #DFD2C2;
        border-radius: 12px;
        padding: 11px 14px;
        font-size: 14px;
        color: var(--dark-brown);
    }

    .toast-input:focus {
        background-color: #ffffff;
        border-color: var(--brown);
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.15);
    }

    @media (max-width: 576px) {
        .auth-form-side {
            padding: 32px 24px;
        }
    }
</style>

<section class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="auth-card">
                    <div class="row g-0">
                        <!-- Sisi Kiri Branding -->
                        <div class="col-md-5 d-none d-md-block">
                            <div class="auth-side-brand">
                                <div>
                                    <div style="font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700;">
                                        toast<span style="color: var(--orange);">.district</span>
                                    </div>
                                    <h5 class="mt-4 fw-bold" style="color: var(--cream);">Buat Akun Pelanggan</h5>
                                    <p class="mt-2" style="font-size: 13.5px; color: #D8C8B8; line-height: 1.75;">
                                        Nikmati kemudahan pesan roti toast untuk pick-up maupun delivery, serta pemesanan jumlah besar untuk acara spesialmu.
                                    </p>
                                </div>

                                <div class="pt-3 border-top" style="border-color: rgba(248, 243, 234, 0.18) !important;">
                                    <small style="color: #CBBBA8; font-size: 12px;">
                                        Sudah terdaftar? Gunakan email dan password untuk masuk.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Sisi Kanan Form -->
                        <div class="col-md-7">
                            <div class="auth-form-side">
                                <h3 class="fw-bold mb-1" style="color: var(--dark-brown);">Daftar Akun Baru</h3>
                                <p class="text-muted mb-4" style="font-size: 13.5px;">Lengkapi data diri di bawah ini untuk mulai memesan.</p>

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show rounded-3" style="font-size: 13px;">
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ url('/register') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-medium" style="font-size: 13px;">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                            class="form-control toast-input" placeholder="Masukkan nama lengkap" required>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <label for="email" class="form-label fw-medium" style="font-size: 13px;">Email</label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control toast-input" placeholder="nama@email.com" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="no_hp" class="form-label fw-medium" style="font-size: 13px;">No. HP / WhatsApp</label>
                                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                                class="form-control toast-input" placeholder="08xxxxxxxxxx" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label fw-medium" style="font-size: 13px;">Alamat Pengiriman</label>
                                        <textarea id="alamat" name="alamat" rows="2"
                                            class="form-control toast-input" placeholder="Alamat lengkap (untuk kebutuhan delivery)" required>{{ old('alamat') }}</textarea>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-sm-6">
                                            <label for="password" class="form-label fw-medium" style="font-size: 13px;">Password</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control toast-input" placeholder="Minimal 6 karakter" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="password_confirmation" class="form-label fw-medium" style="font-size: 13px;">Ulangi Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="form-control toast-input" placeholder="Konfirmasi password" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-toast w-100 py-2 mb-3">
                                        Daftar Sekarang
                                    </button>

                                    <p class="text-center text-muted mb-0" style="font-size: 13px;">
                                        Sudah punya akun?
                                        <a href="{{ url('/login') }}" class="fw-semibold" style="color: var(--brown);">Login di sini</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection