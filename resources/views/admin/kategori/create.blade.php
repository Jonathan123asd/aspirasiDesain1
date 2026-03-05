@extends('layouts.app')

@section('title', 'Buat Kategori')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-1">Buat Kategori Baru</h4>
            <p class="text-muted small mb-0">
                Tambahkan kategori baru untuk pengaduan
            </p>
        </div>
    </div>


    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            {{-- ERROR GLOBAL --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    {{-- Nama Kategori --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="nama_kategori"
                               value="{{ old('nama_kategori') }}"
                               class="form-control @error('nama_kategori') is-invalid @enderror"
                               placeholder="Contoh: Sarana">

                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi"
                                  rows="4"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Deskripsikan kategori ini">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.kategori.index') }}"
                       class="btn btn-outline-secondary rounded-3 px-4">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary rounded-3 px-4 d-flex align-items-center gap-2">
                        <i class="bi bi-check-lg"></i>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
