@extends('layouts.master')

@section('title', 'Home | Toast.district')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    /* SIDE RAIL NAVIGATION (HALUS DI SISI KANAN, TIDAK BIKIN DOUBLE HEADER) */
    .side-rail-nav {
        position: fixed;
        right: 26px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 950;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .rail-item {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        color: var(--dark-brown);
        opacity: 0.45;
        transition: opacity 0.25s ease;
    }

    .rail-item:hover,
    .rail-item.active {
        opacity: 1;
    }

    .rail-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: #FFFDF9;
        border: 1px solid #E2D5C5;
        padding: 4px 10px;
        border-radius: 20px;
        opacity: 0;
        transform: translateX(6px);
        transition: all 0.25s ease;
        pointer-events: none;
    }

    .rail-item:hover .rail-label,
    .rail-item.active .rail-label {
        opacity: 1;
        transform: translateX(0);
    }

    .rail-line {
        width: 18px;
        height: 2px;
        background-color: var(--dark-brown);
        transition: width 0.25s ease, background-color 0.25s ease;
    }

    .rail-item.active .rail-line {
        width: 32px;
        background-color: var(--brown);
    }

    /* HERO F&B MODERN (TANPA CARD BERTUMPUK) */
    .toast-hero {
        padding: 40px 0 65px;
        background-color: var(--cream);
        overflow: hidden;
    }

    .hero-location-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 500;
        color: #6B5647;
        border-bottom: 1px solid #CBBBA8;
        padding-bottom: 6px;
        margin-bottom: 24px;
    }

    .hero-headline {
        font-size: clamp(2.9rem, 6.2vw, 5.2rem);
        font-weight: 700;
        line-height: 1.02;
        letter-spacing: -1px;
        color: var(--dark-brown);
        margin-bottom: 24px;
    }

    .hero-headline span {
        color: var(--brown);
    }

    .hero-desc {
        font-size: 15.5px;
        line-height: 1.85;
        color: #655042;
        max-width: 470px;
        margin-bottom: 34px;
    }

    /* VISUAL PRODUK BEBAS (ARCH FRAME BERSIH TANPA TEKS DOBEL) */
    .hero-visual-stage {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-arch-frame {
        width: 100%;
        max-width: 460px;
        background: transparent;
        border: none;
        padding: 10px 20px;
        box-shadow: none;
        text-align: center;
        position: relative;
    }

    .hero-arch-frame img {
        width: 100%;
        height: 360px;
        object-fit: contain;
        mix-blend-mode: multiply;
        transition: transform 0.4s ease;
    }

    .hero-arch-frame:hover img {
        transform: translateY(-6px) scale(1.02);
    }

    .hero-floating-tag {
        display: inline-block;
        margin-top: 10px;
        background-color: var(--dark-brown);
        color: var(--cream);
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 12px;
        box-shadow: 0 10px 24px rgba(56, 39, 31, 0.14);
        text-align: center;
    }

    /* RUNNING TICKER KHAS BRAND F&B */
    .brand-ticker {
        background-color: var(--dark-brown);
        color: var(--cream);
        padding: 14px 0;
        overflow: hidden;
        white-space: nowrap;
        border-top: 1px solid #4A352B;
        border-bottom: 1px solid #4A352B;
    }

    .ticker-track {
        display: inline-block;
        animation: marqueeScroll 24s linear infinite;
        font-size: 12px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .ticker-dot {
        color: var(--orange);
        margin: 0 22px;
    }

    @keyframes marqueeScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* SECTIONS */
    .story-section {
        scroll-margin-top: 85px;
        padding: 95px 0;
    }

    .eyebrow-label {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--brown);
        margin-bottom: 12px;
    }

    .display-sub {
        font-size: clamp(2rem, 3.8vw, 3rem);
        font-weight: 700;
        line-height: 1.15;
        color: var(--dark-brown);
    }

    /* DARK CONTRAST BLOCK (RITME VISUAL F&B) */
    .dark-craft-section {
        scroll-margin-top: 85px;
        background-color: var(--dark-brown);
        color: var(--cream);
        padding: 95px 0;
    }

    .craft-item {
        border-top: 1px solid rgba(248, 243, 234, 0.18);
        padding: 26px 0;
    }

    .craft-item:last-child {
        border-bottom: 1px solid rgba(248, 243, 234, 0.18);
    }

    /* ETALASE MENU BERSIH (GAMBAR SUDAH PUNYA LABEL, JADI KARTU CUKUP RINGKAS) */
    .etalase-card {
        background: #ffffff;
        border: 1px solid #E7DDD0;
        border-radius: 20px;
        padding: 18px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .etalase-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(56, 39, 31, 0.08);
    }

    .etalase-card img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        margin-bottom: 12px;
    }

    .badge-sweet {
        background-color: #F5E3D6;
        color: #9A5738;
        font-size: 11px;
    }

    .badge-salty {
        background-color: #E8E5D8;
        color: #596342;
        font-size: 11px;
    }

    /* OUTLET SPLIT */
    .outlet-wrapper {
        border-top: 1px solid #D9CCBC;
        padding-top: 60px;
    }

    @media (max-width: 991px) {
        .side-rail-nav {
            display: none;
        }
        .hero-floating-tag {
            left: 12px;
            bottom: 12px;
        }
    }
