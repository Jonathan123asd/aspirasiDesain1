@extends('layouts.app')

@section('title', 'Registrasi Berhasil')

@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center px-3">

    <div id="successCard"
         class="card shadow border-0 rounded-4 px-4 px-md-5 py-5 text-center animate-card"
         style="max-width: 480px; width:100%;">

        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success success-icon"></i>
        </div>

        <h4 class="fw-bold mb-3">Registrasi Berhasil </h4>

        <p class="text-muted mb-3">
            Akun Anda sedang menunggu persetujuan admin sekolah.
            Notifikasi akan dikirim setelah akun disetujui.
        </p>

        <div class="alert alert-light border rounded-3 text-start mb-4">
            <i class="bi bi-clock-fill text-warning me-2"></i>
            <strong>Estimasi:</strong> 1–2 hari kerja
        </div>

        <!-- Progress bar -->
        <div class="progress mb-3" style="height:6px;">
            <div id="progressBar"
                 class="progress-bar bg-primary"
                 role="progressbar"
                 style="width: 100%">
            </div>
        </div>

        <small class="text-muted d-block mb-4">
            Anda akan diarahkan ke halaman login dalam
            <span id="countdown" class="fw-bold text-primary">5</span> detik...
        </small>

        <a href="{{ route('login') }}"
           class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Kembali Sekarang
        </a>

    </div>
</div>

<style>
html, body {
    min-height: 100vh;
    margin: 0;
}

body {
    background:
        radial-gradient(circle at top right, rgba(255,255,255,0.25), transparent 40%),
        radial-gradient(circle at bottom left, rgba(255,255,255,0.15), transparent 40%),
        linear-gradient(135deg, #0d6efd, #4f8dfd);
}

/* Animation */
.animate-card {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeSlide 0.8s ease forwards;
}

@keyframes fadeSlide {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.success-icon {
    font-size: 75px;
    animation: pop 0.6s ease;
}

@keyframes pop {
    0% { transform: scale(0.6); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>

<script>
let seconds = 5;
const countdownEl = document.getElementById('countdown');
const progressBar = document.getElementById('progressBar');

const interval = setInterval(() => {
    seconds--;
    countdownEl.textContent = seconds;
    progressBar.style.width = (seconds / 5) * 100 + "%";

    if (seconds <= 0) {
        clearInterval(interval);
        window.location.href = "{{ route('login') }}";
    }
}, 1000);
</script>
@endsection
