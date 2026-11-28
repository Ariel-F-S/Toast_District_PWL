@extends('layouts.master')

@section('title', 'Masuk & Daftar | Toast.district')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 150px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
    }

    .auth-card {
        position: relative;
        width: 860px;
        max-width: 100%;
        min-height: 550px;
        background: #FFFDF9;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(56, 39, 31, 0.14);
        border: 1px solid #E3D6C5;
        overflow: hidden;
    }

    /* FORM BOX (LOGIN & REGISTER) */
    .form-box {
        position: absolute;
        right: 0;
        width: 50%;
        height: 100%;
        background: #FFFDF9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark-brown);
        padding: 40px;
        z-index: 1;
        transition: 0.6s ease-in-out 1.1s, visibility 0s 1s;
    }

    .auth-card.active .form-box {
        right: 50%;
    }

    .form-box.register {
        visibility: hidden;
    }

    .auth-card.active .form-box.register {
        visibility: visible;
    }

    .auth-card.active .form-box.login {
        visibility: hidden;
    }

    .form-box form {
        width: 100%;
    }

    .form-box h2 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--dark-brown);
        text-align: center;
    }

    .form-subtitle {
        font-size: 13px;
        color: #7A6658;
        text-align: center;
        margin-bottom: 22px;
    }

    /* INPUT DENGAN IKON DI KANAN (SEPERTI VIDEO) */
    .input-box {
        position: relative;
        margin: 14px 0;
    }

    .input-box input {
        width: 100%;
        padding: 12px 44px 12px 18px;
        background: #F4ECE1;
        border-radius: 12px;
        border: 1.5px solid transparent;
        outline: none;
        font-size: 13.5px;
        color: var(--dark-brown);
        font-weight: 500;
        transition: 0.25s;
    }

    .input-box input::placeholder {
        color: #8F7B6C;
        font-weight: 400;
    }

    .input-box input:focus {
        background: #FFFDF9;
        border-color: var(--brown);
        box-shadow: 0 0 0 3px rgba(139, 94, 60, 0.12);
    }

    .input-box i {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: var(--brown);
    }

    .btn-auth-submit {
        width: 100%;
        height: 46px;
        background: linear-gradient(135deg, #8B5E3C 0%, #5A3A26 100%);
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(139, 94, 60, 0.25);
        border: none;
        cursor: pointer;
        font-size: 14.5px;
        color: #FFFDF9;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: 0.3s;
        margin-top: 6px;
    }

    .btn-auth-submit:hover {
        background: linear-gradient(135deg, #6E472B 0%, #38271F 100%);
        transform: translateY(-1px);
    }

    /* PANEL MELENGKUNG YANG MELEBAR PENUH SAAT TRANSISI (CURVED TOGGLE BOX) */
    .toggle-box {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .toggle-box::before {
        content: '';
        position: absolute;
        left: -250%;
        width: 300%;
        height: 100%;
        background: linear-gradient(135deg, #9C6B44 0%, #38271F 100%);
        border-radius: 150px;
        z-index: 2;
        transition: 1.6s ease-in-out;
    }

    .auth-card.active .toggle-box::before {
        left: 50%;
    }

    .toggle-panel {
        position: absolute;
        width: 50%;
        height: 100%;
        color: var(--cream);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 36px;
        z-index: 3;
        pointer-events: auto;
        transition: 0.6s ease-in-out;
    }

    .toggle-panel.toggle-left {
        left: 0;
        transition-delay: 1.1s;
    }

    .auth-card.active .toggle-panel.toggle-left {
        left: -50%;
        transition-delay: 0.5s;
    }

    .toggle-panel.toggle-right {
        right: -50%;
        transition-delay: 0.5s;
    }

    .auth-card.active .toggle-panel.toggle-right {
        right: 0;
        transition-delay: 1.1s;
    }

    .toggle-panel h2 {
        font-size: 32px;
        font-weight: 700;
        color: var(--cream);
        margin-bottom: 10px;
    }

    .toggle-panel p {
        font-size: 13.5px;
        color: #EADBC8;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .btn-toggle-outline {
        width: 160px;
        height: 44px;
        background: transparent;
        border: 2px solid var(--cream);
        border-radius: 12px;
        color: var(--cream);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-toggle-outline:hover {
        background: var(--cream);
        color: var(--dark-brown);
    }

    /* RESPONSIVE MOBILE */
    @media screen and (max-width: 768px) {
        .auth-card {
            min-height: 680px;
        }
        .form-box {
            bottom: 0;
            width: 100%;
            height: 72%;
            padding: 28px 24px;
        }
        .auth-card.active .form-box {
            right: 0;
            bottom: 28%;
        }
        .toggle-box::before {
            left: 0;
            top: -270%;
            width: 100%;
            height: 300%;
            border-radius: 20vw;
        }
        .auth-card.active .toggle-box::before {
            left: 0;
            top: 72%;
        }
        .auth-card.active .toggle-panel.toggle-left {
            left: 0;
            top: -28%;
        }
        .toggle-panel {
            width: 100%;
            height: 28%;
            padding: 0 20px;
        }
        .toggle-panel.toggle-left {
            top: 0;
        }
        .toggle-panel.toggle-right {
            right: 0;
            bottom: -28%;
        }
        .auth-card.active .toggle-panel.toggle-right {
            bottom: 0;
        }
        .toggle-panel h2 {
            font-size: 24px;
            margin-bottom: 4px;
        }
        .toggle-panel p {
            margin-bottom: 12px;
            font-size: 12.5px;
        }
    }
</style>
@endpush

@section('content')
@php
    $startRegister = ($isRegister ?? false) || old('nama') !== null || old('no_hp') !== null;
@endphp

<div class="auth-wrapper">
    <div class="auth-card {{ $startRegister ? 'active' : '' }}" id="authCard">

        <!-- FORM LOGIN (Sisi Kanan saat Default) -->
        <div class="form-box login">
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <h2>Login</h2>
                <p class="form-subtitle">Masuk ke akun Toast.district kamu</p>

                @if ($errors->any() && !$startRegister)
                    <div class="alert alert-danger py-2 px-3 rounded-3 mb-2" style="font-size: 12px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="input-box">
                    <input type="email" name="email" value="{{ !$startRegister ? old('email') : '' }}" placeholder="Email" required autofocus>
                    <i class="bi bi-envelope-fill"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bi bi-lock-fill"></i>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 px-1" style="font-size: 12.5px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn-auth-submit">Login</button>
            </form>
        </div>

        <!-- FORM REGISTER (Sisi Kiri saat Active) -->
        <div class="form-box register">
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <h2>Registration</h2>
                <p class="form-subtitle">Daftar akun pelanggan Toast.district</p>

                @if ($errors->any() && $startRegister)
                    <div class="alert alert-danger py-2 px-3 rounded-3 mb-2" style="font-size: 12px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="input-box my-2">
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="input-box my-2">
                    <input type="email" name="email" value="{{ $startRegister ? old('email') : '' }}" placeholder="Email" required>
                    <i class="bi bi-envelope-fill"></i>
                </div>

                <div class="input-box my-2">
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor WhatsApp (08...)" required>
                    <i class="bi bi-whatsapp"></i>
                </div>

                <div class="input-box my-2">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bi bi-lock-fill"></i>
                </div>

                <div class="input-box my-2">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <i class="bi bi-shield-lock-fill"></i>
                </div>

                <button type="submit" class="btn-auth-submit">Register</button>
            </form>
        </div>

        <!-- PANEL SLIDER MELENGKUNG (CURVED OVERLAY) -->
        <div class="toggle-box">
            <!-- Muncul saat mode Login (di sisi Kiri) -->
            <div class="toggle-panel toggle-left">
                <span class="badge rounded-pill mb-2 px-3 py-1" style="background-color: rgba(248, 243, 234, 0.16); color: var(--cream); font-size: 11px;">
                    toast.district
                </span>
                <h2>Hello, Welcome!</h2>
                <p>Belum punya akun? Yuk daftar dulu untuk pesan toast favoritmu.</p>
                <button type="button" class="btn-toggle-outline" id="registerToggleBtn">Register</button>
            </div>

            <!-- Muncul saat mode Register (di sisi Kanan) -->
            <div class="toggle-panel toggle-right">
                <span class="badge rounded-pill mb-2 px-3 py-1" style="background-color: rgba(248, 243, 234, 0.16); color: var(--cream); font-size: 11px;">
                    toast.district
                </span>
                <h2>Welcome Back!</h2>
                <p>Sudah punya akun? Langsung masuk untuk lanjut memesan.</p>
                <button type="button" class="btn-toggle-outline" id="loginToggleBtn">Login</button>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const authCard = document.getElementById('authCard');
    const registerToggleBtn = document.getElementById('registerToggleBtn');
    const loginToggleBtn = document.getElementById('loginToggleBtn');

    registerToggleBtn?.addEventListener('click', () => {
        authCard.classList.add('active');
        window.history.replaceState({}, '', '{{ url("/register") }}');
    });

    loginToggleBtn?.addEventListener('click', () => {
        authCard.classList.remove('active');
        window.history.replaceState({}, '', '{{ url("/login") }}');
    });
</script>
@endpush