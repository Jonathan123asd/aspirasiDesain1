@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="bi bi-plus-circle"></i> Form Pengaduan</h2>
        <p class="text-muted">Silakan isi data pengaduan dengan lengkap</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Data Pengaduan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sarana">Sarana</option>
                            <option value="Prasarana">Prasarana</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Kelas X RPL 1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Pengaduan</label>
                        <textarea name="deskripsi" rows="4" class="form-control" placeholder="Jelaskan masalah secara singkat dan jelas" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send"></i> Kirim Pengaduan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
