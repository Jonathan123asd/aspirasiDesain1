@extends('layouts.app')

@section('title', 'Buat Pengaduan Baru')

@section('content')

<div class="card border-0 rounded-4 shadow-sm mb-4">
    <div class="card-body px-4 py-4">

        <h1 class="fw-bold mb-2" style="font-size: 28px;">
            Buat Pengaduan Baru
        </h1>

        <p class="text-muted mb-0" style="font-size: 15px;">
            Laporkan Sarana dan Prasarana yang Bermasalah
        </p>

    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label class="form-label">Judul Pengaduan</label>
                <input type="text" name="judul" class="form-control"
                    placeholder="Contoh : AC Tidak Dingin Di Lab A" required>
            </div>

            {{-- Kategori & Lokasi --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option disabled selected>Pilih Kategori</option>
                        <option value="Sarana">Sarana</option>
                        <option value="Prasarana">Prasarana</option>
                        <option value="Lingkungan">Lingkungan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                        placeholder="Contoh : Lab RPS" required>
                </div>
            </div>

            {{-- Tingkat Urgensi --}}
            <div class="mb-4">
                <label class="form-label">Tingkat Urgensi</label>

                <div class="d-flex gap-4">

                    <label class="urgency-option low active">
                        <input type="radio" name="urgensi" value="Rendah" checked>
                        <div>
                            <i class="bi bi-exclamation-circle fs-1"></i>
                            <div class="mt-2 fw-semibold">Rendah</div>
                        </div>
                    </label>

                    <label class="urgency-option medium">
                        <input type="radio" name="urgensi" value="Sedang">
                        <div>
                            <i class="bi bi-exclamation-circle fs-1"></i>
                            <div class="mt-2 fw-semibold">Sedang</div>
                        </div>
                    </label>

                    <label class="urgency-option high">
                        <input type="radio" name="urgensi" value="Tinggi">
                        <div>
                            <i class="bi bi-exclamation-circle fs-1"></i>
                            <div class="mt-2 fw-semibold">Tinggi</div>
                        </div>
                    </label>

                </div>
            </div>

            {{-- Foto --}}
            <div class="mb-4">
                <label class="form-label">Foto Pendukung</label>
                <input type="file" name="foto" class="form-control">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="form-label">Jelaskan Detail Masalah Yang Anda Temukan</label>
                <textarea name="deskripsi" rows="4"
                    class="form-control"
                    placeholder="Jelaskan kondisi dengan detail untuk memudahkan penanganan"
                    required></textarea>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('siswa.dashboard') }}"
                    class="btn btn-outline-secondary rounded-3 px-4">
                    Batal
                </a>

                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-send me-2"></i> Kirim Pengaduan
                </button>
            </div>

        </form>

    </div>
</div>

{{-- Script Urgency Active Toggle --}}
<script>
document.querySelectorAll('.urgency-option').forEach(option => {
    option.addEventListener('click', function () {
        document.querySelectorAll('.urgency-option').forEach(o => o.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>

@endsection
