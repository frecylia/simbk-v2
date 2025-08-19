<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimbkData extends Model
{
    use HasFactory;

    protected $table = 'simbk_data';

    protected $fillable = [
        'nama_siswa',
        'nisn',
        'kelas',
        'jenis_kelamin',
        'topik_konseling',
        'tanggal',
        'guru_bk',
        'status',
    ];

    
}
