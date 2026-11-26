@extends('layouts.master')

@section('title', 'Login | Toast.district')

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
        padding: 48px 42px;
    }

    .toast-input {
        background-color: #FAF6F0;
        border: 1px solid #DFD2C2;
        border-radius: 12px;
        padding: 12px 15px;
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
            <div class="col-lg-9 col-xl-8">
                <div class="auth-card">
                    <div class="row g-0">
                        <!-- Sisi Kiri Branding -->
                        <div class="col-md-5 d-none d-md-block">
                            <div class="auth-side-brand">
                                <div>
                                    <div style="font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700;">
                                        toast<span style="color: var(--orange);">.district</span>
                                    </div>
                                    <p class="mt-3" style="font-size: 13.5px; color: #D8C8B8; line-height: 1.75;">
                                        Masuk untuk memesan roti toast favoritmu secara online, memantau status pesanan, atau mengelola operasional outlet.
                                    </p>
                                </div>

                                <div class="pt-3 border-top" style="border-color: rgba(248, 243, 234, 0.18) !important;">
                                    <small style="color: #CBBBA8; font-size: 12px;">
                                        A little toast, a lot of happiness.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Sisi Kanan Form -->
                        <div class="col-md-7">
                            <div class="auth-form-side">
                                <h3 class="fw-bold mb-1" style="color: var(--dark-brown);">Selamat Datang Kembali</h3>
                                <p class="text-muted mb-4" style="font-size: 13.5px;">Silakan masuk menggunakan akun terdaftar.</p>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show rounded-3" style="font-size: 13px;">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show rounded-3" style="font-size: 13px;">
                                        {{ $errors->first() }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ url('/login') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-medium" style="font-size: 13px;">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="form-control toast-input" placeholder="nama@email.com" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-medium" style="font-size: 13px;">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password"
                                                class="form-control toast-input border-end-0" placeholder="Masukkan password" required>
                                            <button type="button" class="btn border border-start-0"
                                                style="background-color: #FAF6F0; border-color: #DFD2C2 !important; border-radius: 0 12px 12px 0;"
                                                onclick="togglePass('password', this)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">
                                                Ingat saya
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-toast w-100 py-2 mb-3">
                                        Masuk Sekarang
                                    </button>

                                    <p class="text-center text-muted mb-0" style="font-size: 13px;">
                                        Belum punya akun?
                                        <a href="{{ url('/register') }}" class="fw-semibold" style="color: var(--brown);">Daftar di sini</a>
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

<script>
    function togglePass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>

@endsection