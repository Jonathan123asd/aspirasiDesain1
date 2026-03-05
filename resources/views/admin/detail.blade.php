@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="container-fluid px-4 py-4">

{{-- ================= HEADER CARD ================= --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body px-4 py-4">

        <div class="d-flex justify-content-between align-items-center">

            {{-- Kiri --}}
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none d-flex align-items-center">
                    <i class="bi bi-arrow-left" style="font-size: 2rem;"></i>
                </a>
                <div>
                    <h4 class="fw-bold mb-1" style="font-size: 1.5rem;">Detail Pengaduan</h4>
                    <small class="text-muted" style="font-size: 0.9rem;">ID: C00{{ $pengaduan->id }}</small>
                </div>
            </div>

            {{-- Kanan - STATUS BESAR --}}
            @if ($pengaduan->status == 'pending')
                <span class="badge bg-warning-subtle text-warning px-5 py-3 rounded-pill fw-semibold d-flex align-items-center" style="font-size: 1.1rem; gap: 8px;">
                    <i class="bi bi-clock" style="font-size: 1.3rem;"></i>
                    Pending
                </span>
            @elseif($pengaduan->status == 'proses')
                <span class="badge bg-primary-subtle text-primary px-5 py-3 rounded-pill fw-semibold d-flex align-items-center" style="font-size: 1.1rem; gap: 8px;">
                    <i class="bi bi-exclamation-circle" style="font-size: 1.3rem;"></i>
                    Dalam Proses
                </span>
            @else
                <span class="badge bg-success-subtle text-success px-5 py-3 rounded-pill fw-semibold d-flex align-items-center" style="font-size: 1.1rem; gap: 8px;">
                    <i class="bi bi-check-circle" style="font-size: 1.3rem;"></i>
                    Selesai
                </span>
            @endif

        </div>

    </div>
</div>

        {{-- ================= DETAIL CARD ================= --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                {{-- Judul --}}
                <h5 class="fw-bold mb-4">
                    {{ $pengaduan->judul ?? $pengaduan->kategori }}
                </h5>

                {{-- Info Row dengan ikon --}}
                <div class="row mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                            <i class="bi-file-earmark-text"></i>
                            <span>Kategori</span>
                        </div>
                        <div class="fw-semibold ps-4">
                            {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                            <i class="bi bi-geo-alt"></i>
                            <span>Lokasi</span>
                        </div>
                        <div class="fw-semibold ps-4">
                            {{ $pengaduan->lokasi }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span>Urgensi</span>
                        </div>
                        <div class="fw-semibold ps-4">
                            {{ $pengaduan->urgensi ?? 'Normal' }}
                        </div>
                    </div>
                </div>

                {{-- Informasi Pelapor --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                        <i class="bi bi-person"></i>
                        <span>Dilaporkan oleh</span>
                    </div>
                    <div class="fw-semibold ps-4">
                        {{ $pengaduan->user->name ?? '-' }}
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                        <i class="bi bi-card-text"></i>
                        <span>Deskripsi</span>
                    </div>
                    <div class="bg-light rounded-3 p-3 ps-4">
                        {{ $pengaduan->deskripsi }}
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                        <i class="bi bi-image"></i>
                        <span>Foto Pendukung</span>
                    </div>
                    <div class="bg-light rounded-3 p-4 text-center">
                        @if ($pengaduan->image)
                            <img src="{{ asset('storage/' . $pengaduan->image) }}" class="img-fluid rounded-3"
                                style="max-height:260px; width: auto;">
                        @else
                            <span class="text-muted">Ini Foto</span>
                        @endif
                    </div>
                </div>

                {{-- Respon Terakhir (jika ada) --}}
                @if ($pengaduan->respon && $pengaduan->respon->count())
                    @php $lastRespon = $pengaduan->respon->last(); @endphp
                    <div class="bg-success-subtle rounded-3 p-3 mt-3">
                        <div class="d-flex align-items-center gap-2 text-success mb-2">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="fw-semibold">Telah dikonfirmasi</span>
                        </div>
                        <p class="mb-0 ps-4">{{ $lastRespon->pesan }}</p>
                    </div>
                @endif

            </div>
        </div>

        {{-- ================= UPDATE STATUS ================= --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-3">Update Status</h6>

                <form action="{{ route('admin.status', $pengaduan->id) }}" method="POST">
                    @csrf
                    <div class="d-flex flex-column gap-2">
                        <button type="submit" name="status" value="pending" class="btn btn-outline-warning rounded-pill px-4 py-2 text-start">
                            <i class="bi bi-clock me-1"></i>
                            Set Ke Pending
                        </button>

                        <button type="submit" name="status" value="proses" class="btn btn-outline-primary rounded-pill px-4 py-2 text-start">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Set Ke Dalam Proses
                        </button>

                        <button type="submit" name="status" value="selesai" class="btn btn-success rounded-pill px-4 py-2 text-start">
                            <i class="bi bi-check-circle me-1"></i>
                            Tandai Selesai
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ================= TIMELINE ================= --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Timeline</h6>

                <div class="timeline">
                    {{-- Dibuat --}}
                    <div class="d-flex gap-3 mb-3">
                        <div class="timeline-dot bg-primary mt-1"></div>
                        <div>
                            <div class="fw-semibold">Pengaduan Dibuat</div>
                            <small class="text-muted">
                                {{ $pengaduan->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                    </div>

                    {{-- Semua Respon --}}
                    @if ($pengaduan->respon && $pengaduan->respon->count())
                        @foreach ($pengaduan->respon as $res)
                            <div class="d-flex gap-3 mb-3">
                                <div class="timeline-dot bg-success mt-1"></div>
                                <div>
                                    <div class="fw-semibold">Respon Diberikan</div>
                                    <small class="text-muted">
                                        oleh {{ $res->user->name ?? 'Admin' }} • {{ $res->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- Selesai --}}
                    @if ($pengaduan->status == 'selesai')
                        <div class="d-flex gap-3">
                            <div class="timeline-dot bg-success mt-1"></div>
                            <div>
                                <div class="fw-semibold text-success">Ditandai Selesai</div>
                                <small class="text-muted">
                                    {{ $pengaduan->updated_at->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= FORM RESPON ================= --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Respon Admin</h6>

                <form action="{{ route('admin.respon') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">

                    <div class="mb-3">
                        <textarea name="pesan" rows="4" class="form-control rounded-3"
                            placeholder="Tulis respon untuk siswa" required>{{ old('pesan') }}</textarea>
                    </div>

                    <button class="btn btn-success rounded-3 px-4">
                        <i class="bi bi-send me-1"></i>
                        Kirim Respon
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('styles')
<style>
    .timeline-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .bg-warning-subtle {
        background-color: #fff3cd !important;
    }
    .bg-primary-subtle {
        background-color: #cfe2ff !important;
    }
    .bg-success-subtle {
        background-color: #d1e7dd !important;
    }
    .rounded-3 {
        border-radius: 12px !important;
    }
    .rounded-4 {
        border-radius: 16px !important;
    }
</style>
@endpush
