<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaduan Sekolah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* ===== CARD ===== */
        .card {
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-pending {
            background: #ffc107;
            color: #000;
        }

        .badge-proses {
            background: #0d6efd;
            color: #fff;
        }

        .badge-selesai {
            background: #198754;
            color: #fff;
        }

        /* ===== SIDEBAR DESKTOP ===== */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar .nav {
            margin-top: 8px;
        }

        .sidebar .nav-item {
            margin-bottom: 6px;
        }

        .sidebar .nav-link {
            padding: 10px 12px;
        }

        .sidebar .nav-link {
            color: #6c757d;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 4px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f3f5;
            color: #0d6efd;
        }

        .sidebar .nav-link.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            border-left: 4px solid #0d6efd;
        }

        .user-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        /* ===== CONTENT SHIFT ===== */
        .main-content {
            margin-left: 260px;
            width: 100%;
            min-height: 100vh;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    @auth

        <div class="d-flex">

            {{-- SIDEBAR DESKTOP --}}
            <div class="sidebar d-none d-lg-flex">
                @include('layouts.sidebar')
            </div>

            {{-- MAIN CONTENT --}}
            <div class="main-content">

                {{-- TOPBAR MOBILE --}}
                <nav class="navbar navbar-light bg-white shadow-sm d-lg-none px-3">
                    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="fw-semibold">Dashboard</span>
                </nav>

                <div class="p-4">
                    @include('layouts.alert')
                    @yield('content')
                </div>

            </div>

        </div>

        {{-- OFFCANVAS MOBILE --}}
        <div class="offcanvas offcanvas-start text-bg-primary" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-body p-0">
                @include('layouts.sidebar')
            </div>
        </div>
    @else
        <div class="container mt-5">
            @yield('content')
        </div>

    @endauth


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>
