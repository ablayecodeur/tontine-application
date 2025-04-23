<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tontine_id',
        'status',
        'position'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

        // Changez la relation payments() en payment()
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function rounds()
    {
        return $this->belongsToMany(Round::class)
                   ->withPivot(['is_winner', 'amount_received'])
                   ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
