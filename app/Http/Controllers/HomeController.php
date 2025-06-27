<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tontine;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\View\View
     */
    public function accueil()
    {
        // Si l'utilisateur est déjà connecté, on le redirige vers son dashboard
        if (auth()->check()) {
            return auth()->user()->isManager()
                ? redirect()->route('manager.dashboard')
                : redirect()->route('participant.dashboard');
        }

        // Récupérer les 3 dernières tontines actives avec le nombre de participants
        $tontines = Tontine::where('status', 'active')
        ->withCount('activeParticipants')
        ->latest()
        ->take(3)
        ->get(['id', 'name', 'amount_per_participant', 'image', 'created_at']);


        return view('accueil', compact('tontines'));
    }
}
