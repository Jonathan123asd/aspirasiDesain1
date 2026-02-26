<div class="sidebar bg-white border-end d-flex flex-column">

    {{-- LOGO & USER INFO --}}
    <div class="px-3 pt-4 pb-2">
        {{-- Logo di tengah --}}
        <div class=" mb-3">
            <img src="{{ asset('images/Logo.png') }}" class="img-fluid" style="max-height: 50px;">
        </div>

        {{-- USER INFO --}}
        <div class="d-flex align-items-center gap-3">
            {{-- Initial Avatar --}}
            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary flex-shrink-0"
                style="width: 45px; height: 45px; font-size: 1.2rem;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            {{-- User Details --}}
            <div class="overflow-hidden">
                <div class="fw-semibold text-truncate">{{ Auth::user()->name }}</div>
                <small class="text-muted d-flex align-items-center">
                    {{ ucfirst(Auth::user()->role) }}
                </small>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <ul class="nav flex-column px-3 mt-3 mb-5">

        {{-- ADMIN --}}
        @if (Auth::user()->role == 'admin')

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/detail') ? 'active' : '' }}"
                    href="{{ route('admin.detail') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Kelola Pengaduan
                </a>
            </li>
 --}}

            {{-- <li class="nav-item">
                <a class="nav-link
        {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.detail') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-folder2-open me-2"></i> Kelola Pengaduan
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">

                    <span>
                        <i class="bi bi-people me-2"></i> Manajemen User
                    </span>

                    @php
                        $pendingCount = \App\Models\User::where('status', 'pending')->where('role', 'siswa')->count();
                    @endphp

                    @if ($pendingCount > 0)
                        <span class="badge bg-danger ms-auto">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>
            </li>

        @endif


        {{-- SISWA --}}
        @if (Auth::user()->role == 'siswa')
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('siswa/dashboard') ? 'active' : '' }}"
                    href="{{ route('siswa.dashboard') }}">
                    <i class="bi bi-house-door me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('siswa/form') ? 'active' : '' }}"
                    href="{{ route('siswa.form') }}">
                    <i class="bi bi-plus-circle me-3"></i>
                    <span>Buat Pengaduan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('siswa/history') ? 'active' : '' }}"
                    href="{{ route('siswa.history') }}">
                    <i class="bi bi-clock-history me-3"></i>
                    <span>Riwayat Pengaduan</span>
                </a>
            </li>
        @endif

    </ul>



    {{-- LOGOUT --}}
    <div class="p-3 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>

</div>
