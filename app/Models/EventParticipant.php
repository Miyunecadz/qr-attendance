<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'user_id',
        'user_type',
        'time_in',
        'time_out',
        'is_present',
    ];

    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getParticipantIdNumber()
    {
        if ($this->user_type == 2) {
            return Student::find($this->user_id)->id_number;
        }

        return Faculty::find($this->user_id)->employee_id;
    }

    public function getParticipantName()
    {
        if ($this->user_type == 2) {
            return Student::find($this->user_id)->name;
        }

        return Faculty::find($this->user_id)->name;
    }

    public function getParticipantDepartment()
    {
        if ($this->user_type == 2) {
            return Student::find($this->user_id)->department;
        }

        return Faculty::find($this->user_id)->department;
    }

    public function getPrettyUserType()
    {
        if ($this->user_type == 2) {
            return 'Student';
        }

        return 'Faculty';
    }

    public function getPrettyStatus()
    {
        if ($this->is_present == 1) {
            return 'Time in only';
        } elseif ($this->is_present == 2) {
            return 'Present';
        }

        return 'Absent';
    }
}
