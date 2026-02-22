@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="bi bi-file-text"></i> Detail Pengaduan</h2>
        <p class="text-muted">Informasi lengkap pengaduan siswa</p>
    </div>
</div>

<div class="row">
    <!-- Detail Pengaduan -->
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Data Pengaduan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Nama Siswa</th>
                        <td>{{ $pengaduan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $pengaduan->user->kelas }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $pengaduan->kategori }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td>{{ $pengaduan->lokasi }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ date('d/m/Y', strtotime($pengaduan->tanggal)) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($pengaduan->status == 'pending')
                                <span class="status-badge badge-pending">Pending</span>
                            @elseif($pengaduan->status == 'proses')
                                <span class="status-badge badge-proses">Proses</span>
                            @else
                                <span class="status-badge badge-selesai">Selesai</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <p class="border rounded p-3 bg-light">
                        {{ $pengaduan->deskripsi }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi Admin -->
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0"><i class="bi bi-gear"></i> Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.status', $pengaduan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $pengaduan->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status=='proses'?'selected':'' }}>Proses</option>
                            <option value="selesai" {{ $pengaduan->status=='selesai'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>
                    <button class="btn btn-warning w-100">
                        <i class="bi bi-save"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Respon Admin</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.respon') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">

                    <div class="mb-3">
                        <textarea name="pesan" rows="3" class="form-control" placeholder="Tulis respon untuk siswa" required></textarea>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-send"></i> Kirim Respon
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
