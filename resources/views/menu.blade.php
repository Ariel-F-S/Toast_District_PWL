@extends('layouts.master')

@section('content')

<style>
    .menu-page {
        background: #f8f5ef;
        min-height: 100vh;
        padding: 65px 0;
    }

    .menu-heading {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 800;
        letter-spacing: 5px;
        color: #30251f;
        line-height: 1;
    }

    .menu-subtitle {
        color: #8b7565;
        letter-spacing: 3px;
        font-size: 13px;
        font-weight: 600;
    }

    .menu-divider {
        border: 0;
        border-top: 1px solid #d9cec1;
        margin: 30px 0 45px;
    }

    .category-btn {
        border: 1px solid #9b806b;
        color: #71543f;
        background: transparent;
        border-radius: 30px;
        padding: 10px 25px;
        transition: .3s;
        font-weight: 600;
    }

    .category-btn:hover,
    .category-btn.active {
        background: #594333;
        color: #fff;
        border-color: #594333;
    }

    .menu-card {
        background: #fffdf9;
        border: 1px solid #eee5da;
        border-radius: 18px;
        overflow: hidden;
        height: 100%;
        transition: .3s;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .menu-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 30px rgba(76, 52, 34, .12);
    }

    .menu-visual {
        aspect-ratio: 4 / 3;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        padding: 14px;
        border-bottom: 1px solid #f1eae0;
        overflow: hidden;
    }

    .menu-visual img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform .3s ease;
    }

    .menu-card:hover .menu-visual img {
        transform: scale(1.05);
    }

    .menu-visual i {
        font-size: 75px;
        color: #8b7059;
    }

    .menu-category {
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 30px;
        display: inline-block;
    }

    .sweet {
        background: #f5e3d6;
        color: #9a5738;
    }

    .salty {
        background: #e8e5d8;
        color: #596342;
    }

    .menu-name {
        font-size: 18px;
        font-weight: 700;
        color: #3c2d24;
        margin-top: 12px;
        margin-bottom: 14px;
    }

    .menu-price {
        font-size: 20px;
        font-weight: 800;
        color: #76543c;
    }

    .btn-detail-toast {
        border: 1px solid #9b806b;
        color: #594333;
        background: transparent;
        border-radius: 20px;
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s;
    }

    .menu-card:hover .btn-detail-toast {
        background: #594333;
        color: #fff;
    }

    .menu-search {
        border: 1px solid #e0d5c8;
        border-radius: 30px;
        padding: 13px 22px;
        background: #fffdf9;
    }

    .menu-search:focus {
        border-color: #9b806b;
        box-shadow: 0 0 0 .2rem rgba(155, 128, 107, .15);
    }

    .menu-empty {
        display: none;
        color: #8b7565;
    }

    /* MODAL DETAIL PRODUK */
    .toast-modal-content {
        background: #fffdf9;
        border: 1px solid #e5dacb;
        border-radius: 22px;
        overflow: hidden;
    }

    .toast-modal-img-wrap {
        background: #ffffff;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f1eae0;
        max-height: 290px;
    }

    .toast-modal-img-wrap img {
        max-height: 250px;
        width: auto;
        max-width: 100%;
        object-fit: contain;
    }

    @media (max-width: 576px) {
        .menu-page {
            padding: 40px 0;
        }

        .menu-heading {
            letter-spacing: 2px;
        }
    }
</style>

