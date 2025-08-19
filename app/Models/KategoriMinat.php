<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMinat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
    
    public function soal()
    {
        return $this->hasMany(Soal::class, 'kategori_id');
    }
    
    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'kategori_dominan_id');
    }
}
