{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipra - Platform Pengaduan Sekolah</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Custom CSS --}}
    <style>
        :root {
            --primary-blue: #2563EB;
            --primary-green: #10B981;
            --dark-gray: #1E293B;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            padding-top: 64px;
        }

        .text-primary-blue { color: #2563EB; }
        .text-primary-green { color: #10B981; }
        .text-dark-gray { color: #1E293B; }
        .bg-primary-blue { background-color: #2563EB; }
        .bg-primary-green { background-color: #10B981; }
        .bg-dark-gray { background-color: #1E293B; }

        .gradient-bg {
            background: linear-gradient(135deg, #2563EB, #10B981);
        }

        .gradient-hero {
            background: linear-gradient(135deg, #eff6ff, #ffffff, #f0fdf4);
        }

        .nav-link {
            color: #4b5563;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #2563EB;
        }

        .btn-outline-primary-blue {
            border: 2px solid #2563EB;
            color: #2563EB;
            border-radius: 12px;
            padding: 12px 32px;
            font-weight: 500;
        }

        .btn-outline-primary-blue:hover {
            background-color: #2563EB;
            color: white;
        }

        .btn-primary-blue {
            background-color: #2563EB;
            color: white;
            border-radius: 12px;
            padding: 12px 32px;
            font-weight: 500;
            border: none;
        }

        .btn-primary-blue:hover {
            background-color: #1D4ED8;
            color: white;
        }

        .btn-primary-blue-lg {
            background-color: #2563EB;
            color: white;
            border-radius: 12px;
            padding: 16px 32px;
            font-weight: 500;
            font-size: 1.125rem;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            border: none;
        }

        .btn-primary-blue-lg:hover {
            background-color: #1D4ED8;
            color: white;
        }

        .btn-outline-white {
            border: 2px solid white;
            color: white;
            border-radius: 12px;
            padding: 16px 32px;
            font-weight: 700;
            font-size: 1.125rem;
            background: transparent;
        }

        .btn-outline-white:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .badge-blue {
            background-color: #dbeafe;
            color: #2563EB;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 500;
        }

        .feature-card {
            padding: 32px;
            border-radius: 16px;
            border: 1px solid transparent;
            transition: all 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .feature-card-blue {
            background: linear-gradient(135deg, #eff6ff, #ffffff);
            border-color: #dbeafe;
        }

        .feature-card-green {
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
            border-color: #dcfce7;
        }

        .feature-card-purple {
            background: linear-gradient(135deg, #f5f3ff, #ffffff);
            border-color: #ede9fe;
        }

        .feature-card-yellow {
            background: linear-gradient(135deg, #fefce8, #ffffff);
            border-color: #fef9c3;
        }

        .feature-card-pink {
            background: linear-gradient(135deg, #fdf2f8, #ffffff);
            border-color: #fce7f3;
        }

        .feature-card-indigo {
            background: linear-gradient(135deg, #eef2ff, #ffffff);
            border-color: #e0e7ff;
        }

        .icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .icon-wrapper-blue { background-color: #dbeafe; }
        .icon-wrapper-green { background-color: #dcfce7; }
        .icon-wrapper-purple { background-color: #ede9fe; }
        .icon-wrapper-yellow { background-color: #fef9c3; }
        .icon-wrapper-pink { background-color: #fce7f3; }
        .icon-wrapper-indigo { background-color: #e0e7ff; }

        .step-number {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin: 0 auto 24px;
            color: white;
        }

        .step-number-blue { background-color: #2563EB; }
        .step-number-green { background-color: #10B981; }
        .step-number-yellow { background-color: #F59E0B; }
        .step-number-purple { background-color: #7C3AED; }

        .stat-number {
            font-size: 2.25rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .floating-card {
            position: absolute;
            bottom: -24px;
            left: -24px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 16px;
            border: 1px solid #f3f4f6;
        }

        .floating-card-right {
            position: absolute;
            bottom: -32px;
            right: -32px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 24px;
            border: 1px solid #f3f4f6;
            max-width: 280px;
        }

        .progress-bar-custom {
            height: 8px;
            background-color: #f3f4f6;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563EB, #10B981);
            width: 80%;
        }

        footer a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
        }

        footer button {
            background: none;
            border: none;
            color: #9ca3af;
            padding: 0;
            transition: color 0.3s;
        }

        footer button:hover {
            color: white;
        }
    </style>
</head>
<body>
    {{-- Navigation --}}
    <nav class="navbar navbar-expand-lg fixed-top bg-white bg-opacity-95 backdrop-blur border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="gradient-bg rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-mortarboard-fill text-white"></i>
                </div>
                <span class="fw-bold text-dark-gray fs-4">Sipra</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#benefits">Keuntungan</a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary-blue px-4 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary-blue px-4 py-2">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="gradient-hero py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge-blue d-inline-flex align-items-center gap-2 mb-4">
                        <i class="bi bi-chat-dots-fill"></i>
                        Platform Pengaduan Sekolah #1
                    </div>

                    <h1 class="display-4 fw-bold text-dark-gray mb-4">
                        Sampaikan Aspirasimu untuk Sekolah Lebih Baik
                    </h1>

                    <p class="lead text-secondary mb-5">
                        Platform modern untuk melaporkan sarana dan prasarana sekolah yang rusak.
                        Transparan, cepat, dan mudah digunakan untuk seluruh siswa.
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-3 mb-5">
                        <a href="{{ route('register') }}" class="btn btn-primary-blue-lg d-flex align-items-center justify-content-center gap-2">
                            Mulai Sekarang
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary-blue">
                            Login Siswa
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="row pt-5 border-top">
                        <div class="col-4">
                            <p class="stat-number text-primary-blue">500+</p>
                            <p class="text-secondary small">Pengaduan Terselesaikan</p>
                        </div>
                        <div class="col-4">
                            <p class="stat-number text-primary-green">1,200+</p>
                            <p class="text-secondary small">Siswa Aktif</p>
                        </div>
                        <div class="col-4">
                            <p class="stat-number text-warning">95%</p>
                            <p class="text-secondary small">Tingkat Kepuasan</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="bg-white rounded-4 shadow-lg p-4 border">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop"
                                 alt="Students collaborating"
                                 class="img-fluid rounded-3"
                                 style="height: 320px; width: 100%; object-fit: cover;">
                        </div>

                        <div class="floating-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-check-circle-fill text-primary-green fs-4"></i>
                                </div>
                                <div>
                                    <p class="fw-bold text-dark-gray mb-0">Pengaduan Selesai!</p>
                                    <p class="small text-secondary mb-0">AC Kelas XII RPL 1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark-gray mb-3">Fitur Unggulan</h2>
                <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                    Semua yang kamu butuhkan untuk menyampaikan aspirasi dan keluhan dengan mudah
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-blue">
                        <div class="icon-wrapper icon-wrapper-blue">
                            <i class="bi bi-file-text-fill text-primary-blue fs-3"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Pengaduan Mudah</h3>
                        <p class="text-secondary">
                            Form pengaduan yang simpel dan intuitif. Tambahkan foto, pilih kategori, dan kirim dalam hitungan detik.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-green">
                        <div class="icon-wrapper icon-wrapper-green">
                            <i class="bi bi-clock-fill text-primary-green fs-3"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Tracking Real-time</h3>
                        <p class="text-secondary">
                            Pantau status pengaduanmu secara real-time. Dari pending, proses, hingga selesai dengan notifikasi otomatis.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-purple">
                        <div class="icon-wrapper icon-wrapper-purple">
                            <i class="bi bi-shield-fill text-purple fs-3" style="color: #7C3AED;"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Aman & Transparan</h3>
                        <p class="text-secondary">
                            Data pengaduan tersimpan aman. Admin sekolah dapat melihat dan merespon dengan cepat dan transparan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-yellow">
                        <div class="icon-wrapper icon-wrapper-yellow">
                            <i class="bi bi-bar-chart-fill text-warning fs-3"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Dashboard Interaktif</h3>
                        <p class="text-secondary">
                            Lihat statistik pengaduan, history, dan progress penyelesaian dalam dashboard yang user-friendly.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-pink">
                        <div class="icon-wrapper icon-wrapper-pink">
                            <i class="bi bi-people-fill text-pink fs-3" style="color: #EC4899;"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Multi-Role System</h3>
                        <p class="text-secondary">
                            Sistem untuk siswa dan admin. Approval registrasi, kelola pengaduan, dan respon complaint dengan mudah.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-indigo">
                        <div class="icon-wrapper icon-wrapper-indigo">
                            <i class="bi bi-graph-up-arrow text-indigo fs-3" style="color: #4F46E5;"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark-gray mb-3">Analitik Lengkap</h3>
                        <p class="text-secondary">
                            Admin dapat melihat report, statistik pengaduan per kategori, dan trend untuk evaluasi sekolah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark-gray mb-3">Cara Kerja</h2>
                <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                    Hanya 4 langkah mudah untuk menyampaikan aspirasimu
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="step-number step-number-blue">1</div>
                        <h3 class="h5 fw-bold text-dark-gray mb-3">Daftar Akun</h3>
                        <p class="text-secondary">
                            Registrasi dengan email sekolah dan tunggu approval dari admin dalam 1x24 jam.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="step-number step-number-green">2</div>
                        <h3 class="h5 fw-bold text-dark-gray mb-3">Buat Pengaduan</h3>
                        <p class="text-secondary">
                            Isi form pengaduan dengan detail masalah, lokasi, dan upload foto sebagai bukti.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="step-number step-number-yellow">3</div>
                        <h3 class="h5 fw-bold text-dark-gray mb-3">Tracking Status</h3>
                        <p class="text-secondary">
                            Pantau progress pengaduanmu dari dashboard. Lihat update dan respon dari admin.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="step-number step-number-purple">4</div>
                        <h3 class="h5 fw-bold text-dark-gray mb-3">Masalah Selesai</h3>
                        <p class="text-secondary">
                            Terima notifikasi saat pengaduan selesai. Berikan feedback untuk evaluasi sekolah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Section --}}
    <section id="benefits" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold text-dark-gray mb-4">
                        Kenapa Harus Sipra?
                    </h2>
                    <p class="lead text-secondary mb-5">
                        Platform yang dirancang khusus untuk memudahkan komunikasi antara siswa dan pihak sekolah.
                    </p>

                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-circle-fill text-primary-green"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold text-dark-gray mb-1">Cepat & Efisien</h4>
                                <p class="text-secondary">Tidak perlu lagi lapor manual ke ruang guru. Semua online dan real-time.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-circle-fill text-primary-green"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold text-dark-gray mb-1">History Lengkap</h4>
                                <p class="text-secondary">Semua pengaduan tersimpan rapi. Bisa dilihat kapan saja untuk evaluasi.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-circle-fill text-primary-green"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold text-dark-gray mb-1">Approval System</h4>
                                <p class="text-secondary">Admin bisa approve registrasi siswa untuk keamanan data yang lebih baik.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-circle-fill text-primary-green"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold text-dark-gray mb-1">Mobile Friendly</h4>
                                <p class="text-secondary">Responsive design yang bisa diakses dari HP, tablet, atau komputer.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&h=600&fit=crop"
                             alt="School students"
                             class="img-fluid rounded-4 shadow-lg"
                             style="height: 400px; width: 100%; object-fit: cover;">

                        <div class="floating-card-right">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-bar-chart-fill text-primary-blue"></i>
                                </div>
                                <div>
                                    <p class="fw-bold text-dark-gray mb-0">Response Time</p>
                                    <p class="small text-secondary mb-0">Avg. 2-3 hari</p>
                                </div>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-fill"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-5 gradient-bg">
        <div class="container py-5 text-center" style="max-width: 800px;">
            <h2 class="display-5 fw-bold text-white mb-4">
                Siap Membuat Sekolah Lebih Baik?
            </h2>
            <p class="lead text-white text-opacity-75 mb-5">
                Bergabung dengan ratusan siswa yang sudah menggunakan Sipra untuk menyampaikan aspirasi mereka.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="{{ route('register') }}" class="btn btn-light btn-primary-blue-lg text-primary-blue fw-bold shadow-lg">
                    Daftar Gratis Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-white">
                    Sudah Punya Akun? Login
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-dark-gray text-white py-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="gradient-bg rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-mortarboard-fill text-white"></i>
                        </div>
                        <span class="fw-bold fs-4">Sipra</span>
                    </div>
                    <p class="text-secondary">
                        Platform pengaduan sarana sekolah yang modern, transparan, dan mudah digunakan.
                    </p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-bold mb-4">Produk</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#features" class="text-secondary text-decoration-none hover-white">Fitur</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="text-secondary text-decoration-none hover-white">Cara Kerja</a></li>
                        <li class="mb-2"><a href="#benefits" class="text-secondary text-decoration-none hover-white">Keuntungan</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-bold mb-4">Akses</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="text-secondary text-decoration-none hover-white">Login Siswa</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="text-secondary text-decoration-none hover-white">Login Admin</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}" class="text-secondary text-decoration-none hover-white">Registrasi</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-bold mb-4">Kontak</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2">Email: info@Sipra.id</li>
                        <li class="mb-2">Telp: (021) 123-4567</li>
                        <li class="mb-2">Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary pt-4 text-center text-secondary">
                <p class="mb-0">&copy; 2026 Sipra. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