<section class="menu-page">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center">
            <p class="menu-subtitle mb-3">TOAST.DISTRICT SIGNATURE COLLECTION</p>

            <h1 class="menu-heading">OUR MENU</h1>

            <p class="text-muted mt-3">
                A little toast, a lot of happiness.
            </p>
        </div>

        <hr class="menu-divider">

        <!-- MENU INTRO -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold" style="color:#49372b;">
                    Find Your Favorite Toast
                </h3>
                <p class="text-muted mb-0">
                    Klik pada kartu menu untuk melihat detail rasa dan ketersediaan.
                </p>
            </div>

            <div class="col-md-6 mt-3 mt-md-0">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="menuSearch"
                        class="form-control menu-search border-start-0"
                        placeholder="Cari menu favoritmu...">
                </div>
            </div>
        </div>

        <!-- CATEGORY FILTER -->
        <div class="d-flex flex-wrap gap-2 mb-5">
            <button class="category-btn active" data-filter="all">
                All Toast
            </button>

            <button class="category-btn" data-filter="manis">
                Sweet Toast
            </button>

            <button class="category-btn" data-filter="asin">
                Salted Toast
            </button>
        </div>

        <!-- SWEET TOAST -->
        <div class="mb-5 category-section" data-section="manis">
            <div class="d-flex align-items-center gap-3 mb-4">
                <h4 class="fw-bold mb-0" style="letter-spacing:2px;color:#49372b;">
                    SWEET TOAST VARIANT
                </h4>
                <div class="flex-grow-1" style="height:1px;background:#d9cec1;"></div>
            </div>

            <div class="row g-4">
                @forelse ($menus->where('kategori', 'manis') as $menu)
                    <div class="col-12 col-sm-6 col-lg-3 menu-item" data-category="{{ $menu->kategori }}">
                        <div class="menu-card"
                            data-bs-toggle="modal"
                            data-bs-target="#menuDetailModal"
                            data-name="{{ $menu->nama_menu }}"
                            data-category="Sweet Toast"
                            data-category-class="sweet"
                            data-description="{{ $menu->deskripsi }}"
                            data-price="Rp{{ number_format($menu->harga, 0, ',', '.') }}"
                            data-stok="{{ $menu->stok }}"
                            data-status="{{ $menu->status_tersedia && $menu->stok > 0 ? 'Tersedia' : 'Habis' }}"
                            data-image="{{ $menu->gambar ? asset($menu->gambar) : '' }}">

                            <div class="menu-visual">
                                @if ($menu->gambar)
                                    <img src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                                @else
                                    <i class="bi bi-cup-hot"></i>
                                @endif
                            </div>

                            <div class="p-3 d-flex flex-column flex-grow-1 justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="menu-category sweet">Sweet Toast</span>
                                        @if (!$menu->status_tersedia || $menu->stok <= 0)
                                            <span class="badge bg-danger rounded-pill">Habis</span>
                                        @endif
                                    </div>
                                    <h5 class="menu-name">{{ $menu->nama_menu }}</h5>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color:#f1eae0 !important;">
                                    <div class="menu-price">Rp{{ number_format($menu->harga, 0, ',', '.') }}</div>
                                    <button type="button" class="btn-detail-toast">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Belum ada menu Sweet Toast yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- SALTED TOAST -->
        <div class="category-section" data-section="asin">
            <div class="d-flex align-items-center gap-3 mb-4">
                <h4 class="fw-bold mb-0" style="letter-spacing:2px;color:#49372b;">
                    SALTED TOAST VARIANT
                </h4>
                <div class="flex-grow-1" style="height:1px;background:#d9cec1;"></div>
            </div>

            <div class="row g-4">
                @forelse ($menus->where('kategori', 'asin') as $menu)
                    <div class="col-12 col-sm-6 col-lg-3 menu-item" data-category="{{ $menu->kategori }}">
                        <div class="menu-card"
                            data-bs-toggle="modal"
                            data-bs-target="#menuDetailModal"
                            data-name="{{ $menu->nama_menu }}"
                            data-category="Salted Toast"
                            data-category-class="salty"
                            data-description="{{ $menu->deskripsi }}"
                            data-price="Rp{{ number_format($menu->harga, 0, ',', '.') }}"
                            data-stok="{{ $menu->stok }}"
                            data-status="{{ $menu->status_tersedia && $menu->stok > 0 ? 'Tersedia' : 'Habis' }}"
                            data-image="{{ $menu->gambar ? asset($menu->gambar) : '' }}">

                            <div class="menu-visual">
                                @if ($menu->gambar)
                                    <img src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                                @else
                                    <i class="bi bi-egg-fried"></i>
                                @endif
                            </div>

                            <div class="p-3 d-flex flex-column flex-grow-1 justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="menu-category salty">Salted Toast</span>
                                        @if (!$menu->status_tersedia || $menu->stok <= 0)
                                            <span class="badge bg-danger rounded-pill">Habis</span>
                                        @endif
                                    </div>
                                    <h5 class="menu-name">{{ $menu->nama_menu }}</h5>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color:#f1eae0 !important;">
                                    <div class="menu-price">Rp{{ number_format($menu->harga, 0, ',', '.') }}</div>
                                    <button type="button" class="btn-detail-toast">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Belum ada menu Salted Toast yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="text-center mt-5 pt-4">
            <p class="menu-subtitle">
                MADE WITH LOVE, SERVED WITH HAPPINESS.
            </p>
            <h5 class="fw-bold" style="color:#49372b;">
                Thank you for choosing Toast.district!
            </h5>
        </div>

        <p id="emptyMessage" class="menu-empty text-center mt-5">
            Menu yang kamu cari belum ditemukan.
        </p>

    </div>
