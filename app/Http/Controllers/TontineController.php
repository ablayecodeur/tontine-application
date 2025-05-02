<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TontineController extends Controller
{


    public function index()
    {
        $tontines = auth()->user()->tontines()
                         ->withCount(['activeParticipants'])
                         ->latest()
                         ->paginate(10); // ou un autre nombre de résultats par page

        return view('manager.tontines.index', compact('tontines'));
    }

    public function create()
    {
        return view('manager.tontines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount_per_participant' => 'required|numeric|min:1000',
            'max_participants' => 'required|integer|min:2',
            'start_date' => 'required|date'
        ]);

        $tontine = auth()->user()->tontines()->create($validated);

        return redirect()->route('manager.tontines.show', $tontine)
            ->with('success', 'Tontine créée avec succès!');
    }

    public function show(Tontine $tontine)
    {
        //$this->authorize('view', $tontine);

        $tontine->load(['participants.user', 'activeParticipants.user']);

        return view('manager.tontines.show', compact('tontine'));
    }

    public function edit(Tontine $tontine)
    {
        //$this->authorize('update', $tontine);

        return view('manager.tontines.edit', compact('tontine'));
    }

    public function update(Request $request, Tontine $tontine)
    {
        //$this->authorize('update', $tontine);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount_per_participant' => 'required|numeric|min:1000',
        ]);

        $tontine->update($validated);

        return redirect()->route('manager.tontines.show', $tontine)
            ->with('success', 'Tontine mise à jour avec succès!');
    }

    public function destroy(Tontine $tontine)
    {
        //$this->authorize('delete', $tontine);

        // Supprimer d'abord les participants liés
        $tontine->participants()->delete(); // si la relation est bien définie

        $tontine->delete();

        return redirect()->route('manager.dashboard')
            ->with('success', 'Tontine supprimée avec succès!');
    }

    public function drawWinner(Tontine $tontine)
    {
       // $this->authorize('draw', $tontine);

        $activeParticipants = $tontine->activeParticipants()->get();

        if ($activeParticipants->count() < 2) {
            return back()->with('error', 'Pas assez de participants pour effectuer un tirage');
        }

        $winner = $activeParticipants->random();

        // Notifications
        foreach ($activeParticipants as $participant) {
            $message = $participant->id === $winner->id
                ? 'Félicitations! Vous avez gagné le tirage de la tontine ' . $tontine->name
                : 'Le gagnant du tirage de la tontine ' . $tontine->name . ' est ' . $winner->user->name;

            Notification::create([
                'user_id' => $participant->user_id,
                'title' => 'Résultat du tirage', // Ajout du titre requis
                'type' => 'draw_result',
                'message' => $message,
                'notifiable_id' => $tontine->id,
                'notifiable_type' => Tontine::class
            ]);
        }

        return view('manager.tontines.draw-result', [
            'tontine' => $tontine,
            'winner' => $winner
        ]);
    }

     // app/Http/Controllers/TontineController.php

     public function performDraw(Tontine $tontine)
     {
         // Vérifier que l'utilisateur est le gestionnaire
         if ($tontine->manager_id !== auth()->id()) {
             abort(403);
         }

         // Vérifier qu'aucun gagnant n'a déjà été désigné
         if ($tontine->current_winner_id) {
             return redirect()->route('manager.tontines.show', $tontine)
                    ->with('error', 'Un tirage a déjà été effectué pour cette tontine');
         }

         // Vérifier le nombre de participants
         if ($tontine->activeParticipants()->count() < 2) {
             return back()->with('error', 'Minimum 2 participants requis');
         }

         // Effectuer le tirage
         $winner = $tontine->activeParticipants()->inRandomOrder()->first();

         // Enregistrer le gagnant
         $tontine->update([
             'current_winner_id' => $winner->user_id,
             'draw_date' => now() // Ajouter la date du tirage
         ]);

         // Envoyer les notifications
         foreach ($tontine->activeParticipants as $participant) {
             Notification::create([
                 'user_id' => $participant->user_id,
                 'type' => 'draw_result',
                 'title' => $participant->user_id === $winner->user_id
                           ? 'Vous avez gagné !'
                           : 'Résultat du tirage',
                 'message' => $participant->user_id === $winner->user_id
                     ? "Félicitations ! Vous avez gagné le tirage de la tontine {$tontine->name}"
                     : "Le gagnant du tirage de la tontine {$tontine->name} est {$winner->user->name}",
                 'notifiable_id' => $tontine->id,
                 'notifiable_type' => Tontine::class
             ]);
         }

         return redirect()->route('manager.tontines.show', $tontine)
                ->with('success', 'Tirage effectué avec succès !');
     }

        public function showDrawPage(Tontine $tontine)
    {
        // Vérifications
        if ($tontine->manager_id !== auth()->id()) abort(403);
        if ($tontine->current_winner_id) {
            return back()->with('error', 'Un tirage a déjà été effectué');
        }
        if ($tontine->activeParticipants()->count() < 2) {
            return back()->with('error', 'Minimum 2 participants requis');
        }

        return view('manager.tontines.draw', compact('tontine'));
    }


}
