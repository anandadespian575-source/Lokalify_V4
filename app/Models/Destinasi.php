<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi'; // Sesuaikan jika nama tabel Anda 'destinasi' atau 'destinasis'

    protected $fillable = [
        'nama_destinasi',
        'slug',
        'deskripsi',
        'kategori_id',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'foto',
        'alamat',
        'jam_buka',
        'link_maps',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destinasi_id');
    }

    // --- RELASI KE GALERI FOTO & VIDEO ---
    public function galeri()
    {
        return $this->hasMany(GaleriDestinasi::class, 'destinasi_id');
    }
}