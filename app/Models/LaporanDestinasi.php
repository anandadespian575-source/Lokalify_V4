<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDestinasi extends Model
{
    use HasFactory;

    // Nama tabel di database phpMyAdmin Anda
    protected $table = 'laporan_destinasis';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'destinasi_id',
        'user_id',
        'pesan_laporan',
        'status',
    ];

    // Relasi ke Model Destinasi
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }

    // Relasi ke Model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}