<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'peminatan_id',
        'soal_id',
        'pilihan_jawaban_id',
        'nilai',
    ];

    public function pilihanJawaban(): BelongsTo
    {
        return $this->belongsTo(PilihanJawaban::class);
    }
     public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    
}