</style>

<!-- NAVIGASI SIDE RAIL HALUS (MUNCUL DI KANAN LAYAR) -->
<nav class="side-rail-nav" aria-label="Navigasi Halaman">
    <a href="#hero" class="rail-item active">
        <span class="rail-label">Top</span>
        <span class="rail-line"></span>
    </a>
    <a href="#cerita-kami" class="rail-item">
        <span class="rail-label">Cerita Kami</span>
        <span class="rail-line"></span>
    </a>
    <a href="#racikan-kami" class="rail-item">
        <span class="rail-label">Racikan</span>
        <span class="rail-line"></span>
    </a>
    <a href="#menu-pilihan" class="rail-item">
        <span class="rail-label">Menu</span>
        <span class="rail-line"></span>
    </a>
    <a href="#outlet-kami" class="rail-item">
        <span class="rail-label">Outlet</span>
        <span class="rail-line"></span>
    </a>
</nav>

<!-- 1. HERO SECTION -->
<section id="hero" class="toast-hero story-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-location-pill">
                    <i class="bi bi-geo-alt-fill" style="color: var(--brown);"></i>
                    <span>{{ $profile->alamat ?? 'Kota Kediri, Jawa Timur' }} &bull; {{ $profile->jam_operasional ?? '10.00 - 22.00 WIB' }}</span>
                </div>

                <h1 class="hero-headline">
                    Roti Panggang<br>
                    Hangat, <span>Isian<br>Melimpah.</span>
                </h1>

                <p class="hero-desc">
                    {{ $profile->deskripsi_usaha ?? 'Spesialis roti toast kekinian dengan pilihan varian manis dan asin yang dibuat fresh setiap hari.' }}
                </p>

                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="{{ url('/menu') }}" class="btn btn-toast px-4 py-2">
                        Lihat Daftar Menu <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <a href="#cerita-kami" class="btn btn-toast-outline px-4 py-2">
                        Tentang {{ $profile->nama_usaha ?? 'Toast.district' }}
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual-stage">
                    @php
                        $heroMenu = $menus->first();
                    @endphp
                    <div class="hero-arch-frame">
                        @if ($heroMenu && $heroMenu->gambar)
                            <img src="{{ asset($heroMenu->gambar) }}" alt="{{ $heroMenu->nama_menu }}">
                        @else
                            <div class="py-5">
                                <i class="bi bi-cup-hot" style="font-size: 80px; color: var(--brown);"></i>
                            </div>
                        @endif

                        <div class="hero-floating-tag">
                            <div style="color: var(--orange); font-size: 10px; letter-spacing: 1.5px; text-transform: uppercase;">Freshly Toasted</div>
                            <div class="fw-semibold">Made by Order Setiap Hari</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TICKER BRANDING -->
