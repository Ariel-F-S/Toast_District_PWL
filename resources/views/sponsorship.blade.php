@extends('layouts.master')

@section('title', 'Sponsorship | ' . ($profile->nama_usaha ?? 'Toast.district'))

@section('content')

@php
    $waNumber = preg_replace('/[^0-9]/', '', $profile->no_wa_sponsorship ?? '6285232049199');
    $waMessage = urlencode($profile->pesan_default_sponsorship ?? 'Halo Toast.district, kami tertarik untuk mengajukan kerja sama sponsorship acara.');
    $waUrl = "https://wa.me/{$waNumber}?text={$waMessage}";
@endphp

<section class="py-5">
    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <span class="text-uppercase fw-semibold" style="letter-spacing: 2px; font-size: 12px; color: var(--brown);">
                    Partnership Opportunity
                </span>

                <h1 class="fw-bold display-5 mt-3" style="color: var(--dark-brown);">
                    Let's Create Something
                    <span style="color: var(--brown);">Delicious!</span>
                </h1>

                <p class="text-muted mt-3" style="line-height: 1.8;">
                    <strong>{{ $profile->nama_usaha ?? 'Toast.district' }}</strong> membuka kesempatan kolaborasi dan kerja sama sponsorship dengan berbagai pihak di {{ $profile->alamat ?? 'Kota Kediri, Jawa Timur' }} untuk menciptakan pengalaman dan kegiatan yang menarik.
                </p>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="#requirements" class="btn btn-toast">
                        Lihat Persyaratan
                    </a>
                    <a href="{{ $waUrl }}" target="_blank" class="btn btn-toast-outline">
                        <i class="bi bi-whatsapp me-1"></i> Ajukan via WhatsApp
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="rounded-4 p-5 text-center" style="background-color: #FFFDF9; border: 1px solid #E5D9C8;">
                    <i class="bi bi-people display-1" style="color: var(--brown);"></i>
                    <h4 class="fw-bold mt-3" style="color: var(--dark-brown);">Grow Together</h4>
                    <p class="text-muted mb-0">
                        Build meaningful partnerships with {{ $profile->nama_usaha ?? 'Toast.district' }}.
                    </p>
                </div>
            </div>

        </div>

        <div class="row justify-content-center mt-5 pt-3" id="requirements">
            <div class="col-lg-8">

                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: var(--dark-brown);">Sponsorship Requirements</h2>
                    <p class="text-muted">
                        Beberapa informasi yang perlu disiapkan sebelum mengajukan kerja sama.
                    </p>
                </div>

                <div class="card border-0 shadow-sm rounded-4" style="background-color: #FFFDF9; border: 1px solid #EAE0D2 !important;">
                    <div class="card-body p-4 p-md-5">

                        <div class="d-flex gap-3 mb-4">
                            <i class="bi bi-check-circle-fill fs-4" style="color: var(--brown);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Informasi Kegiatan</h6>
                                <p class="text-muted mb-0" style="font-size: 14px;">
                                    Nama, tema, jadwal, dan tujuan kegiatan yang akan diselenggarakan.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <i class="bi bi-check-circle-fill fs-4" style="color: var(--brown);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Proposal Kerja Sama</h6>
                                <p class="text-muted mb-0" style="font-size: 14px;">
                                    Gambaran kegiatan, estimasi peserta, dan bentuk kerja sama yang ditawarkan.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <i class="bi bi-check-circle-fill fs-4" style="color: var(--brown);"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Informasi Penanggung Jawab</h6>
                                <p class="text-muted mb-0" style="font-size: 14px;">
                                    Nama dan kontak person panitia yang dapat dihubungi oleh tim {{ $profile->nama_usaha ?? 'Toast.district' }}.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center mt-5 p-4 p-md-5 rounded-4" style="background-color: #EFE6D8;">
                    <h5 class="fw-bold" style="color: var(--dark-brown);">Interested in collaborating?</h5>
                    <p class="text-muted mb-2">
                        Hubungi tim {{ $profile->nama_usaha ?? 'Toast.district' }} untuk informasi lebih lanjut.
                    </p>
                    <p class="fw-semibold mb-4" style="color: var(--brown); font-size: 14px;">
                        <i class="bi bi-whatsapp me-1"></i> {{ $profile->no_wa_sponsorship ?? '+62 852-3204-9199' }}
                    </p>

                    <a href="{{ $waUrl }}"
                        target="_blank"
                        class="btn btn-toast px-4 py-2">
                        <i class="bi bi-whatsapp me-2"></i>
                        Hubungi via WhatsApp
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection