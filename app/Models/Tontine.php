<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount_per_participant',
        'max_participants',
        'manager_id',
        'frequency',
        'start_date',
        'end_date',
        'status',
        'current_winner_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function activeParticipants()
    {
        return $this->participants()->where('status', 'active');
    }

    public function pendingParticipants()
    {
        return $this->participants()->where('status', 'pending');
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Participant::class);
    }

    public function currentRound()
    {
        return $this->hasOne(Round::class)->where('is_completed', false);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

}
