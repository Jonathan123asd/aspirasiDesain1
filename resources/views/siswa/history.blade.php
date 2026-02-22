@extends('layouts.app')

@section('title', 'History Pengaduan')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2><i class="bi bi-clock-history"></i> History Pengaduan</h2>
            <p class="text-muted">Daftar seluruh pengaduan yang pernah kamu buat</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="bi bi-list-check"></i> Data Pengaduan</h5>
        </div>
        <div class="card-body">
            @if ($pengaduan->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Pesan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $item)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ Str::limit($item->deskripsi, 60) }}</td>
                                    <td>{{ $item->lokasi ?? '-' }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="status-badge badge-pending">Pending</span>
                                        @elseif($item->status == 'proses')
                                            <span class="status-badge badge-proses">Proses</span>
                                        @else
                                            <span class="status-badge badge-selesai">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->respon->count())
                                            @foreach ($item->respon as $respon)
                                                <div class="mb-2 p-2 border rounded">
                                                    <strong>{{ $respon->admin->name }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ $respon->created_at->format('d/m/Y H:i') }}
                                                    </small>
                                                    <p class="mb-0">{{ $respon->pesan }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Belum ada respon admin</span>
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
                    <p class="mt-3">Belum ada pengaduan.</p>
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
@endsection
