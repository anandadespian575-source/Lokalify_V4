<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists'; // Diubah dari 'wishlist' menjadi 'wishlists' sesuai database phpMyAdmin

    protected $fillable = [
        'user_id',
        'destinasi_id',
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}