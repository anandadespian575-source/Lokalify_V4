<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; // Diubah dari 'kategori' menjadi 'kategoris' sesuai database
    protected $fillable = ['nama_kategori', 'slug'];
    public $timestamps = false;

    public function destinasi() {
        return $this->hasMany(Destinasi::class, 'kategori_id');
    }
}