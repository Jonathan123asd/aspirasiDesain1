<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    //satu kategori memiliki banyak pengaduan
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}
