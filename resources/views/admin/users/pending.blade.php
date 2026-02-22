@extends('layouts.app')

@section('title', 'Approval Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="bi bi-person-check"></i> Approval Pendaftaran Siswa</h2>
                <p class="text-muted">Siswa yang menunggu persetujuan akun</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
            </a>
        </div>
    </div>
</div>

@if($users->count() > 0)
<div class="row">
    @foreach($users as $user)
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Menunggu Approval</h6>
                    <span class="badge bg-dark">{{ $user->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h5>{{ $user->name }}</h5>
                        <p class="mb-1">
                            <i class="bi bi-envelope"></i> {{ $user->email }}
                        </p>
                        <p class="mb-0">
                            <i class="bi bi-mortarboard"></i> Kelas: {{ $user->kelas }}
                        </p>
                    </div>
                    <div class="col-4 text-end">
                        <div class="btn-group-vertical w-100">
                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-check-lg"></i> Setujui
                                </button>
                            </form>

                            <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-x-lg"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-check-circle display-1 text-success"></i>
        <h4 class="mt-3">Tidak ada pendaftaran menunggu</h4>
        <p class="text-muted">Semua pendaftaran sudah diproses.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
            <i class="bi bi-speedometer2"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endif
@endsection
