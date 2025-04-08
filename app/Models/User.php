<?php

namespace App\Models;
use App\Models\Tontine;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role', // 'manager' ou 'participant'
        'avatar',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation avec les tontines gérées (pour les gérants)
     */
    public function managedTontines()
    {
        return $this->hasMany(Tontine::class, 'manager_id');
    }

    /**
     * Relation avec les participations (pour les participants)
     */
    public function participations()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Relation avec les paiements
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Participant::class);
    }

    /**
     * Relation avec les notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Vérifie si l'utilisateur est un gérant
     */
    public function isManager()
    {
        return $this->role === 'manager';
    }

    /**
     * Vérifie si l'utilisateur est un participant
     */
    public function isParticipant()
    {
        return $this->role === 'participant';
    }

    /**
     * Récupère les notifications non lues
     */
    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }

        // Ajoutez cette méthode à votre modèle User
    public function tontines()
    {
        return $this->hasMany(Tontine::class, 'manager_id');
    }



}
