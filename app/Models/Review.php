<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Destinasi (Perbaikan error sebelumnya)
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }
}