</section>

<!-- MODAL DETAIL PRODUK -->
<div class="modal fade" id="menuDetailModal" tabindex="-1" aria-labelledby="menuDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content toast-modal-content">
            <div class="modal-header border-0 pb-0">
                <span id="modalMenuCategory" class="menu-category sweet">Sweet Toast</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast-modal-img-wrap mt-2">
                <img id="modalMenuImage" src="" alt="Menu Image">
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <h4 id="modalMenuName" class="fw-bold mb-0" style="color:#3c2d24;">Nama Menu</h4>
                    <span id="modalMenuStatus" class="badge rounded-pill bg-success">Tersedia</span>
                </div>
                <p id="modalMenuDescription" class="text-muted mb-4" style="line-height: 1.6;">
                    Deskripsi menu lengkap.
                </p>
                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color:#eee5da !important;">
                    <div>
                        <small class="text-muted d-block">Harga</small>
                        <span id="modalMenuPrice" class="menu-price">Rp10.000</span>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Sisa Stok</small>
                        <span id="modalMenuStok" class="fw-bold" style="color:#49372b;">50 porsi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('menuSearch');
    const filterButtons = document.querySelectorAll('.category-btn');
    const menuItems = document.querySelectorAll('.menu-item');
    const categorySections = document.querySelectorAll('.category-section');
    const emptyMessage = document.getElementById('emptyMessage');

    let activeFilter = 'all';

    function filterMenu() {
        const keyword = searchInput.value.toLowerCase();
        let visibleCount = 0;

        menuItems.forEach(item => {
            const name = item.querySelector('.menu-name').textContent.toLowerCase();
            const category = item.dataset.category;

            const matchesSearch = name.includes(keyword);
            const matchesCategory = activeFilter === 'all' || category === activeFilter;

            if (matchesSearch && matchesCategory) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        categorySections.forEach(section => {
            const sectionCat = section.dataset.section;
            if (activeFilter !== 'all' && sectionCat !== activeFilter) {
                section.style.display = 'none';
            } else {
                section.style.display = '';
            }
        });

        emptyMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filterMenu);

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            filterButtons.forEach(btn => btn.classList.remove('active'));

            this.classList.add('active');
            activeFilter = this.dataset.filter;

            filterMenu();
        });
    });

    // Isi data ke Modal Detail Produk saat kartu diklik
    const menuDetailModal = document.getElementById('menuDetailModal');
    menuDetailModal.addEventListener('show.bs.modal', function (event) {
        const card = event.relatedTarget;

        const name = card.getAttribute('data-name');
        const category = card.getAttribute('data-category');
        const categoryClass = card.getAttribute('data-category-class');
        const description = card.getAttribute('data-description');
        const price = card.getAttribute('data-price');
        const stok = card.getAttribute('data-stok');
        const status = card.getAttribute('data-status');
        const image = card.getAttribute('data-image');

        document.getElementById('modalMenuName').textContent = name;
        document.getElementById('modalMenuDescription').textContent = description;
        document.getElementById('modalMenuPrice').textContent = price;
        document.getElementById('modalMenuStok').textContent = stok + ' porsi';

        const catBadge = document.getElementById('modalMenuCategory');
        catBadge.textContent = category;
        catBadge.className = 'menu-category ' + categoryClass;

        const statusBadge = document.getElementById('modalMenuStatus');
        statusBadge.textContent = status;
        statusBadge.className = status === 'Tersedia' ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger';

        const imgEl = document.getElementById('modalMenuImage');
        imgEl.src = image;
        imgEl.alt = name;
    });
</script>

@endsection