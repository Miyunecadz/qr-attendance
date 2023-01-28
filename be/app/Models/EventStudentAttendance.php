<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventStudentAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'faculty_id',
        'time_in',
        'time_out',
        'is_present'
    ];
}
