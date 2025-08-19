<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'available_date', 'available_time', 'is_booked'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
