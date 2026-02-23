@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-start pt-4 px-3">

        <div class="card shadow border-0 rounded-4 px-5 py-2" style="max-width: 460px; width:100%;">

            <!-- Header -->
            <div class="text-start">
                <img src="{{ asset('images/Logo.png') }}" style="max-height: 55px;" class="img-fluid mb-2">
            </div>

            <div class="text-start">
                <small class="text-black d-block fw-medium">
                    Sistem Informasi Pengaduan & Respon Aspirasi Sekolah
                </small>
            </div>

            <h4 class="text-start fw-bold mb-3">Masuk ke Akun</h4>

            <!-- Role Selector -->
            <div class="d-flex gap-3 mb-4">
                <input type="radio" class="btn-check" name="role" id="siswa" value="siswa" checked>
                <label class="btn btn-outline-primary w-100 rounded-3 py-3 d-flex flex-column align-items-center"
                    for="siswa">
                    <i class="bi bi-mortarboard-fill fs-4 mb-2"></i>
                    Siswa
                </label>

                <input type="radio" class="btn-check" name="role" id="admin" value="admin">
                <label class="btn btn-outline-secondary w-100 rounded-3 py-3 d-flex flex-column align-items-center"
                    for="admin">
                    <i class="bi bi-shield-lock-fill fs-4 mb-2"></i>
                    Admin
                </label>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="role" id="selected_role" value="siswa">

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

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group rounded-pill custom-input">
                        <span class="input-group-text bg-white border-0 rounded-start-pill">
                            <i class="bi bi-lock-fill text-muted"></i>
                        </span>

                        <input type="password" name="password" id="password"
                            class="form-control border-0 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password" required>

                        <span class="input-group-text bg-white border-0 rounded-end-pill toggle-password"
                            style="cursor:pointer;">
                            <i class="bi bi-eye-fill text-muted" id="toggleIcon"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                    Masuk
                </button>
            </form>

            <div class="text-center mt-4 mb-4">
                <small class="text-muted">Belum Punya Akun?</small>
                <a href="{{ route('register.form') }}" class="fw-semibold text-primary text-decoration-none">
                    Daftar Sebagai Siswa
                </a>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-check').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('selected_role').value = this.value;
                }
            });
        });

        document.getElementById('toggleIcon').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this;

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            }
        });
    </script>

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
            transition: all 0.3s ease;
            background: #fff;
        }

        .custom-input:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .custom-input input:focus {
            box-shadow: none;
        }
    </style>
@endsection
