<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'user_type',
        'time_in',
        'time_out',
    ];

    public function getParticipantIdNumber()
    {
        if( $this->user_type == 2) {
            return Student::find($this->user_id)->id_number;
        }
        return Faculty::find($this->user_id)->employee_id;
    }

    public function getParticipantName()
    {
        if( $this->user_type == 2) {
            return Student::find($this->user_id)->name;
        }
        return Faculty::find($this->user_id)->name;
    }

    public function getParticipantDepartment()
    {
        if( $this->user_type == 2) {
            return Student::find($this->user_id)->department;
        }
        return Faculty::find($this->user_id)->department;
    }

    public function getPrettyUserType()
    {
        if( $this->user_type == 2) {
            return 'Student';
        }
        return 'Faculty';
    }

}
