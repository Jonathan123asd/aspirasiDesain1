<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Middleware: hanya admin yang bisa akses


    // Dashboard admin
    public function dashboard(Request $request)
    {
        // Ambil filter dari request
        $filters = $request->only(['status', 'kategori', 'tanggal']);

        // Query dengan filter
        $query = Pengaduan::with('user');

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['kategori'])) {
            $query->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['tanggal'])) {
            $query->whereDate('tanggal', $filters['tanggal']);
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $statistik = [
            'total' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', 'pending')->count(),
            'proses' => Pengaduan::where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        // List kategori untuk filter
        $kategoriList = Pengaduan::select('kategori')->distinct()->pluck('kategori');

        return view('admin.dashboard', compact('pengaduan', 'statistik', 'kategoriList'));
    }

    // Detail pengaduan
    public function detail($id)
    {
        $pengaduan = Pengaduan::with(['user', 'respon.admin'])->findOrFail($id);

        return view('admin.detail', compact('pengaduan'));
    }

    // Update status pengaduan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    // Tambah respon
    public function storeRespon(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'pesan' => 'required|string|min:5'
        ]);

        Respon::create([
            'pengaduan_id' => $request->pengaduan_id,
            'pesan' => $request->pesan,
            'admin_id' => Auth::id()
        ]);

        return redirect()
            ->route('admin.detail', $request->pengaduan_id)
            ->with('success', 'Respon berhasil ditambahkan!');
    }
}
