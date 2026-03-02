<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaduan Sekolah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        .admin-users-page {
            --primary-blue: #2563EB;
            --primary-green: #10B981;
            --dark-gray: #1E293B;
            --soft-gray: #64748b;
            --border-color: #e2e8f0;
            --light-bg: #f8fafc;
        }

        /* ============================= */
        /* Stats Card - Enhanced */
        /* ============================= */

        .admin-users-page .stats-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .admin-users-page .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-green));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .admin-users-page .stats-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .admin-users-page .stats-card:hover::before {
            opacity: 1;
        }

        .admin-users-page .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .admin-users-page .stats-icon-blue {
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: var(--primary-blue);
        }

        .admin-users-page .stats-icon-yellow {
            background: linear-gradient(135deg, #fef3c7, #fffbeb);
            color: #F59E0B;
        }

        .admin-users-page .stats-icon-green {
            background: linear-gradient(135deg, #d1fae5, #ecfdf5);
            color: var(--primary-green);
        }

        .admin-users-page .stats-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--soft-gray);
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .admin-users-page .stats-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark-gray);
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .admin-users-page .stats-trend {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary-green);
            background: #ecfdf5;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
        }

        /* ============================= */
        /* Filter Section - Bootstrap Aligned */
        /* ============================= */

        .admin-users-page .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .admin-users-page .search-box {
            position: relative;
        }

        .admin-users-page .search-box i {
            position: absolute;
            left: 2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--soft-gray);
            z-index: 2;
            font-size: 1rem;
        }

        .admin-users-page .search-box input {
            width: 100%;
             padding: 0.6rem 1rem 0.6rem 2.5rem; /* samakan tinggi & beri ruang icon */
          
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .admin-users-page .search-box input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .admin-users-page .filter-select {
            width: 100%;
            padding: 0.6rem 2.5rem 0.6rem 1rem;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }

        .admin-users-page .filter-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* ============================= */
        /* Table - Modern Design */
        /* ============================= */

        .admin-users-page .card-custom {
            border-radius: 20px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .admin-users-page .card-header-custom {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-users-page .card-header-custom h5 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.25rem;
        }

        .admin-users-page .card-header-custom p {
            color: var(--soft-gray);
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .admin-users-page .table-responsive {
            overflow-x: auto;
        }

        .admin-users-page .table-custom {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        .admin-users-page .table-custom th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.25rem 1.5rem;
            background: var(--light-bg);
            color: var(--soft-gray);
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-users-page .table-custom td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: var(--dark-gray);
            font-size: 0.95rem;
        }

        .admin-users-page .table-custom tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background 0.2s;
        }

        .admin-users-page .table-custom tbody tr:last-child {
            border-bottom: none;
        }

        .admin-users-page .table-custom tbody tr:hover {
            background: var(--light-bg);
        }

        /* User Info Cell */
        .admin-users-page .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-users-page .user-avatar {
            width: 38px;
            height: 38px;
            background: #e9eef2;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--soft-gray);
            font-size: 1.1rem;
        }

        .admin-users-page .user-name {
            font-weight: 600;
            color: var(--dark-gray);
        }

        /* ============================= */
        /* Badge - Enhanced */
        /* ============================= */

        .admin-users-page .badge-custom {
            padding: 0.45rem 1rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            line-height: 1;
            white-space: nowrap;
        }

        .admin-users-page .badge-admin {
            background: linear-gradient(135deg, var(--primary-blue), #1D4ED8);
            color: white;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .admin-users-page .badge-siswa {
            background: linear-gradient(135deg, var(--soft-gray), #475569);
            color: white;
        }

        .admin-users-page .badge-approved {
            background: #d1fae5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .admin-users-page .badge-pending {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .admin-users-page .badge-rejected {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* ============================= */
        /* Buttons - Bootstrap Friendly */
        /* ============================= */

        .admin-users-page .btn-pending,
        .admin-users-page .btn-approve,
        .admin-users-page .btn-reject,
        .admin-users-page .btn-detail,
        .admin-users-page .btn-export {
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border: none;
            transition: all 0.2s;
            cursor: pointer;
            line-height: 1.4;
        }

        .admin-users-page .btn-pending {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
        }

        .admin-users-page .btn-pending:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .admin-users-page .btn-approve {
            background: #10B981;
            color: white;
        }

        .admin-users-page .btn-approve:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .admin-users-page .btn-reject {
            background: #DC2626;
            color: white;
        }

        .admin-users-page .btn-reject:hover {
            background: #B91C1C;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
            color: white;
        }

        .admin-users-page .btn-detail {
            background: var(--primary-blue);
            color: white;
        }

        .admin-users-page .btn-detail:hover {
            background: #1D4ED8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .admin-users-page .btn-export {
            background: white;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
        }

        .admin-users-page .btn-export:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
        }

        .admin-users-page .btn-action-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .admin-users-page .btn-pending .badge {
            background: white !important;
            color: var(--dark-gray) !important;
            border-radius: 50px;
            padding: 0.3rem 0.7rem;
            margin-left: 0.25rem;
        }

        /* ============================= */
        /* Pagination - Bootstrap Enhanced */
        /* ============================= */

        .admin-users-page .pagination {
            margin-bottom: 0;
            gap: 0.25rem;
        }

        .admin-users-page .pagination .page-link {
            border-radius: 10px !important;
            padding: 0.5rem 1rem;
            color: var(--dark-gray);
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }

        .admin-users-page .pagination .page-link:hover {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .admin-users-page .pagination .page-item.active .page-link {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
        }

        .admin-users-page .pagination .page-item.disabled .page-link {
            background: #f1f5f9;
            color: #94a3b8;
            border-color: var(--border-color);
            pointer-events: none;
            transform: none;
            box-shadow: none;
        }

        /* ============================= */
        /* Empty State */
        /* ============================= */

        .admin-users-page .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--soft-gray);
        }

        .admin-users-page .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .admin-users-page .empty-state h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .admin-users-page .empty-state p {
            color: var(--soft-gray);
            font-size: 1rem;
        }

        /* ============================= */
        /* Modal - Bootstrap Enhanced */
        /* ============================= */

        .admin-users-page .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .admin-users-page .modal-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-users-page .modal-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-gray);
        }

        .admin-users-page .modal-body {
            padding: 1.75rem;
        }

        .admin-users-page .user-detail-avatar {
            width: 80px;
            height: 80px;
            background: #e9eef2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 2rem;
            color: var(--soft-gray);
        }

        .admin-users-page .user-detail-item {
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px dashed var(--border-color);
        }

        .admin-users-page .user-detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .admin-users-page .user-detail-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--soft-gray);
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .admin-users-page .user-detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-users-page .user-detail-value i {
            color: var(--primary-blue);
            width: 20px;
            font-size: 1.1rem;
        }

        /* ============================= */
        /* Responsive */
        /* ============================= */

        @media (max-width: 1400px) {
            .admin-users-page .stats-card {
                padding: 1.25rem;
            }

            .admin-users-page .stats-number {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 992px) {
            .admin-users-page .card-header-custom {
                flex-direction: column;
                align-items: flex-start;
            }

            .admin-users-page .btn-export {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .admin-users-page .stats-card {
                margin-bottom: 1rem;
            }

            .admin-users-page .btn-action-group {
                flex-direction: column;
            }

            .admin-users-page .btn-approve,
            .admin-users-page .btn-reject,
            .admin-users-page .btn-detail {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

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
            width: calc(100% - 260px);
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

        /*admin dashboard*/

        .judul-col {
            max-width: 180px;
        }


        body {
            background: #f5f7fb;
        }

        .stat-card {
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #eef2ff;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .complaint-card {
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            transition: 0.3s ease;
        }

        .complaint-card:hover {
            transform: translateY(-3px);
        }

        .custom-table thead th {
            border-bottom: none;
            font-weight: 600;
            color: #6c757d;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #f1f1f1;
        }



        .custom-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge.pending {
            border: 1px solid #ffc107;
            color: #ffc107;
            background: #fff9e6;
        }

        .status-badge.proses {
            border: 1px solid #0d6efd;
            color: #0d6efd;
            background: #e7f1ff;
        }

        .status-badge.selesai {
            border: 1px solid #198754;
            color: #198754;
            background: #e9f7ef;
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
