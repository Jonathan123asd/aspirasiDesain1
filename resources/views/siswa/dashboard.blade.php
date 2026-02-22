@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="bi bi-house-door"></i> Dashboard Siswa</h2>
        <p class="text-muted">Selamat datang, {{ Auth::user()->name }} (Kelas: {{ Auth::user()->kelas }})</p>
    </div>
</div>

<!-- Statistik -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h5><i class="bi bi-list-check"></i> Total</h5>
                <h2>{{ $statistik['total'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body text-center">
                <h5><i class="bi bi-clock"></i> Pending</h5>
                <h2>{{ $statistik['pending'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h5><i class="bi bi-gear"></i> Proses</h5>
                <h2>{{ $statistik['proses'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h5><i class="bi bi-check-circle"></i> Selesai</h5>
                <h2>{{ $statistik['selesai'] }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-grid gap-2 d-md-flex">
            <a href="{{ route('siswa.form') }}" class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i> Buat Pengaduan Baru
            </a>
            <a href="{{ route('siswa.history') }}" class="btn btn-secondary">
                <i class="bi bi-clock-history"></i> Lihat Semua Pengaduan
            </a>
        </div>
    </div>
</div>

<!-- Pengaduan Terbaru -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-clock"></i> Pengaduan Terbaru</h5>
            </div>
            <div class="card-body">
                @if($pengaduan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>    
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $item)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>
                                    @if($item->status == 'pending')
                                        <span class="status-badge badge-pending">Pending</span>
                                    @elseif($item->status == 'proses')
                                        <span class="status-badge badge-proses">Proses</span>
                                    @else
                                        <span class="status-badge badge-selesai">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="mt-3">Belum ada pengaduan. Yuk buat pengaduan pertama!</p>
                    <a href="{{ route('siswa.form') }}" class="btn btn-primary">Buat Pengaduan</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
