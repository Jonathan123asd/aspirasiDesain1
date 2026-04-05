@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- HEADER --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Kategori</h4>
                    <p class="text-muted mb-0 small">
                        Kelola dan Pantau Kategori Pengaduan
                    </p>
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                    class="btn btn-primary rounded-3 px-4 d-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i> Tambah
                </a>
            </div>
        </div>


        {{-- TABLE CARD --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                {{-- Header Table --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-semibold mb-0">Daftar Kategori</h6>
                    <span class="text-muted small">
                        Total {{ $kategori->total() }} Data
                    </span>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('admin.kategori.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">

                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-start-0" placeholder="Cari kategori...">

                                <button class="btn btn-primary">
                                    Cari
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

                {{-- TABLE --}}
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">ID</th>
                                <th width="25%">Nama</th>
                                <th>Deskripsi</th>
                                <th width="20%" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategori as $item)
                                <tr>
                                    <td class="fw-semibold text-primary">
                                        C{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $item->nama_kategori }}
                                    </td>

                                    <td class="text-muted">
                                        {{ $item->deskripsi ?? '-' }}
                                    </td>

                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('admin.kategori.detail', $item) }}"
                                                class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.kategori.edit', $item) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.kategori.destroy', $item) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Belum ada kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-4">
                    {{ $kategori->withQueryString()->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
@section('scripts')

    {{-- SWEETALERT CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // DELETE CONFIRM
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {

                    let form = this.closest('form');

                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });

        });
    </script>

@endsection
