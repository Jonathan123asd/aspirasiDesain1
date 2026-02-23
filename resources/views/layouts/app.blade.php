<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaduan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .card { border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .status-badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-proses { background-color: #0d6efd; color: #fff; }
        .badge-selesai { background-color: #198754; color: #fff; }
    </style>
</head>
<body>
@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}">
            <i class="bi bi-megaphone"></i> Pengaduan Sekolah
        </a>

        <!-- Tambahkan navbar toggler untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu navigation -->
            <ul class="navbar-nav me-auto">
                <!-- Menu untuk Admin -->
                @if(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- INI YANG DITAMBAH: Menu Manajemen User -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                       href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i> Manajemen User
                        @php
                            $pendingCount = \App\Models\User::where('status', 'pending')
                                ->where('role', 'siswa')
                                ->count();
                        @endphp
                        @if($pendingCount > 0)
                        <span class="badge bg-danger">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                @endif

                <!-- Menu untuk Siswa -->
                @if(Auth::user()->role == 'siswa')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}"
                       href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/form') ? 'active' : '' }}"
                       href="{{ route('siswa.form') }}">
                        <i class="bi bi-plus-circle"></i> Buat Pengaduan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/history') ? 'active' : '' }}"
                       href="{{ route('siswa.history') }}">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                </li>
                @endif
            </ul>

            <!-- User info & Logout (tetap di kanan) -->
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
@endauth

    <div class="container mt-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
