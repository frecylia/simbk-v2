<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pertanyaan',
        'kategori_id',
    ];
    
    public function kategoriMinat()
    {
        return $this->belongsTo(KategoriMinat::class, 'kategori_id');
    }
    
    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'soal_id');
    }
}
