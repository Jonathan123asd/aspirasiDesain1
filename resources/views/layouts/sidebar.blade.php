<div class="sidebar bg-white border-end d-flex flex-column">

    {{-- LOGO --}}
    <div class="px-3 pt-4 pb-2">
        <img src="{{ asset('images/Logo.png') }}" class="img-fluid" style="max-height:50px;">
    </div>

    <hr class="my-2">

    {{-- USER INFO --}}
    <div class="px-3 mb-3">
        <div class="fw-semibold">{{ Auth::user()->name }}</div>
        <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
    </div>

    <hr class="my-2">

    {{-- MENU --}}
    <ul class="nav flex-column px-2">

        {{-- ADMIN --}}
        @if (Auth::user()->role == 'admin')

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('admin/users*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">

                    <span>
                        <i class="bi bi-people me-2"></i> Manajemen User
                    </span>

                    @php
                        $pendingCount = \App\Models\User::where('status','pending')
                                        ->where('role','siswa')
                                        ->count();
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
                <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}"
                   href="{{ route('siswa.dashboard') }}">
                    <i class="bi bi-house me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('siswa/form') ? 'active' : '' }}"
                   href="{{ route('siswa.form') }}">
                    <i class="bi bi-plus-circle me-2"></i> Buat Pengaduan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('siswa/history') ? 'active' : '' }}"
                   href="{{ route('siswa.history') }}">
                    <i class="bi bi-clock-history me-2"></i> History
                </a>
            </li>

        @endif

    </ul>

    <hr class="mt-auto">

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
