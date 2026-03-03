<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            max-width: 460px;
            width: 100%;
            border-radius: 20px;
        }

        .custom-input {
            border: 1px solid #dee2e6;
            padding: 4px 10px;
            transition: all 0.3s ease;
            background: #fff;
            border-radius: 50px;
        }

        .custom-input:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .custom-input input:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="card shadow border-0 login-card px-5 py-4">

            <!-- Logo -->
            <div class="text-start mb-2">
                <img src="{{ asset('images/Logo.png') }}" style="max-height: 55px;" class="img-fluid">
            </div>

            <small class="text-dark d-block fw-medium mb-2">
                Sistem Informasi Pengaduan & Respon Aspirasi Sekolah
            </small>

            <h4 class="fw-bold mb-4">Masuk ke Akun</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="role" id="selected_role" value="siswa">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group custom-input">
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
                    <div class="input-group custom-input">
                        <span class="input-group-text bg-white border-0 rounded-start-pill">
                            <i class="bi bi-lock-fill text-muted"></i>
                        </span>

                        <input type="password" name="password" id="password"
                            class="form-control border-0 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password" required>

                        <span class="input-group-text bg-white border-0 rounded-end-pill"
                            style="cursor:pointer;" id="togglePassword">
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

            <div class="text-center mt-4">
                <small class="text-muted">Belum Punya Akun?</small>
                <a href="{{ route('register.form') }}" class="fw-semibold text-primary text-decoration-none">
                    Daftar Sebagai Siswa
                </a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');

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

</body>
</html>
