@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
        <p class="text-muted">Halo, {{ Auth::user()->name }} - Panel Admin Pengaduan Sekolah</p>
    </div>
</div>

<!-- Statistik -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h5><i class="bi bi-list-check"></i> Total Pengaduan</h5>
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

<!-- Filter -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-filter"></i> Filter Pengaduan</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="d-grid w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pengaduan -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Pengaduan</h5>
                <span class="badge bg-light text-dark">Total: {{ $pengaduan->total() }}</span>
            </div>
            <div class="card-body">
                @if($pengaduan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">#</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $index => $item)
                            <tr>
                                <td>{{ $pengaduan->firstItem() + $index }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->kelas }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>
                                    <small>{{ Str::limit($item->deskripsi, 50) }}</small>
                                    @if($item->lokasi)
                                    <br><small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $item->lokasi }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($item->status == 'proses')
                                        <span class="badge bg-info">Proses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.detail', $item->id) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Dropdown untuk ubah status -->
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" title="Ubah Status">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('admin.status', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="status" value="pending" class="dropdown-item">
                                                            <i class="bi bi-clock"></i> Set Pending
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.status', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="status" value="proses" class="dropdown-item">
                                                            <i class="bi bi-gear"></i> Set Proses
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.status', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="status" value="selesai" class="dropdown-item">
                                                            <i class="bi bi-check-circle"></i> Set Selesai
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Menampilkan {{ $pengaduan->firstItem() }} sampai {{ $pengaduan->lastItem() }} dari {{ $pengaduan->total() }} data
                    </div>
                    <div>
                        {{ $pengaduan->links() }}
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="mt-3">Tidak ada pengaduan</h4>
                    <p class="text-muted">Belum ada pengaduan dari siswa.</p>
                </div>
                @endif
            </div>
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
</script>
@endsection
