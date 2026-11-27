@extends('layouts.master')

@section('title', '403 Akses Ditolak | Toast.district')

@section('content')
<section class="py-5 d-flex align-items-center" style="min-height: calc(100vh - 180px); background-color: var(--cream);">
    <div class="container text-center">
        <div class="mx-auto p-4 p-md-5 rounded-4" style="max-width: 540px; background-color: #FFFDF9; border: 1px solid #E3D6C5; box-shadow: 0 14px 35px rgba(56, 39, 31, 0.05);">
            <div class="mb-3">
                <i class="bi bi-shield-lock" style="font-size: 56px; color: var(--brown);"></i>
            </div>
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: #F5E3D6; color: #9A5738; font-size: 12px; letter-spacing: 1.5px;">
                ERROR 403 &bull; FORBIDDEN
            </span>
            <h2 class="fw-bold mb-3" style="color: var(--dark-brown);">Akses Ditolak</h2>
            <p class="text-muted mb-4" style="font-size: 14.5px; line-height: 1.75;">
                {{ $exception->getMessage() ?: 'Maaf, akunmu tidak memiliki hak akses untuk membuka halaman ini.' }}
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ url('/') }}" class="btn btn-toast px-4">
                    <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection