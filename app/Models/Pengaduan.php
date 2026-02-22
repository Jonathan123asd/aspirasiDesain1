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
        'kategori',
        'deskripsi',
        'lokasi',
        'status',
        'tanggal'
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
}
