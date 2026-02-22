@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center"><i class="bi bi-box-arrow-in-right"></i> LOGIN</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>

                <hr>
                <div class="text-center">
                    <p class="mb-2"><strong>Akun Demo:</strong></p>
                    <div class="small text-muted">
                        <div><strong>Admin:</strong> admin@sekolah.com</div>
                        <div><strong>Siswa:</strong> siswa@sekolah.com</div>
                        <div><strong>Password:</strong> password</div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <p class="mb-2">Belum punya akun?</p>
                    <a href="{{ route('register.form') }}" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-person-plus"></i> Daftar sebagai Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
