<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login - VERSI YANG BENAR
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // ADMIN TIDAK PERLU APPROVAL, LANGSUNG BISA LOGIN
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // Untuk SISWA, cek status approval
            if ($user->role === 'siswa') {
                if ($user->status === 'pending') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun Anda masih menunggu persetujuan admin.',
                    ]);
                }

                if ($user->status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun Anda ditolak oleh admin.',
                    ]);
                }

                // Jika siswa dan status approved
                $request->session()->regenerate();
                return redirect()->route('siswa.dashboard');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
