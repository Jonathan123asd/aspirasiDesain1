<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SiswaController extends Controller
{
    // Middleware: hanya siswa yang bisa akses


    // Dashboard siswa
    public function dashboard()
    {
        $user = Auth::user();

        // Ambil data pengaduan user ini
        $pengaduan = Pengaduan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5) // ambil 5 terbaru
            ->get();

        // Hitung statistik
        $statistik = [
            'total' => Pengaduan::where('user_id', $user->id)->count(),
            'pending' => Pengaduan::where('user_id', $user->id)->where('status', 'pending')->count(),
            'proses' => Pengaduan::where('user_id', $user->id)->where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('user_id', $user->id)->where('status', 'selesai')->count(),
        ];

        return view('siswa.dashboard', compact('pengaduan', 'statistik'));
    }

    // Form pengaduan
    public function form()
    {
        return view('siswa.form');
    }

    // Simpan pengaduan
    public function store(Request $request)
    {


        // Validasi
        $request->validate([
            'judul' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'deskripsi' => 'required|string|min:10',
            'lokasi' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urgensi' => 'required|in:rendah,sedang,tinggi'
        ]);

        $imagePath = null;

        // Simpan file jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengaduan', 'public');
        }


        // Simpan ke database
        Pengaduan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'urgensi' => $request->urgensi,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'image' => $imagePath,
            'tanggal' => now()->toDateString(),
            'status' => 'pending'
        ]);



        return redirect()->route('siswa.history')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    // History pengaduan
    public function history(Request $request)
    {
        $query = Pengaduan::with('respon.admin')
            ->where('user_id', Auth::id());

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                    ->orWhere('kategori', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->get();

        return view('siswa.history', compact('pengaduan'));
    }
    
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['respon.admin'])
            ->where('user_id', Auth::id()) // supaya siswa tidak bisa akses milik orang lain
            ->findOrFail($id);

        return view('siswa.detail', compact('pengaduan'));
    }
}
