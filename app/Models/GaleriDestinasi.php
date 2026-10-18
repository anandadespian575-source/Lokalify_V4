<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriDestinasi extends Model
{
    use HasFactory;

    protected $table = 'galeri_destinasis';

    protected $fillable = [
        'destinasi_id',
        'user_id',
        'file_path',
        'jenis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }
}