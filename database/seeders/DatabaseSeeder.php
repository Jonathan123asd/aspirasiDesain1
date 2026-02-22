<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        $admin = User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved',
            'kelas' => null,
        ]);

        // User Siswa
        $siswa = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'status' => 'approved',
            'kelas' => 'XII RPL 1',
        ]);

        // Data Pengaduan Contoh
        Pengaduan::create([
            'user_id' => $siswa->id,
            'kategori' => 'Laboratorium',
            'deskripsi' => 'AC di lab komputer tidak dingin, membuat suasana panas saat praktikum',
            'lokasi' => 'Lab Komputer Lt.2',
            'status' => 'proses',
            'tanggal' => now()->subDays(3),
        ]);

        Pengaduan::create([
            'user_id' => $siswa->id,
            'kategori' => 'Toilet',
            'deskripsi' => 'Keran toilet putri lantai 2 rusak, air terus mengalir',
            'lokasi' => 'Toilet Putri Lt.2',
            'status' => 'pending',
            'tanggal' => now()->subDays(1),
        ]);

        Pengaduan::create([
            'user_id' => $siswa->id,
            'kategori' => 'Perpustakaan',
            'deskripsi' => 'Buku referensi untuk jurusan RPL masih edisi lama',
            'lokasi' => 'Perpustakaan',
            'status' => 'selesai',
            'tanggal' => now()->subDays(5),
        ]);
    }
}
