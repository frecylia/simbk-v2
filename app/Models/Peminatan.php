<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminatan extends Model
{
    use HasFactory;

     protected $table = 'peminatan';
    
    protected $fillable = [
        'user_id',
        'asal_smp',
        'nilai_rapor',
        'prestasi',
        'rank_ipa',
        'rank_ips',
        'rank_bahasa',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jawabanSiswa(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class);
    }

}
