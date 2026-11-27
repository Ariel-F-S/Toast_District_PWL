@extends('layouts.master')

@section('title', 'Dashboard Owner | Toast.district')

@section('content')
<section class="py-5" style="background-color: var(--cream); min-height: calc(100vh - 160px);">
    <div class="container">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <span class="text-uppercase fw-semibold" style="font-size: 12px; letter-spacing: 2px; color: var(--brown);">
                    Ringkasan Operasional
                </span>
                <h2 class="fw-bold mb-1" style="color: var(--dark-brown);">Dashboard Owner</h2>
                <p class="text-muted mb-0" style="font-size: 14px;">
                    Pantau performa penjualan dan aktivitas operasional Toast.district hari ini.
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge rounded-pill px-3 py-2" style="background-color: #EFE6D8; color: var(--dark-brown); font-size: 12px;">
                    <i class="bi bi-calendar3 me-1"></i> {{ now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4" style="font-size: 14px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Kartu Statistik (KPI) -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100" style="background-color: #FFFDF9; border: 1px solid #E3D6C5;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted" style="font-size: 13px;">Total Pendapatan (Lunas)</span>
                        <i class="bi bi-wallet2 fs-5" style="color: var(--brown);"></i>
                    </div>
                    <h4 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                    </h4>
                    <small class="text-muted" style="font-size: 12px;">Akumulasi transaksi lunas</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100" style="background-color: #FFFDF9; border: 1px solid #E3D6C5;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted" style="font-size: 13px;">Tunai vs QRIS</span>
                        <i class="bi bi-qr-code-scan fs-5" style="color: var(--brown);"></i>
                    </div>
                    <div style="font-size: 13.5px; color: var(--dark-brown);">
                        <div class="d-flex justify-content-between">
                            <span>Tunai:</span>
                            <strong>Rp {{ number_format($pendapatanTunai ?? 0, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <span>QRIS:</span>
                            <strong>Rp {{ number_format($pendapatanQris ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100" style="background-color: #FFFDF9; border: 1px solid #E3D6C5;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted" style="font-size: 13px;">Total Pesanan</span>
                        <i class="bi bi-bag-check fs-5" style="color: var(--brown);"></i>
                    </div>
                    <h4 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        {{ $totalPesanan ?? 0 }} Pesanan
                    </h4>
                    <small class="text-muted" style="font-size: 12px;">Offline, online, & catering</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100" style="background-color: #FFFDF9; border: 1px solid #E3D6C5;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted" style="font-size: 13px;">Akun & Varian Menu</span>
                        <i class="bi bi-people fs-5" style="color: var(--brown);"></i>
                    </div>
                    <h4 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        {{ $totalUser ?? 0 }} User &bull; {{ $totalMenu ?? 0 }} Menu
                    </h4>
                    <small class="text-muted" style="font-size: 12px;">Pengguna terdaftar & produk aktif</small>
                </div>
            </div>
        </div>

        <!-- Tabel Aktivitas Transaksi Terbaru -->
        <div class="p-4 rounded-4" style="background-color: #FFFDF9; border: 1px solid #E3D6C5;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0" style="color: var(--dark-brown);">Transaksi Terbaru</h5>
                <span class="text-muted" style="font-size: 12.5px;">5 pesanan terakhir</span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" style="font-size: 14px;">
                    <thead style="background-color: #F3EAE0; color: var(--dark-brown); font-size: 12px;">
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pemesan</th>
                            <th>Jenis</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders ?? [] as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->kode_pesanan }}</td>
                                <td>{{ $order->nama_pemesan }}</td>
                                <td class="text-uppercase" style="font-size: 12px;">{{ $order->jenis_pesanan }}</td>
                                <td class="text-uppercase" style="font-size: 12px;">{{ str_replace('_', ' ', $order->jenis_pembayaran) }}</td>
                                <td class="fw-semibold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: #EFE6D8; color: var(--dark-brown);">
                                        {{ str_replace('_', ' ', $order->status_pembayaran) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada data transaksi masuk. Data akan otomatis muncul setelah modul Kasir / Pemesanan Online digunakan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection