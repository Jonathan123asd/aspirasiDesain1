@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-start pt-2 pb-4 px-3">

        <div class="card shadow-lg border-0 rounded-4 px-4 px-md-5 py-4" style="max-width: 640px; width:100%;">

            <!-- Header -->
            <div class="text-start mb-2">
                <img src="{{ asset('images/Logo.png') }}" class="img-fluid" style="max-height:55px;">
            </div>

            <small class="text-muted d-block fw-medium mb-2">
                Buat Akun baru untuk mengakses sistem informasi pengaduan & respon aspirasi sekolah.
            </small>

            <h4 class="fw-bold mb-4">Daftar Akun Siswa</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group rounded-pill custom-input">
                        <span class="input-group-text bg-white border-0 rounded-start-pill">
                            <i class="bi bi-person-fill text-muted"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control border-0 rounded-end-pill @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group rounded-pill custom-input">
                        <span class="input-group-text bg-white border-0 rounded-start-pill">
                            <i class="bi bi-envelope-fill text-muted"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control border-0 rounded-end-pill @error('email') is-invalid @enderror"
                            placeholder="Masukkan email" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>



                <div class="row">
                    <!-- NIS -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIS</label>
                        <div class="input-group rounded-pill custom-input">
                            <span class="input-group-text bg-white border-0 rounded-start-pill">
                                <i class="bi bi-credit-card-2-front-fill text-muted"></i>
                            </span>
                            <input type="text" name="nis" value="{{ old('nis') }}"
                                class="form-control border-0 rounded-end-pill @error('nis') is-invalid @enderror"
                                placeholder="Masukkan NIS" required>
                        </div>
                        @error('nis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kelas</label>
                        <div class="input-group rounded-pill custom-input">
                            <span class="input-group-text bg-white border-0 rounded-start-pill">
                                <i class="bi bi-mortarboard-fill text-muted"></i>
                            </span>
                            <input type="text" name="kelas" value="{{ old('kelas') }}"
                                class="form-control border-0 rounded-end-pill @error('kelas') is-invalid @enderror"
                                placeholder="Contoh: XII RPL 1" required>
                        </div>
                        @error('kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group rounded-pill custom-input">
                            <span class="input-group-text bg-white border-0 rounded-start-pill">
                                <i class="bi bi-lock-fill text-muted"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control border-0"
                                placeholder="Minimal 8 karakter" required>
                            <span class="input-group-text bg-white border-0 rounded-end-pill toggle-password"
                                style="cursor:pointer;">
                                <i class="bi bi-eye-fill text-muted" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group rounded-pill custom-input">
                            <span class="input-group-text bg-white border-0 rounded-start-pill">
                                <i class="bi bi-shield-lock-fill text-muted"></i>
                            </span>
                            <input type="password" name="password_confirmation"
                                class="form-control border-0 rounded-end-pill" placeholder="Ulangi password" required>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">Sudah punya akun?</small>
                <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
                    Masuk disini
                </a>
            </div>

        </div>
    </div>

    <style>
        html,
        body {
            min-height: 100vh;
            margin: 0;
        }
        body {
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.25), transparent 40%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.15), transparent 40%),
                linear-gradient(135deg, #0d6efd, #4f8dfd);
        }

        .custom-input {
            border: 1px solid #dee2e6;
            padding: 4px 10px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .custom-input:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .custom-input input:focus {
            box-shadow: none;
        }
    </style>

    <script>
        document.getElementById('toggleIcon').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this;

            if (password.type === "password") {
                password.type = "text";
                icon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
            } else {
                password.type = "password";
                icon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
            }
        });
    </script>
@endsection
