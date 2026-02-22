@extends('layouts.app')

@section('title', 'Registrasi Berhasil')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-check-circle"></i> Registrasi Berhasil</h4>
            </div>
            <div class="card-body py-5">
                <div class="mb-4">
                    <i class="bi bi-clock display-1 text-warning"></i>
                </div>
                <h4 class="mb-3">Menunggu Persetujuan Admin</h4>
                <p class="text-muted mb-4">
                    Terima kasih telah mendaftar! Akun Anda sedang menunggu persetujuan dari admin sekolah.
                    Anda akan mendapatkan notifikasi via email setelah akun disetujui.
                </p>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    <strong>Estimasi waktu:</strong> 1-2 hari kerja
                </div>

                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
