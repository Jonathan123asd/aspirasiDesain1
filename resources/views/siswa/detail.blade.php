    @extends('layouts.app')

    @section('title', 'Detail Pengaduan')

    @section('content')

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1 class="fw-bold">Detail Pengaduan</h1>

            <a href="{{ route('siswa.history') }}" class="text-dark">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
        </div>

        <div class="card border-0 rounded-4 p-4 bg-light">

            {{-- STATUS --}}
            <div class="mb-3">
                @if ($pengaduan->status == 'pending')
                    <span class="badge rounded-pill bg-warning px-3 py-1">
                        <i class="bi bi-clock me-1"></i> Menunggu
                    </span>
                @elseif($pengaduan->status == 'proses')
                    <span class="badge rounded-pill bg-primary px-3 py-2">
                        <i class="bi bi-exclamation-circle me-1"></i> Dalam Proses
                    </span>
                @else
                    <span class="badge rounded-pill bg-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i> Selesai
                    </span>
                @endif
            </div>

            {{-- JUDUL --}}
            <h4 class="fw-semibold mb-2">
                {{ $pengaduan->judul }}
            </h4>

            {{-- META --}}
            <div class="d-flex gap-4 text-muted mb-4">
                <span><i class="bi bi-tag"></i> {{ $pengaduan->kategori }}</span>
                <span><i class="bi bi-geo-alt"></i> {{ $pengaduan->lokasi }}</span>
                <span><i class="bi bi-calendar"></i>
                    {{ date('d/m/Y', strtotime($pengaduan->tanggal)) }}
                </span>
            </div>

            {{-- DESKRIPSI --}}
            <h6 class="fw-semibold">Deskripsi</h6>
            <p class="mb-4">
                {{ $pengaduan->deskripsi }}
            </p>

            {{-- FOTO --}}
            <h6 class="fw-semibold">Foto Pendukung</h6>

            @if ($pengaduan->image)
                <div class="foto-wrapper mb-4">
                    <img src="{{ asset('storage/' . $pengaduan->image) }}" class="w-100 rounded-4 foto-detail">
                </div>
            @else
                <div class="border rounded-4 p-5 text-center mb-4 bg-white text-muted">
                    <i class="bi bi-image fs-1 d-block mb-2"></i>
                    Tidak ada foto
                </div>
            @endif

            {{-- URGENSI --}}
            <h6 class="fw-semibold mt-4">Tingkat Urgensi</h6>

            @php
                $urgensiClass = '';
                $urgensiIcon = '';

                switch ($pengaduan->urgensi) {
                    case 'Tinggi':
                        $urgensiClass = 'urgensi-tinggi';
                        $urgensiIcon = 'bi-exclamation-triangle-fill';
                        break;
                    case 'Sedang':
                        $urgensiClass = 'urgensi-sedang';
                        $urgensiIcon = 'bi-exclamation-circle-fill';
                        break;
                    default:
                        $urgensiClass = 'urgensi-rendah';
                        $urgensiIcon = 'bi-check-circle-fill';
                        break;
                }
            @endphp

            <span class="urgensi-box {{ $urgensiClass }} d-inline-flex align-items-center px-3 py-2">
                <i class="bi {{ $urgensiIcon }} me-2"></i>
                {{ $pengaduan->urgensi }}
            </span>

            {{-- RESPON --}}
            <h6 class="fw-semibold mt-4">
                <i class="bi bi-chat-dots me-2"></i>
                Respon Dari Admin
            </h6>

            @if ($pengaduan->respon && $pengaduan->respon->count())
                <div class="mt-2 p-4 rounded-4" style="background:#e9fdf3; border:1px solid #b7f0d2;">

                    <p class="mb-1">
                        {{ $pengaduan->respon->first()->pesan }}
                    </p>

                    <small class="text-muted">
                        {{ $pengaduan->respon->first()->created_at->format('d F Y H:i') }}
                    </small>

                </div>
            @else
                <div class="mt-2 p-4 rounded-4 text-muted text-center"
                    style="background:#f8f9fa; border:1px dashed #dee2e6;">

                    <i class="bi bi-chat-left-text fs-1 d-block mb-2"></i>
                    Belum ada respon dari admin
                </div>
            @endif

        </div>

    @endsection
