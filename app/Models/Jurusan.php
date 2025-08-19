<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_jurusan',
        'deskripsi',
        'kategori_dominan_id',
    ];
    
    public function kategoriMinat()
    {
        return $this->belongsTo(KategoriMinat::class, 'kategori_dominan_id');
    }
}
