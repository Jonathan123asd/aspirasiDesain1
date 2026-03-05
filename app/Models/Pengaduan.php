<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;


    protected $table = 'pengaduan';

     protected $fillable = [
        'user_id',
        'judul',
        'urgensi',
        'kategori_id',
        'deskripsi',
        'lokasi',
        'status',
        'tanggal',
        'image'
    ];

    //pengaduan milik satu user(siswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //satu pengaduan memiliki banyak respon dari admin
    public function respon()
    {
        return $this->hasMany(Respon::class, 'pengaduan_id');
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
}
