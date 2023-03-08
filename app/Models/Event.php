<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time_start',
        'time_end',
        'description',
    ];

    public function eventParticipants(): HasMany
    {
        return $this->hasMany(EventParticipant::class);
    }
}
