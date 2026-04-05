@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.kategori.index') }}"
                   class="btn btn-light rounded-circle shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div>
                    <h4 class="fw-bold mb-1">Detail Kategori</h4>
                    <p class="text-muted small mb-0">
                        Informasi lengkap kategori
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.kategori.edit', $kategori) }}"
               class="btn btn-primary rounded-3 px-4 d-flex align-items-center gap-2">
                <i class="bi bi-pencil"></i> Edit
            </a>

        </div>
    </div>


    {{-- DETAIL CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="row g-4">

                {{-- ID --}}
                <div class="col-md-6">
                    <label class="form-label text-muted small">ID Kategori</label>
                    <div class="fw-semibold fs-5 text-primary">
                        C{{ str_pad($kategori->id, 3, '0', STR_PAD_LEFT) }}
                    </div>
                </div>


                {{-- Nama --}}
                <div class="col-12">
                    <label class="form-label text-muted small">Nama Kategori</label>
                    <div class="fw-semibold fs-5">
                        {{ $kategori->nama_kategori }}
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="col-12">
                    <label class="form-label text-muted small">Deskripsi</label>
                    <div class="text-muted">
                        {{ $kategori->deskripsi ?? '-' }}
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
