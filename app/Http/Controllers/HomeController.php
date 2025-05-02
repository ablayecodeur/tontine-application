<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Sinon, on affiche la page d'accueil
        return view('accueil');
    }
}
