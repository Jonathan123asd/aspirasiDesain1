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

        /* select history */
        select.filter-box {
            appearance: none;
            outline: none;
        }

        /* ===== CARD ===== */
        .card {
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 999px;
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

        <style>.form-wrapper {
            background: #f8f9fa;
            padding: 35px;
            border-radius: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            padding: 12px 16px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        /* ===== URGENCY CARD ===== */
        .urgency-option {
            flex: 1;
            border-radius: 18px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            border: 2px solid #e9ecef;
            transition: 0.2s ease-in-out;
        }

        .urgency-option input {
            display: none;
        }

        .urgency-option.low {
            border-color: #198754;
        }

        .urgency-option.medium {
            border-color: #ffc107;
        }

        .urgency-option.high {
            border-color: #dc3545;
        }

        .urgency-option.active.low {
            background: rgba(25, 135, 84, 0.08);
        }

        .urgency-option.active.medium {
            background: rgba(255, 193, 7, 0.08);
        }

        .urgency-option.active.high {
            background: rgba(220, 53, 69, 0.08);
        }

        .urgensi-box {
            border-radius: 999px;
            width: fit-content;
            font-weight: 600;
            font-size: 13px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Tinggi */
        .urgensi-tinggi {
            background-color: #ffe5e5;
            color: #d90429;
            border: 1px solid #ffb3b3;
        }

        /* Sedang */
        .urgensi-sedang {
            background-color: #fff4e5;
            color: #ff8800;
            border: 1px solid #ffd8a8;
        }

        /* Rendah */
        .urgensi-rendah {
            background-color: #e6f9f0;
            color: #0f9d58;
            border: 1px solid #b7f0d2;
        }

        /* ===== BUTTON ===== */
        .btn-submit {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: #fff;
            border-radius: 14px;
            padding: 12px 28px;
            font-weight: 500;
        }

        .btn-submit:hover {
            opacity: 0.9;
            color: #fff;
        }

        /* SEARCH & FILTER */
        .search-box,
        .filter-box {
            border-radius: 20px;
            padding: 14px 20px;
            border: 1px solid #dee2e6;
            background: #fff;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
        }

        .filter-box {
            cursor: pointer;
        }

        /* CARD PENGADUAN */
        .pengaduan-card {
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #f1f1f1;
            background: #fff;
            transition: 0.2s ease;
        }

        .pengaduan-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* STATUS BADGE MODERN */
        .status-pill {
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-proses {
            border: 2px solid #2563eb;
            color: #2563eb;
            background: rgba(37, 99, 235, 0.08);
        }

        .status-selesai {
            border: 2px solid #16a34a;
            color: #16a34a;
            background: rgba(22, 163, 74, 0.08);
        }

        .status-pending {
            border: 2px solid #f59e0b;
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.08);
        }

        .meta-info {
            font-size: 14px;
            color: #6c757d;
        }

        .pengaduan-card {
            cursor: pointer;
            transition: 0.2s ease;
        }

        .pengaduan-card:hover {
            transform: translateY(-3px);
        }
    </style>
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
