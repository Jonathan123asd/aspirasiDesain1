@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- Header Card -->
        <div class="card border-0 rounded-4 p-4 mb-4 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">Dashboard Admin</h2>
                    <p class="text-muted mb-0">
                        Kelola dan Pantau Pengaduan Siswa
                    </p>
                </div>

                <div class="d-flex align-items-center gap-4">
                    <div class="text-end">
                        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">Admin Sekolah</p>
                    </div>

                    <div class="position-relative">
                        <a href="#" class="text-dark">
                            <i class="bi bi-bell fs-4"></i>
                        </a>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.6rem;">
                            0
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Statistik -->
        <div class="row g-4 mb-4">

            @php
                $cards = [
                    ['title' => 'Total Pengaduan', 'value' => $statistik['total'], 'icon' => 'bi-file-earmark-text'],
                    ['title' => 'Menunggu', 'value' => $statistik['pending'], 'icon' => 'bi-clock-history'],
                    ['title' => 'Dalam Proses', 'value' => $statistik['proses'], 'icon' => 'bi-exclamation-triangle'],
                    ['title' => 'Selesai', 'value' => $statistik['selesai'], 'icon' => 'bi-check-circle'],
                ];
            @endphp

            @foreach ($cards as $card)
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

        <div class="card border-0 rounded-4 p-4 bg-light">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Daftar Pengaduan</h5>
                <span class="text-muted small">
                    Total {{ $pengaduan->total() }} Pengaduan
                </span>
            </div>

            <form method="GET" action="{{ route('admin.dashboard') }}">

                <!-- Search & Filter -->
                <div class="row mb-4 g-3">

                    <!-- Search -->
                    <div class="col-md-4">
                        <div class="search-box d-flex align-items-center gap-3">
                            <i class="bi bi-search text-muted"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Pengaduan..." class="border-0 bg-transparent w-100"
                                onkeydown="if(event.key === 'Enter'){ this.form.submit(); }">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-4">
                        <div class="filter-box d-flex align-items-center justify-content-center gap-2 position-relative">
                            <i class="bi bi-funnel text-muted"></i>

                            <select name="status" class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                onchange="this.form.submit()">

                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Dalam Proses
                                </option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>

                            <span>
                                {{ request('status') ? ucfirst(request('status')) : 'Semua Status' }}
                            </span>
                        </div>
                    </div>

                    <!-- Kategori Filter (DINAMIS) -->
                    <div class="col-md-4">
                        <div class="filter-box d-flex align-items-center justify-content-center gap-2 position-relative">
                            <i class="bi bi-tag text-muted"></i>

                            <select name="kategori" class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                onchange="this.form.submit()">

                                <option value="">Semua Kategori</option>

                                @foreach ($kategoriList as $kategori)
                                    <option value="{{ $kategori }}"
                                        {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                        {{ $kategori }}
                                    </option>
                                @endforeach
                            </select>

                            <span>
                                {{ request('kategori') ?? 'Semua Kategori' }}
                            </span>
                        </div>
                    </div>

                </div>
            </form>


            <!-- List Pengaduan -->
            <div class="table-responsive">
                <table class="table align-middle custom-table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengaduan as $item)
                            <tr>
                                <!-- ID -->
                                <td class="fw-semibold text-primary">
                                    C{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                </td>

                                <!-- Judul -->
                                <td>
                                    <div class="fw-semibold">{{ $item->judul }}</div>
                                    <div class="text-muted small">
                                        {{ Str::limit($item->deskripsi, 50) }}
                                    </div>
                                </td>

                                <!-- Siswa -->
                                <td>
                                    <div class="fw-semibold">{{ $item->user->name }}</div>
                                    <div class="text-muted small">{{ $item->user->kelas }}</div>
                                </td>

                                <!-- Kategori -->
                                <td>{{ $item->kategori }}</td>

                                <!-- Status -->
                                <td>
                                    @if ($item->status == 'pending')
                                        <span class="status-badge pending">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    @elseif ($item->status == 'proses')
                                        <span class="status-badge proses">
                                            <i class="bi bi-exclamation-circle"></i> Dalam Proses
                                        </span>
                                    @else
                                        <span class="status-badge selesai">
                                            <i class="bi bi-check-circle"></i> Selesai
                                        </span>
                                    @endif
                                </td>

                                <!-- Tanggal -->
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>

                                <!-- Aksi -->
                                <td class="text-end">
                                    <a href="{{ route('admin.detail', $item->id) }}" class="text-dark">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Belum ada pengaduan masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pengaduan->links() }}
            </div>

        </div>
    </div>




@endsection
@section('scripts')
    <script>
        // Auto close alert setelah 5 detik
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                let alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('input[name="search"]');
            const form = searchInput.closest('form');

            let typingTimer;
            const delay = 500; // 500ms setelah berhenti mengetik

            searchInput.addEventListener('keyup', function() {
                clearTimeout(typingTimer);

                typingTimer = setTimeout(function() {
                    form.submit();
                }, delay);
            });
        });
    </script>


@endsection
