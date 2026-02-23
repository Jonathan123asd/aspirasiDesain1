@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted mb-0">
            Selamat Datang {{ Auth::user()->name }}
        </p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-4">

        @php
            $cards = [
                ['title' => 'Total Pengaduan', 'value' => $statistik['total'], 'icon' => 'bi-file-earmark-text'],
                ['title' => 'Menunggu', 'value' => $statistik['pending'], 'icon' => 'bi-clock-history'],
                ['title' => 'Dalam Proses', 'value' => $statistik['proses'], 'icon' => 'bi-exclamation-triangle'],
                ['title' => 'Selesai', 'value' => $statistik['selesai'], 'icon' => 'bi-check-circle']
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-3">
            <div class="card stat-card border-0 rounded-4 p-4 text-center">
                <div class="icon-box mb-3">
                    <i class="bi {{ $card['icon'] }} fs-3"></i>
                </div>
                <h6 class="text-muted mb-2">{{ $card['title'] }}</h6>
                <h2 class="fw-bold mb-0">{{ $card['value'] }}</h2>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Banner CTA -->
    <div class="card border-0 rounded-4 p-4 text-white mb-5 cta-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="fw-bold">Ada Keluhan?</h5>
                <p class="mb-3">Laporkan Sarana dan Prasarana yang Rusak di Sekolah</p>
                <a href="{{ route('siswa.form') }}" class="btn btn-light rounded-pill px-4 fw-semibold">
                    + Buat Pengaduan Baru
                </a>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <i class="bi bi-file-earmark-text display-3 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Pengaduan Terbaru -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Pengaduan Terbaru</h5>
        <a href="{{ route('siswa.history') }}" class="text-decoration-none fw-semibold">
            Lihat Semua
        </a>
    </div>

    @forelse($pengaduan as $item)
    <div class="card border-0 rounded-4 p-4 mb-3 complaint-card">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="fw-bold mb-0">{{ $item->kategori }}</h6>

            @if($item->status == 'pending')
                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">Menunggu</span>
            @elseif($item->status == 'proses')
                <span class="badge rounded-pill bg-primary px-3 py-2">Dalam Proses</span>
            @else
                <span class="badge rounded-pill bg-success px-3 py-2">Selesai</span>
            @endif
        </div>

        <p class="text-muted mb-3">
            {{ Str::limit($item->deskripsi, 120) }}
        </p>

        <div class="small text-muted">
            <i class="bi bi-calendar"></i>
            {{ date('d/m/Y', strtotime($item->tanggal)) }}
        </div>

    </div>
    @empty
        <div class="text-center py-5">
            <i class="bi bi-inbox display-4 text-muted"></i>
            <p class="mt-3">Belum ada pengaduan.</p>
            <a href="{{ route('siswa.form') }}" class="btn btn-primary rounded-pill px-4">
                Buat Pengaduan
            </a>
        </div>
    @endforelse

</div>


<style>

body {
    background: #f5f7fb;
}

.stat-card {
    background: #ffffff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
}

.icon-box {
    width: 60px;
    height: 60px;
    background: #eef2ff;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
}

.cta-banner {
    background: linear-gradient(135deg, #2f5de2, #4f8dfd);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
}

.complaint-card {
    background: #ffffff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
    transition: 0.3s ease;
}

.complaint-card:hover {
    transform: translateY(-3px);
}

</style>

@endsection