<div class="brand-ticker">
    <div class="ticker-track">
        <span>A Little Toast, A Lot of Happiness</span><span class="ticker-dot">&bull;</span>
        <span>Sweet & Salted Toast</span><span class="ticker-dot">&bull;</span>
        <span>Freshly Baked in Kediri</span><span class="ticker-dot">&bull;</span>
        <span>{{ $profile->nama_usaha ?? 'Toast.district' }}</span><span class="ticker-dot">&bull;</span>
        <span>A Little Toast, A Lot of Happiness</span><span class="ticker-dot">&bull;</span>
        <span>Sweet & Salted Toast</span><span class="ticker-dot">&bull;</span>
        <span>Freshly Baked in Kediri</span><span class="ticker-dot">&bull;</span>
        <span>{{ $profile->nama_usaha ?? 'Toast.district' }}</span><span class="ticker-dot">&bull;</span>
    </div>
</div>

<!-- 2. CERITA KAMI -->
<section id="cerita-kami" class="story-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <p class="eyebrow-label">Cerita Kami</p>
                <h2 class="display-sub">
                    Sederhana di Tampilan, Serius di Rasa.
                </h2>
            </div>
            <div class="col-lg-7">
                <p class="text-muted mb-3" style="font-size: 15.5px; line-height: 1.9;">
                    <strong>{{ $profile->nama_usaha ?? 'Toast.district' }}</strong> lahir dari ide sederhana: menyajikan roti panggang tebal dengan tekstur renyah keemasan di luar, lembut di dalam, dan isian yang terasa di setiap gigitan.
                </p>
                <p class="text-muted mb-0" style="font-size: 15.5px; line-height: 1.9;">
                    Berbasis di <strong>{{ $profile->alamat ?? 'Kota Kediri, Jawa Timur' }}</strong>, kami meracik dua karakter menu sekaligus—varian <em>Sweet Toast</em> seperti Choco Crunchy dan Tiramisu untuk pecinta manis, serta varian <em>Salted Toast</em> berisi telur orak-arik, smoke beef, dan patty sapi panggang untuk pengganjal lapar kapan saja.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. BLOK GELAP: RACIKAN KAMI (BIAR HALAMAN TIDAK MONOTON WARNA KREM) -->
<section id="racikan-kami" class="dark-craft-section story-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <p class="eyebrow-label" style="color: var(--orange);">Dapur Kami</p>
                <h2 class="display-sub" style="color: var(--cream);">
                    Tiga Hal yang Tidak Pernah Kami Kurangi
                </h2>
                <p class="mt-3" style="color: #CBBBA8; font-size: 14.5px; line-height: 1.8;">
                    Setiap box yang keluar dari meja panggang melewati standar penyajian yang sama.
                </p>
            </div>

            <div class="col-lg-7">
                <div class="craft-item">
                    <h5 class="fw-bold mb-2" style="color: var(--cream);">Dipanggang Langsung Saat Dipesan</h5>
                    <p class="mb-0" style="color: #CBBBA8; font-size: 14px; line-height: 1.75;">
                        Roti dipanggang dengan mentega pilihan tepat ketika pesanan masuk, sehingga aroma harum dan kerenyahannya masih maksimal saat sampai di tanganmu.
                    </p>
                </div>

                <div class="craft-item">
                    <h5 class="fw-bold mb-2" style="color: var(--cream);">Takaran Olesan & Isian Melimpah</h5>
                    <p class="mb-0" style="color: #CBBBA8; font-size: 14px; line-height: 1.75;">
                        Dari selai cokelat crunchy dan krim tiramisu sampai lelehan keju cheddar dan daging patty, semuanya diracik seimbang tanpa pelit topping.
                    </p>
                </div>

                <div class="craft-item">
                    <h5 class="fw-bold mb-2" style="color: var(--cream);">Terbuka untuk Pesanan Acara & Sponsorship</h5>
                    <p class="mb-0" style="color: #CBBBA8; font-size: 14px; line-height: 1.75;">
                        Selain pembelian satuan, kami melayani pesanan jumlah banyak untuk konsumsi kegiatan serta kerja sama sponsorship event kampus dan komunitas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. MENU PILIHAN -->
<section id="menu-pilihan" class="story-section">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
            <div>
                <p class="eyebrow-label">Menu Pilihan</p>
                <h2 class="display-sub mb-0">Yang Paling Sering Dipesan</h2>
            </div>
            <a href="{{ url('/menu') }}" class="btn btn-toast-outline">
                Lihat Semua Varian <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse ($menus as $menu)
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ url('/menu') }}" class="text-decoration-none text-dark">
                        <div class="etalase-card">
                            @if ($menu->gambar)
                                <img src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                            @endif
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: #F0E7DB !important;">
                                <span class="badge rounded-pill {{ $menu->kategori == 'manis' ? 'badge-sweet' : 'badge-salty' }}">
                                    {{ $menu->kategori == 'manis' ? 'Sweet' : 'Salted' }}
                                </span>
                                <small class="text-muted fw-medium">Lihat Detail &rarr;</small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Belum ada data menu.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 5. OUTLET & KONTAK -->
<section id="outlet-kami" class="story-section pt-0">
    <div class="container">
        <div class="outlet-wrapper">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <p class="eyebrow-label">Outlet & Jam Buka</p>
                    <h2 class="display-sub mb-4">Mampir ke {{ $profile->nama_usaha ?? 'Toast.district' }}</h2>

                    <div class="mb-3">
                        <small class="text-uppercase text-muted d-block" style="letter-spacing: 1.5px; font-size: 11px;">Alamat</small>
                        <p class="fw-semibold fs-6 mb-0">{{ $profile->alamat ?? 'Kota Kediri, Jawa Timur' }}</p>
                    </div>

                    <div class="mb-3">
                        <small class="text-uppercase text-muted d-block" style="letter-spacing: 1.5px; font-size: 11px;">Jam Operasional</small>
                        <p class="fw-semibold fs-6 mb-0">{{ $profile->jam_operasional ?? 'Senin - Minggu, 10.00 - 22.00 WIB' }}</p>
                    </div>

                    <div>
                        <small class="text-uppercase text-muted d-block" style="letter-spacing: 1.5px; font-size: 11px;">WhatsApp</small>
                        <p class="fw-semibold fs-6 mb-0">{{ $profile->no_whatsapp ?? '+62 852-3204-9199' }}</p>
                    </div>
                </div>

                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $profile->no_whatsapp ?? '6285232049199');
                @endphp

                <div class="col-lg-6">
                    <div class="p-4 p-md-5 rounded-4" style="background-color: #EFE6D8;">
                        <h4 class="fw-bold mb-2">Pesan Sekarang atau Ajukan Sponsorship</h4>
                        <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.75;">
                            Langsung cek titik lokasi outlet kami di Google Maps, hubungi admin lewat WhatsApp, atau lihat halaman sponsorship untuk kerja sama event.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ $profile->link_maps ?? 'https://share.google/4CLo2bwQs0Di09MrX' }}" target="_blank" class="btn btn-toast">
                                <i class="bi bi-geo-alt me-1"></i> Buka Google Maps
                            </a>
                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="btn btn-toast-outline">
                                <i class="bi bi-whatsapp me-1"></i> Chat WhatsApp
                            </a>
                            <a href="{{ url('/sponsorship') }}" class="btn btn-toast-outline">
                                Info Sponsorship
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('.story-section');
        const railItems = document.querySelectorAll('.rail-item');

        window.addEventListener('scroll', () => {
            let currentId = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 220;
                if (window.scrollY >= sectionTop) {
                    currentId = section.getAttribute('id');
                }
            });

            railItems.forEach(item => {
                item.classList.remove('active');
                if (currentId && item.getAttribute('href') === '#' + currentId) {
                    item.classList.add('active');
                }
            });
        });
    });
</script>

@endsection