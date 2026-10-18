<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Gabungkan semua field yang diizinkan di sini (tidak boleh ada $fillable ganda)
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'foto', 
        'theme'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];

    public function isAdmin() {
        return $this->role === 'admin';
    }
}