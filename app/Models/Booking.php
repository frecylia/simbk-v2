<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
}
protected $fillable = [
    'student_id',
    'teacher_id',
    'schedule_date',
    'schedule_time',
];
