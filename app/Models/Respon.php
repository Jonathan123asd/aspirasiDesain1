<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respon extends Model
{
    protected $table = 'respon';

    protected $fillable = [
        'pengaduan_id',
        'pesan',
        'admin_id'
    ];

    //respon milik satu pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    //respon milik satu user(admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
