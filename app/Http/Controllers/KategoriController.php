<?php

namespace App\Http\Controllers;

use App\Models\kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->search) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->latest()->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        kategori::create($request->only('nama_kategori', 'deskripsi'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->only('nama_kategori', 'deskripsi'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(kategori $kategori)
    {
        // cek apakah kategori dipakai pengaduan
    if ($kategori->pengaduan()->count() > 0) {
        return redirect()->route('admin.kategori.index')
            ->with('error', 'Kategori tidak bisa dihapus karena sedang digunakan!');
    }

    $kategori->delete();

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Kategori berhasil dihapus!');
    }

    public function show(kategori $kategori)
    {
        return view('admin.kategori.detail', compact('kategori'));
    }
}
