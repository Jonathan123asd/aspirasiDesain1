@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')

    <div class="mb-4">
        <h1 class="fw-bold" style="font-size:32px;">Riwayat Pengaduan</h1>
        <p class="text-muted">Lihat Status dan Riwayat Pengaduan Anda</p>
    </div>

    <div class="card border-0 rounded-4 p-4 bg-light">

        <form method="GET" action="{{ route('siswa.history') }}">
            {{-- Search & Filter --}}
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="search-box d-flex align-items-center gap-3">
                        <i class="bi bi-search text-muted"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari Pengaduan...">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="filter-box d-flex align-items-center justify-content-center gap-2 position-relative">
                        <i class="bi bi-funnel text-muted"></i>

                        <select name="status" class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                            onchange="this.form.submit()">

                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Dalam Proses
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>

                        <span>
                            {{ request('status') ? ucfirst(request('status')) : 'Semua Status' }}
                        </span>
                    </div>
                </div>
            </div>
        </form>

        {{-- List Pengaduan --}}
        @if ($pengaduan->count())

            @foreach ($pengaduan as $item)
                <a href="{{ route('pengaduan.show', $item->id) }}" class="text-decoration-none text-dark">

                    <div class="pengaduan-card mb-4 p-4 bg-white rounded-4 shadow-sm">

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold mb-0">
                                {{ $item->judul ?? 'Pengaduan' }}
                            </h5>

                            @if ($item->status == 'pending')
                                <span class="status-pill status-pending">
                                    <i class="bi bi-clock me-1"></i> Pending
                                </span>
                            @elseif($item->status == 'proses')
                                <span class="status-pill status-proses">
                                    <i class="bi bi-exclamation-circle me-1"></i> Dalam Proses
                                </span>
                            @elseif($item->status == 'selesai')
                                <span class="status-pill status-selesai">
                                    <i class="bi bi-check-circle me-1"></i> Selesai
                                </span>
                            @endif
                        </div>

                        {{-- Deskripsi --}}
                        <p class="mb-4">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                        </p>

                        {{-- Meta Info --}}
                        <div class="d-flex flex-wrap gap-4 meta-info">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-tag"></i>
                                <span>{{ $item->kategori }}</span>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $item->lokasi ?? 'Tidak tersedia' }}</span>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar"></i>
                                <span>{{ date('d/m/Y', strtotime($item->tanggal)) }}</span>
                            </div>

                            @if ($item->respon->count())
                                <div class="d-flex align-items-center gap-2 text-success">
                                    <i class="bi bi-chat-dots"></i>
                                    <span>Ada Respon</span>
                                </div>
                            @endif
                        </div>

                    </div>

                </a>
            @endforeach
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox display-4 text-muted"></i>
                <p class="mt-3 text-muted">Belum ada pengaduan yang dibuat.</p>
            </div>

        @endif

    </div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector('input[name="search"]');
    const form = searchInput.closest('form');

    let typingTimer;
    const delay = 500; // 500ms setelah berhenti mengetik

    searchInput.addEventListener('keyup', function () {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            form.submit();
        }, delay);
    });
});
</script>
